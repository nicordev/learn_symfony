<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/students', name: 'student-list')]
    public function list(StudentRepository $studentRepository): Response
    {
        $students = $studentRepository->findAll();

        return $this->json(json_encode($students));
    }
}
