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
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateServicesSlugCommand extends Command
{
    use LockableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'bms:update:services:slug:update';
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Update services slug');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if (!$this->lock()) {
            $io->warning('The command is already running in another process.');

            return Command::SUCCESS;
        }

        $io->note('Starting Update  slug  update ...');
        $this->updateServicesSlug();
        $this->updateAboutDescription();
        $this->updateNewSlug();
        $this->UpdateCompanyHistorySlug();
        $this->UpdateOurTeamSlug();
        $io->note(' slug  updated');
        $this->release();

        return Command::SUCCESS;
    }

    public function updateServicesSlug()
    {
        // update data
        $bath = 0;
        $services = $this->em->getRepository(Services::class)->findAll();
        /** @var Services $machine */
        foreach ($services as $service) {
            $service->setSlug($service->getTitle());
            if (0 === $bath % 50) {
                $this->em->flush();
            }
            ++$bath;
        }
        $this->em->flush();
    }

    public function updateNewSlug()
    {
        // update data
        $bath = 0;
        $news = $this->em->getRepository(News::class)->findAll();
        /** @var News $new */
        foreach ($news as $new) {
            $new->setSlug($new->getTitle());
            if (0 === $bath % 50) {
                $this->em->flush();
            }
            ++$bath;
        }
        $this->em->flush();
    }

    public function updateAboutDescription()
    {
        // update data
        $bath = 0;
        $aboutDescriptions = $this->em->getRepository(AboutDescription::class)->findAll();
        /** @var AboutDescription $aboutDescription */
        foreach ($aboutDescriptions as $aboutDescription) {
            $aboutDescription->setSlug($aboutDescription->getTitle());
            if (0 === $bath % 50) {
                $this->em->flush();
            }
            ++$bath;
        }
        $this->em->flush();
    }

    public function UpdateCompanyHistorySlug()
    {
        // update data
        $bath = 0;
        $companyHistories = $this->em->getRepository(CompanyHistory::class)->findAll();
        /** @var CompanyHistory $companyHistory */
        foreach ($companyHistories as $companyHistory) {
            $companyHistory->setSlug($companyHistory->getTitle());
            if (0 === $bath % 50) {
                $this->em->flush();
            }
            ++$bath;
        }
        $this->em->flush();
    }

    public function UpdateOurTeamSlug()
    {
        // update data
        $bath = 0;
        $ourTeams = $this->em->getRepository(OurTeam::class)->findAll();
        /** @var OurTeam $ourTeam */
        foreach ($ourTeams as $ourTeam) {
            $ourTeam->setSlug($ourTeam->getTitle());
            if (0 === $bath % 50) {
                $this->em->flush();
            }
            ++$bath;
        }
        $this->em->flush();
    }
}
