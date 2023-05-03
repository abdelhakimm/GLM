<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CAController extends AbstractController
{
    #[Route('/c/a', name: 'app_c_a')]
    public function index(): Response
    {
        return $this->render('ca/index.html.twig', [
            'controller_name' => 'CAController',
        ]);
    }
}
