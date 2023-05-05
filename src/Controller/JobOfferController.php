<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Entity\JobOffer;
use App\Form\JobOfferFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/joboffer', name: 'joboffer')]
    public function index(): Response
    {
        $joboffer = $this->entityManager->getRepository(JobOffer::class)->findAll();
        return $this->render('job_offer/index.html.twig', [
            'joboffers'=>$joboffer,
            'current_menu' => 'joboffer'
        ]);
        return $this->render('job_offer/index.html.twig', [
            'current_menu' => 'joboffer',
        ]);
    }
    #[Route('/joboffer/ajout', name:'joboffer_create')]
    public function create(Request $request){
        $joboffer = new Joboffer();
        $applicant = new Applicant();
        $form = $this->createForm(JobOfferFormType::class, $joboffer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $dateTimeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTimeImmutable('now', $dateTimeZone);
            $joboffer->setCreatedAt($date);
            $this->entityManager->persist($joboffer);
            $this->entityManager->flush();
            $this->addFlash('succes_joboffer_create', 'l\'offre de job a bien été pris en compte');
            return $this->redirectToRoute('joboffer');
        }
        return $this->render('job_offer/new.html.twig', [
            'jobofferForm'=>$form->createView(),
            'current_menu'=>'joboffer'
        ]);
    }
    #[Route('/joboffer/modifier/{id}', name:'joboffer_edit')]
    public function edit(JobOffer $joboffer,Request $request, $id)
    {
        $joboffers = $this->entityManager->getRepository(Joboffer::class)->findById($id);
        $form = $this->createForm(JobofferFormType::class, $joboffer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->addFlash('succes_joboffer_edit', 'le job a était modifié');
            return $this->redirectToRoute('joboffer');
        }
        return $this->render('job_offer/edit.html.twig', [
            'joboffers'=>$joboffers,
            'jobofferForm'=>$form->createView(),
            'current_menu'=>'joboffer'
        ]);
    }
    #[Route('/joboffer/delete/{id}', name:'joboffer_delete')]
    public function delete(Joboffer $joboffer)
    {
        $this->entityManager->remove($joboffer);
        $this->entityManager->flush();
        $this->addFlash('success_joboffer_delete', 'votre job a bien été supprimé');
        return $this->redirectToRoute('joboffer');
    }
    
}
