<?php


namespace App\Command;


use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class addActualityFixtures extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:fixtures';
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

        $io->note('Starting Update  slug  update ...');
        $datas = $this->ActualityDatas();
        foreach ($datas as $data) {
            $service = new Services();
            //  dd($data);
            $service->setTitle($data['title'])
                ->setSecondTitle($data['title'])
                ->setContent($data['content'])//    ->setElements()
                ->setSummary($data['summary'])//
            ;
            $this->em->persist($service);
            $this->em->flush();
        }
        $io->note(' slug  updated');
        $this->release();
        return Command::SUCCESS;
    }

    private function ActualityDatas()
    {
    }


}