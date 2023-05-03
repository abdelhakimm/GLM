<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeesController extends AbstractController
{
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

    #[Route('/employees/ajout', name: 'new_employees')]
    public function ajout(): Response
    {
        
        return $this->render('employees/new.html.twig');
    }
}
