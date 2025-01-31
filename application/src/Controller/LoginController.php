<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

    class LoginController extends AbstractController
    {
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
        {
            // получить ошибку входа, если она есть
            $error = $authenticationUtils->getLastAuthenticationError();

            // последнее имя пользователя, введенное пользователем
            $lastUsername = $authenticationUtils->getLastUsername();
        
            return $this->render('login/login.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
        }
    }