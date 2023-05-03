<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseRequestController extends AbstractController
{
    #[Route('/purchase/request', name: 'app_purchase_request')]
    public function index(): Response
    {
        return $this->render('purchase_request/index.html.twig', [
            'controller_name' => 'PurchaseRequestController',
        ]);
    }
}
