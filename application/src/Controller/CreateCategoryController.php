<?php

namespace App\Controller;

use App\Form\CreateCategoryType;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreateCategoryController extends AbstractController
{
    #[Route("/createcategory", name: "createcategory")]
    public function createcategory(EntityManagerInterface $entityManager, Request $request): Response
    {
        $form = $this->createForm(CreateCategoryType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $form->getData();

            $entityManager->persist($data);

            $entityManager->flush();


        }
        return $this->render('create_category/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route("/category/{id}/delete", name: "cdelete")]
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $category = $entityManager->getRepository(Category::class)->find($id);
        if($category !== null) {
            $entityManager->remove($category);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('app_index');
    }
    #[Route("/category/{id}/view", methods: ['GET'], name: "cview")]
    public function view(EntityManagerInterface $entityManager, $id): Response
    {
        $entityManager->getRepository(Category::class)->find($id);

        return $this->render('create_category/view.html.twig', [
            'id' => $id
        ]);
    }
}