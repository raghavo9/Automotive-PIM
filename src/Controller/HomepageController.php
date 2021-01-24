<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomepageController extends AbstractController
{

    

     
    /**
     * @Route("/", name="default_login")
     */
    public function default_login(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/homepage", name="homepage")
     */
    public function index(ProductRepository $productRepository, Security $security): Response
    {
        return $this->render('homepage/index.html.twig', [
            //'controller_name' => 'HomepageController',
            //'products' => $productRepository->findAll(),
            'products' => $productRepository->findBy(array('status' => "publish" )),
            'curr_user'=> $security->getUser()
        ]);
    }
}
