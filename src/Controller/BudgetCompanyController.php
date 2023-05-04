<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BudgetCompanyController extends AbstractController
{
    #[Route('/budget/company', name: 'app_budget_company')]
    public function index(): Response
    {
        return $this->render('budget_company/index.html.twig', [
            'controller_name' => 'BudgetCompanyController',
        ]);
    }
}
