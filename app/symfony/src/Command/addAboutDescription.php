<?php


namespace App\Command;


use App\Entity\AboutDescription;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class addAboutDescription extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:add:about:descrption:fixtures';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Bms add about descrption fixtures');
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
            $this->em->getConnection()->executeQuery('truncate about_description');
            $this->em->getConnection()->executeQuery('SET FOREIGN_KEY_CHECKS=1');
        }
        $io->note('Starting Update  about descrption  update ...');
        $datas = $this->getAboutDescriptiondatas();
        foreach ($datas as $data) {
            $aboutDescription = new AboutDescription();
            $aboutDescription->setTitle($data['title'])
                ->setDescription($data['description'])//
            ;
            $this->em->persist($aboutDescription);
            $this->em->flush();
        }
        $io->note(' about descrption  updated');
        $this->release();
        return Command::SUCCESS;
    }

    private function getAboutDescriptiondatas()
    {
        return [
            [
                'title' => 'Notre entreprise',
                'description' => 'BAFING MULTI SERVICES est une société de droit guinéen créée en juin 2016 immatriculée au RCCM de Conakry sous le numéro RCCM/GC-KAL/066692B/2016 spécialisée en Systèmes d’Information, en Management et Stratégie d’Entreprise. L’informatique a toujours été une passion pour nous, avant d’être notre métier, c’est pour cette raison que nous nous appliquons chaque jour à faire que nos services informatiques soient de qualité, et à fournir à nos clients les solutions informatiques les plus innovantes et les mieux adaptées à leurs besoins. Nous proposons à nos clients un service informatique de proximité qui rime avec compétence et sérieux en fonction de leurs besoins réels. Notre but est d’offrir à nos clients une gamme de prestations informatiques la plus large possible, pour pouvoir prendre en compte toutes leurs demandes dans les meilleurs délais.'
            ]
        ];
    }


}