<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayslipController extends AbstractController
{
    #[Route('/payslip', name: 'app_payslip')]
    public function index(): Response
    {
        return $this->render('payslip/index.html.twig', [
            'controller_name' => 'PayslipController',
        ]);
    }
}
