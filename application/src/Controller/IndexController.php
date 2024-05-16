<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route("/index", name: "app_index")]
    public function index(CategoryRepository $categoryRepository, TaskRepository $taskRepository): Response
    {
        $categorys = $categoryRepository->findAll();
        $task = $taskRepository->findAll();

        return $this->render('index/index.html.twig', [
            'categorys' => $categorys,
            'task' => $task,
        ]);
    }
}