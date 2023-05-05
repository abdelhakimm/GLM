<?php

namespace App\Controller;

use App\Entity\Meetings;
use App\Form\MeetingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeetingsController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    /**
     * Permet d'afficher la page reunion
     * @return Response
     */

    #[Route('/meetings', name: 'meeting')]
    public function index(): Response
    {
        $meeting = $this->entityManager->getRepository(Meetings::class)->findAll();
        return $this->render('meetings/index.html.twig', [
            'meetings' => $meeting,
            'current_menu' => 'meetings',
        ]);
    }

    /**
     * Permet de creer des reunion
     */

     #[Route('/meeting/ajout', name: 'meeting_create')]
     public function create(Request $request, EntityManagerInterface $entityManager){
        $meeting = new Meetings();
        $form = $this->createForm(MeetingsType::class, $meeting);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $dateTimeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTimeImmutable('now', $dateTimeZone);
            $meeting->setCreatedAt($date);
            $entityManager->persist($meeting);
            $entityManager->flush();

            $this->addFlash(
                'succes_meetings_create',
                'La réunion a bien etait créer'
            );
            return $this->redirectToRoute('meeting');
        }

        return $this->render('meetings/new.html.twig', [
            'meetingForm' => $form->createView(),
            'current_menu' => 'meeting'
        ]);
     }
     /**
      * Permet d'afficher la page de modification des reunion.
      */
      #[Route('/meeting/modifier/{title}', name: 'meeting_edit')]
      public function edit(Request $request, $title){
        $meeting= $this->entityManager->getRepository(Meetings::class)->findOneByTitle($title);

        $form = $this->createForm(MeetingsType::class, $meeting);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
      

        $this->entityManager->flush();

        $this->addFlash(
            'succes_meeting_edit',
            'la reunion a bien été modifié !'
        );

    return $this->redirectToRoute('meeting');
    }
        return $this->render('meetings/edit.html.twig', [
            'meetingForm' => $form->createView(),
            'meeting' => $meeting,
            'current_menu' => 'meetings'
        ]);
    }

    /**
     * permet de supprimer une reunion
     */
    #[Route('/meeting/supprimer/{title}', name: 'meeting_delete')]
    public function delete(Meetings $meetings): RedirectResponse{
        $this->entityManager->remove($meetings);
        $this->entityManager->flush();

        $this->addFlash(
            'succes_meetings_delete',
            'La reunion a bien été supprimer !'
        );

        return $this->redirectToRoute('meeting');
    }
    }

