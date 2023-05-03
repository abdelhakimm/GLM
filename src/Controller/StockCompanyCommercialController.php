<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockCompanyCommercialController extends AbstractController
{
    #[Route('/stock/company/commercial', name: 'app_stock_company_commercial')]
    public function index(): Response
    {
        return $this->render('stock_company_commercial/index.html.twig', [
            'controller_name' => 'StockCompanyCommercialController',
        ]);
    }
}
