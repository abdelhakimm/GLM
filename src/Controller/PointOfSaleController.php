<?php

namespace App\Controller;

use App\Entity\PointOfSale;
use App\Form\PointOfSaleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointOfSaleController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    /**
     * Permet d'afficher la page des points de vente
     *
     * @return Response
     */
    #[Route('/point_of_sale', name: 'point_of_sale')]
    public function index(): Response
    {
        $pointOfsale = $this->entityManager->getRepository(PointOfSale::class)->findAll();
        return $this->render('point_of_sale/index.html.twig', [
            'PointOfSales' => $pointOfsale,
            'current_menu' => 'point_of_sale',
        ]);
    }

    /**
     * permet de creer un point de vente
     */

     #[Route('/point_of_sale/ajout', name: 'point_of_sale_create')]

     public function create (Request $request, EntityManagerInterface $entityManager){
        $pointOfsale = new PointOfSale();
        $form = $this->createForm(PointOfSaleType::class, $pointOfsale);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($pointOfsale);
            $entityManager->flush();
            $this->addFlash(
                'succes_point_of_sale_create',
                'le point de vente a bien été créer'
            );
            return$this->redirectToRoute('point_of_sale');
        }

        return $this->render('point_of_sale/new.html.twig', [
            'pointOfsaleForm' => $form->createView(),
            'current_menu' => 'point_of_sale'
        ]);
     }

     /**
      * permet d'afficher la page de modification
      */
      #[Route('/point_of_sale/modifier/{id}', name:'point_of_sale_edit')]

      public function edit(Request $request, $id){
        $pointOfsale= $this->entityManager->getRepository(PointOfSale::class)->findOneById($id);
        $form = $this->createForm(PointOfSaleType::class, $pointOfsale);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->addFlash(
                'succes_point_of_sale',
                'le point de vente a bien été modifié !'
            );
            return $this->redirectToRoute('point_of_sale');
        }

        return $this->render('point_of_sale/edit.html.twig', [
            'pointOfsaleForm' => $form->createView(),
            'PointOfSale' => $pointOfsale
        ]);
      }

      /**
       * permet de supprimer un point de vente
       */
      #[Route('/point_of_sale/supprimer/{id})', name: 'point_of_sale_delete')]
        public function delete(PointOfSale $pointOfSale): RedirectResponse{
            $this->entityManager->remove($pointOfSale);
            $this->entityManager->flush();

            $this->addFlash(
                'succes_point_of_sale_delete',
                'le point de vente a bien été supprimer !'
            );

            return $this->redirectToRoute('point_of_sale');
        }
}
