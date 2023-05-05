<?php

namespace App\Controller;

use App\Entity\StockCompanyCommercial;
use App\Form\StockCompanyCommercialType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockCompanyCommercialController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    /**
     * permet d'afficher la page des stock
     *
     * @return Response
     */

    #[Route('/stock_company_commercial', name: 'stock_company_commercial')]
    public function index(): Response
    {
        $stockCompanycommercial = $this->entityManager->getRepository(StockCompanyCommercial::class)->findAll();
        return $this->render('stock_company_commercial/index.html.twig', [
            'StockCompanyCommercials' => $stockCompanycommercial,
            'current_menu' => 'stock_company_commercial',
        ]);
    }

    /**
     * permet de creer les stock
     */
    #[Route('/stock_company_commercial/ajout', name: 'stock_company_commercial_create')]
    public function create(Request $request, EntityManagerInterface $entityManager){
        $stockCompanycommercial = new StockCompanyCommercial();
        $form = $this->createForm(StockCompanyCommercialType::class, $stockCompanycommercial);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($stockCompanycommercial);
            $entityManager->flush();
            $this->addFlash(
                'succes_stock_company_commercial_create',
                'le stock a bien été créer'
            );
            return $this->redirectToRoute('stock_company_commercial');
        }
        return $this->render('stock_company_commercial/new.html.twig', [
            'stockcompanycommercialForm' =>$form->createView(),
            'current_menu' => 'stock_company_commercial'
        ]);
    }

    /**
     * permet d'afficher la page des modification
     */

     #[Route('/stock_company_commercial/modifier{id}', name: 'stock_company_commercial_edit')]


     public function edit(Request $request, $id){
        $stockCompanycommercial = $this->entityManager->getRepository(StockCompanyCommercial::class)->findOneById($id);
        $form = $this->createForm(StockCompanyCommercialType::class, $stockCompanycommercial);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->addFlash(
                'succes_stock_company_commercial',
                'le stock a bien été changé !'
            );
            return $this->redirectToRoute('stock_company_commercial');
        }
        return $this->render('stock_company_commercial/edit.html.twig', [
            'stockcompanycommercialForm' => $form->createView(),
            'StockCompanyCommercial' => $stockCompanycommercial
        ]);
     }

     /**
      * permet de supprimer du stock
      */

      #[Route('/stock_company_commercial/delete{id}', name: 'stock_company_commercial_delete')]

      public function delete(StockCompanyCommercial $stockCompanyCommercial): RedirectResponse{
        $this->entityManager->remove($stockCompanyCommercial);
        $this->entityManager->flush();

        $this->addFlash(
            'succes_stock_company_commercial_delete',
            'le stock a bien été supprimer !'
        );

        return $this->redirectToRoute('stock_company_commercial');
      }
}

