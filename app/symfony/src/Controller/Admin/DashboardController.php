<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\AboutDescription;
use App\Entity\CompanyHistory;
use App\Entity\Media;
use App\Entity\News;
use App\Entity\NewsletterSubcriber;
use App\Entity\OurTeam;
use App\Entity\Parameters;
use App\Entity\Presentation;
use App\Entity\Services;
use App\Entity\Statistics;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //  php bin/console make:admin:crud
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        //  return parent::index();
        return $this->redirect($routeBuilder->setController(ServicesCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BMS')
            ->setTitle('Tableau de bord')
            // ->setFaviconPath('favicon.svg')
            ->setTranslationDomain('my-custom-domain')
            ->setTextDirection('ltr')
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Retour Accueil', 'fas fa-home', '/');
        yield MenuItem::section('Menu Important');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-building', Services::class);
        yield MenuItem::linkToCrud('Presentation', 'fas fa-building', Presentation::class);
        yield MenuItem::linkToCrud('Medias', 'fas fa-image', Media::class);
        yield MenuItem::linkToCrud('Parameters', 'fas fa-cogs', Parameters::class);
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('New letters Email liste', 'fas fa-mail-bulk', NewsletterSubcriber::class);
        yield MenuItem::linkToCrud('Statistique', 'fas fa-chart-bar', Statistics::class);
        yield MenuItem::linkToCrud('Notre equipe', 'fas fa-chart-bar', OurTeam::class);
        yield MenuItem::linkToCrud('Notre histoire', 'fas fa-chart-bar', CompanyHistory::class);
        yield MenuItem::linkToCrud('A propos description', 'fas fa-chart-bar', AboutDescription::class);
    }
}
