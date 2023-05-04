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
        
        $user = $this->entityManager->getRepository(User::class)->getAllUsers();

        return $this->render('employees/index.html.twig', [
            'users' => $user,
            'current_menu' => 'employee'
        ]);
    }

    #[Route('/employees/check/', name: 'check_employee')]
    public function check(): Response
    {
          /** @var User */
          $user = $this->getUser();
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
        $employee = $this->entityManager->getRepository(Employees::class)->findOneById($id);

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
            $this->entityManager->flush();
            $this->addFlash('success_employee_edit', 'L\'employer a bien été modifié');
            return $this->redirectToRoute('employees');
        }

        return $this->render('employees/edit.html.twig', [
            'employee' => $employee,
            'employeeForm' => $form->createView(),
            'current_menu' => 'employee'
        ]);
    }

    #[Route('/employees/supprimer/{id}', name: 'delete_employee')]
    public function delete(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this->addFlash('success_employee_delete', 'Cet employee a bien été supprimé');
        return $this->redirectToRoute('employees');
    }
}
