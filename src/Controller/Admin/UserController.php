<?php

namespace App\Controller\Admin;

use App\Entity\Bailleur;
use App\Entity\Locataire;
use App\Entity\Loi;
use App\Entity\Message;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig',[

            //'countAllUsers' => $this->UserRepository->getCountUser(),
           //'countAllAnnounces' => $this->announceRepository->getCountAnnounce()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GESTION LOCATIVE');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        //yield MenuItem::linkToCrud('Gestion Bailleur', 'fas fa-user', Bailleur::class);
        //yield MenuItem::linkToCrud('Gestion Locataire', 'fas fa-user', Locataire::class);
        yield MenuItem::linkToCrud('Gestion utilisateur', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Gestion lois', 'fas fa-gavel', Loi::class);
        yield MenuItem::linkToCrud('Gestion FeedBack', 'fas fa-sms', Message::class);
    }
}
