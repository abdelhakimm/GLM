<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MutualController extends AbstractController
{
    #[Route('/mutual', name: 'app_mutual')]
    public function index(): Response
    {
        return $this->render('mutual/index.html.twig', [
            'controller_name' => 'MutualController',
        ]);
    }
}
