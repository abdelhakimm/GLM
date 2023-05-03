<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Entity\User;
use App\Form\EmployeesFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class EmployeesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/employees', name: 'employees')]
    public function index(): Response
    {
        return $this->render('employees/index.html.twig', [
            'controller_name' => 'EmployeesController',
        ]);
    }

    #[Route('/employees/check/{email}', name: 'check_employee')]
    public function check(EntityManagerInterface $entityManager, $email): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
        if ($user->getEmployee() == null) {
            return $this->redirectToRoute('new_employee');
        } else {
            return $this->redirectToRoute('profile');
        }
        
        return $this->render('employees/new.html.twig');
    }

    #[Route('/employees/ajout', name: 'new_employee')]
    public function ajout(Request $request, string $employeeProfilePictureDir): Response
    {
        $employee = new Employees();
        $form = $this->createForm(EmployeesFormType::class, $employee);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if($ProfilePicture = $form['profile_picture']->getData()){
                $ProfilePictureFilename = bin2hex(random_bytes(6)).'.'.$ProfilePicture->guessExtension();
                try{
                    $ProfilePicture->move($employeeProfilePictureDir, $ProfilePictureFilename);
                }catch(FileException $e){
                    $this->addFlash('error_ProfilePicture_employee_upload', 'Erreur lors de l\'upload de l\'image');
                }
                $employee->setProfilePicture($ProfilePictureFilename);
            }
            $this->entityManager->persist($employee);
            $this->entityManager->flush();
            /** @var User */
            $user = $this->getUser();
            $user->setEmployee($employee);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $this->addFlash('success_employee_create', 'L\'employer a bien été créé');
            return $this->redirectToRoute('employees');
        }

        return $this->render('employees/new.html.twig', [
            'employeeForm' => $form->createView(),
            'current_menu' => 'employees'
        ]);
        
    }

    #[Route('/employees/modifier/{id}', name: 'edit_employee')]
    public function edit(Employees $employee, Request $request, $id, string $employeeProfilePictureDir)
    {
      
    }
}
