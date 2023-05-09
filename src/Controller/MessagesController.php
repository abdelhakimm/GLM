<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessagesFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    #[Route('/messages', name: 'messages')]
    public function index(): Response
    {
        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
        ]);
    }

    #[Route('/send', name: 'send')]
    public function send(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Messages();
        $form = $this->createForm(MessagesFormType::class, $message);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On gère la date de création
            $dateTimeZone = new \DateTimeZone('Europe/Paris');
            $date = new \DateTimeImmutable('now', $dateTimeZone);
            $message->setCreatedAt($date);
            $message->setSender($this->getUser());
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('succes_message_send', "Message envoyer avec succès");
            return $this->redirectToRoute('profile');
        }
        return $this->render('messages/send.html.twig',[
            "formMessage" => $form->createView()
        ]);
    }

    #[Route('/received', name: 'received')]
    public function received(): Response
    {
        return $this->render('messages/received.html.twig', [
            'controller_name' => 'receivedController',
        ]);
    }

    #[Route('/sent', name: 'sent')]
    public function sent(): Response
    {
        return $this->render('messages/sent.html.twig', [
            'controller_name' => 'sentController',
        ]);
    }

    #[Route('/read/{id}', name: 'read')]
    public function read(Messages $message, EntityManagerInterface $entityManager): Response
    {
        $message->setIsRead(true);
        $entityManager->persist($message);
        $entityManager->flush();

        return $this->render('messages/read.html.twig', compact("message"));
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Messages $message, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($message);
        $entityManager->flush();

        return $this->redirectToRoute('received');
    }
}
