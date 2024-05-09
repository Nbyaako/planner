<?php

namespace App\Controller;

use App\Form\CreateCategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateCategoryController extends AbstractController
{

    #[Route("/createcategory", name: "app_createcategory")]
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
}