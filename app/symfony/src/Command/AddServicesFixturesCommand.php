<?php


namespace App\Command;


use App\Entity\AboutDescription;
use App\Entity\CompanyHistory;
use App\Entity\News;
use App\Entity\OurTeam;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddServicesFixturesCommand extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:services:fixtures';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Bms add fixtures');
        $this
            // ...
            ->addOption(
                'truncate',
                null,
                InputOption::VALUE_OPTIONAL,
                'truncate table',
                null
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->lock()) {
            $io->warning('The command is already running in another process.');

            return Command::SUCCESS;
        }
        $truncateOption = $input->getOption('truncate');
        if ($truncateOption) {
            $io->note('truncate presentation tables');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=0');
            $this->em->getConnection()->executeQuery('truncate services');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        }
        $io->note('Starting Update  slug  update ...');
        $datas = $this->getServicesDatas();
        foreach ($datas as $data) {
            $service = new Services();
            //  dd($data);
            $summary = substr($data['summary'], 0, 99);
            $service->setTitle($data['title'])
                ->setSecondTitle($data['title'])
                ->setContent($data['content'])//    ->setElements()
                ->setSummary($summary)//
            ;
            $this->em->persist($service);
            $this->em->flush();
        }
        $io->note(' slug  updated');
        $this->release();
        return Command::SUCCESS;
    }

    public function getServicesDatas()
    {
        return [];
    }
}