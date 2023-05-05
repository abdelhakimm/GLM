<?php

namespace App\Controller;

use App\Entity\Holidays;
use App\Form\HolidaysFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HolidaysController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/holidays', name: 'holidays')]
    public function index(): Response
    {
        $holidays = $this->entityManager->getRepository(Holidays::class)->findAll();

        return $this->render('holidays/index.html.twig', [
            'holidays' => $holidays,
            'current_menu'=>'holidays',
        ]);
    }
    #[ROUTE('/holidays/ajout', name:'holidays_create')]
    public function create(Request $request)
    {
        $holidays = new Holidays();
        $form = $this->createForm(HolidaysFormType::class, $holidays);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($holidays);
            $this->entityManager->flush();
            $this->addFlash('succes_holidays_create', 'vos vacances ont bien été prise en compte');
            return $this->redirectToRoute('holidays');
        }
        return $this->render('holidays/new.html.twig', [
            'holidaysForm'=>$form->createView(),
            'current_menu'=>'holidays'
        ]);
    }
    #[ROUTE('/holidays/modifier/{id}', name: 'holidays_edit')]
    public function edit(Holidays $holidays, Request $request, $id)
    {
        $holiday = $this->entityManager->getRepository(Holidays::class)->findById($id);
        $form = $this->createForm(HolidaysFormType::class, $holidays);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->flush();
            $this->addFlash('succes_holidays_edit', 'les vacances ont était modifié');
            return $this->redirectToRoute('holidays');
        }
        return $this->render('holidays/edit.html.twig', [
            'holiday'=>$holiday,
            'holidaysForm'=>$form->createView(),
            'current_menu'=>'holidays'
        ]);
     }
     #[Route('holidays/supprimer/{id}', name: 'holidays_delete')]
     public function delete(Holidays $holidays)
     {
         $this->entityManager->remove($holidays);
         $this->entityManager->flush();
         $this->addFlash('success_holidays_delete', 'vos vacances ont bien été supprimé');
         return $this->redirectToRoute('holidays');
     }
}
