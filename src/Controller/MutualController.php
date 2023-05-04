<?php

namespace App\Controller;

use App\Entity\Mutual;
use App\Form\MutualFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MutualController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/mutual', name: 'mutual')]
    public function index(): Response
    {
        $mutual = $this->entityManager->getRepository(Mutual::class)->findAll();
        return $this->render('mutual/index.html.twig', [
            'mutuals'=>$mutual,
            'current_menu' => 'mutual',
        ]);
    }
    #[Route('/mutual/ajout', name:'mutual_create')]
    public function create(Request $request)
    {
        $mutual = new Mutual();
        $form = $this->createForm(MutualFormType::class, $mutual);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($mutual);
            $this->entityManager->flush();
            $this->addFlash('succes_mutual_create', 'votre mutuelle a bien été pris en compte');
            return $this->redirectToRoute('mutual');
        }
        return $this->render('mutual/new.html.twig', [
            'mutualForm'=>$form->createView(),
            'current_menu'=>'mutual'
        ]);
    }
    #[Route('/mutual/edit/{id}', name:'mutual_edit')]
    public function edit(Mutual $mutual,Request $request, $id)
    {
        $mutuals = $this->entityManager->getRepository(Mutual::class)->findById($id);
        $form = $this->createForm(MutualFormType::class, $mutual);
        $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) { 
    $this->entityManager->flush();
    $this->addFlash('succes_mutual_edit', 'la mutuelle a était modifié');
    return $this->redirectToRoute('mutual');
}
return $this->render('mutual/edit.html.twig', [
    'mutuals'=>$mutuals,
    'mutualForm'=>$form->createView(),
    'current_menu'=>'mutual'
]);
    }
    #[Route('/mutual/delete/{id}', name:'mutual_delete')]
    public function delete(Mutual $mutual){
        $this->entityManager->remove($mutual);
        $this->entityManager->flush();
        $this->addFlash('success_mutual_delete', 'votre mutual a bien été supprimé');
        return $this->redirectToRoute('mutual');
    }
}
