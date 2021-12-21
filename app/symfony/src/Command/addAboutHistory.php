<?php


namespace App\Command;


use App\Entity\AboutDescription;
use App\Entity\CompanyHistory;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use DateTime;

class addAboutHistory extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:about:history:fixtures';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Bms add about history fixtures');
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
            $this->em->getConnection()->executeQuery('truncate company_history');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        }
        $io->note('Starting Update  about history  update ...');
        $datas = $this->getCompanyHistorydatas();
        foreach ($datas as $data) {
            $companyHistory = new CompanyHistory();
            $companyHistory->setTitle($data['title'])
                ->setHistoryDate($data['historyDate'])
                ->setDescription($data['description'])//
            ;
            $this->em->persist($companyHistory);
            $this->em->flush();
        }
        $io->note(' about descrption  updated');
        $this->release();
        return Command::SUCCESS;
    }

    private function getCompanyHistorydatas()
    {
        return [
            [
                'title' => 'Création',
                'historyDate' => new DateTime('2016-08-31'),
                'description' => '',            ],
            [
                'title' => 'Agrandissement de notre entreprise',
                'historyDate' => new DateTime('2018-08-31'),
                'description' => '',
            ],
            [
                'title' => 'Affiliation',
                'historyDate' => new DateTime('2020-08-31'),
                'description' => '',
            ]

        ];
    }


}