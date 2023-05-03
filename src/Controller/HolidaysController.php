<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HolidaysController extends AbstractController
{
    #[Route('/holidays', name: 'app_holidays')]
    public function index(): Response
    {
        return $this->render('holidays/index.html.twig', [
            'controller_name' => 'HolidaysController',
        ]);
    }
}
