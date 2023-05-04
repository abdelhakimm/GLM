<?php

namespace App\Controller;

use App\Entity\Salary;
use App\Form\SalaryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalaryController extends AbstractController
{ 
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/salary', name: 'salary')]
    public function index(): Response
    {
        $salary = $this->entityManager->getRepository(Salary::class)->findAll();
        return $this->render('salary/index.html.twig', [
            'salary'=>$salary,
            'current_menu' => 'Salary'
        ]);
    }
    #[Route('/salary/ajout', name:'salary_create')]
    public function create(Request $request)
    {
        $salary = new Salary();
        $form = $this->createForm(SalaryFormType::class, $salary);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->persist($salary);
            $this->entityManager->flush();
            $this->addFlash('succes_holidays_create', 'vos vacances ont bien été prise en compte');
            return $this->redirectToRoute('salary');
        }
    }

    #[Route('/salary/modifier/{id}', name:'salary_edit')]
    public function edit(Salary $salary,Request $request, $id)
    {
        $salarys = $this->entityManager->getRepository(Salary::class)->findById($id);
        $form = $this->createForm(SalaryFormType::class, $salary);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->addFlash('succes_holidays_edit', 'les vacances ont était modifié');
            return $this->redirectToRoute('salary');
        }
        return $this->render('salary/edit.html.twig', [
            'salarys'=>$salarys,
            'salaryForm'=>$form->createView(),
            'current_menu'=>'salary'
        ]);
    }
    
}
