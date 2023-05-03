<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfficeEquipmentController extends AbstractController
{
    #[Route('/office/equipment', name: 'app_office_equipment')]
    public function index(): Response
    {
        return $this->render('office_equipment/index.html.twig', [
            'controller_name' => 'OfficeEquipmentController',
        ]);
    }
}
