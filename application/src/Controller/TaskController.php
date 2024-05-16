<?php

namespace App\Controller;

use App\Form\TaskType;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/createtask', name: 'createtask')]
    public function createtask(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(TaskType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();

            $entityManager->persist($data);

            $entityManager->flush();


        }
        return $this->render('task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route("/task/{id}/delete", name: "delete")]
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $task = $entityManager->getRepository(Task::class)->find($id);
        if($task !== null) {
            $entityManager->remove($task);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('app_index');
    }
    #[Route("/Task/{id}/view", name: "view")]
    public function view(EntityManagerInterface $entityManager, $id): Response
    {
        $entityManager->getRepository(Task::class)->find($id);

        return $this->render('task/view.html.twig', [
            'id' => $id
        ]);
    }
}
