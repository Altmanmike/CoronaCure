<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(UserRepository $userRepository): Response
    {
		$u = $this->getUser()->getUserIdentifier();        
        $user = $userRepository->findByEmail($u);     
        if (in_array('ROLE_USER', $user[0]->getRoles())) {
            return $this->redirectToRoute('app_home');
        }
		
        return $this->render('A-sb-admin_dashboard/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
