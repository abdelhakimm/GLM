<?php

namespace App\Controller;

use App\Entity\PurchaseRequest;
use App\Form\PurchaseRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseRequestController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    /**
     * permet d'afficher la page demande d'achat
     *
     * @return Response
     */

    #[Route('/purchase_request', name: 'purchase_request')]
    public function index(): Response
    {
        $purchase_request = $this->entityManager->getRepository(PurchaseRequest::class)->findAll();
        return $this->render('purchase_request/index.html.twig', [
            'PurchaseRequests' => $purchase_request,
            'current_menu' => 'purchase_request',
        ]);
    }
    #[Route('/purchase_request/ajout', name: 'purchase_request_create')]

    public function create(Request $request, EntityManagerInterface $entityManager){
        $purchase_request = new PurchaseRequest();
        $form = $this->createForm(PurchaseRequestType::class, $purchase_request);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $dateTimeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTimeImmutable('now', $dateTimeZone);
            $purchase_request->setCreatedAt($date);
            $entityManager->persist($purchase_request);
            $entityManager->flush();

            $this->addFlash(
                'succes_purchase_request_create',
                'la demande d\'achat a bien ete prise en compte'
            );
            return $this->redirectToRoute('purchase_request');
        }
        return $this->render('purchase_request/new.html.twig', [
            'PurchaseRequestForm' => $form->createView(),
            'current_menu' => 'purchase_request'
        ]);
    }

    /**
     * permet d'afficher la page des modifications
     */
    #[Route('/purchase_request/modifier/{name}', name:'purchase_request_edit')]

    public function edit(Request $request, $name){
        $PurchaseRequest= $this->entityManager->getRepository(PurchaseRequest::class)->findOneByName($name);
        $form = $this->createForm(PurchaseRequestType::class, $PurchaseRequest);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->addFlash(
                'succes_purchase_request_edit',
                'la demande d\'achat a bien été modifié !'
            );
            return $this->redirectToRoute('purchase_request');
        }

        return $this->render('purchase_request/edit.html.twig', [
            'PurchaseRequestForm' => $form->createView(),
            'PurchaseRequest' => $PurchaseRequest
        ]);
    }

    /**
     * permet de supprimer une demande d'achat
     */
    #[Route('/purchase_request/supprimer/{name}', name: 'purchase_request_delete')]
    public function delete(PurchaseRequest $PurchaseRequest): RedirectResponse{
        $this->entityManager->remove($PurchaseRequest);
        $this->entityManager->flush();

        $this->addFlash(
            'succes_purchase_request_delete',
            'la demande d\'achat a bien ete supprimer!'
        );
        return $this->redirectToRoute('purchase_request');
    }









}
