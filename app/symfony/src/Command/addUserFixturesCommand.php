<?php


namespace App\Command;


use App\Entity\Services;
use App\Entity\User;
use App\Service\Security\PasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class addUserFixturesCommand extends Command
{
    use LockableTrait;

    private ParameterBagInterface $params;
    private string $password;
    private string $email;
    private string $secondEmail;
    private PasswordService $passwordService;
    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:user:fixtures';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, ParameterBagInterface $params, PasswordService $passwordService)
    {
        $this->em = $em;
        $this->params = $params;
        $this->password = $_ENV['USER_PWD'];
        $this->email = $_ENV['AGENCY_EMAIL'];
        $this->secondEmail = $_ENV['AGENCY_EMAIL2'];
        $this->passwordService = $passwordService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Bms add fixtures');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->lock()) {
            $io->warning('The command is already running in another process.');

            return Command::SUCCESS;
        }

        $io->note('Starting add  User ...');
        $user= $this->em->getRepository(User::class)->findOneBy([
            'email' => $this->email
        ]);
        $user2= $this->em->getRepository(User::class)->findOneBy([
            'email' => $this->secondEmail
        ]);
dump($user);
        if(!$user instanceof User){
            $user = new User();
            $user->addRole(User::ROLE_ADMIN);
            $user->setEnabled(true)->setEmail($this->email);
            $password = $this->passwordService->encode($user, $this->password);
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();
        }

        // -------
        if(!$user2 instanceof User) {
            $user = new User();
            $user->addRole(User::ROLE_ADMIN);
            $user->setEnabled(true)
                ->setEmail($this->secondEmail);
            $password = $this->passwordService->encode($user, $this->password);
            $user->setPassword($password);
            $this->em->persist($user);
            $this->em->flush();
        }
        $io->note(' end add users');
        $this->release();
        return Command::SUCCESS;
    }



}