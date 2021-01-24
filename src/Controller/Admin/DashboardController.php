<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Automotive');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Category', 'fas fa-sitemap', Category::class);
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('Products', 'fas fa-car', Product::class);
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        }

        if ($this->isGranted('ROLE_MANAGER')) {
            yield MenuItem::linkToCrud('Product', 'fas fa-car', Product::class)->setController(Product2CrudController::class);
        }
        
        if ($this->isGranted('ROLE_MANAGER')) {
            yield MenuItem::linkToCrud('Category', 'fas fa-sitemap', Category::class)->setController(Category2CrudController::class);
        }

        else if ($this->isGranted('ROLE_USER')) {
            yield MenuItem::linkToCrud('Product', 'fas fa-car', Product::class);
        }

        
        
    }
}
