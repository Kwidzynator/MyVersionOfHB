<?php

namespace App\Controller;

use App\Entity\Login;
use App\Form\LoginFormType;
use App\Form\RegisterFormType;
use App\Repository\LoginRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(Request $request, LoginRepository $loginRepository): Response
    {
        $loginInfo = new Login();
        $form = $this->createForm(LoginFormType::class, $loginInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $loginInfo->getLogin();
            $password = $loginInfo->getPassword();

            $user = $loginRepository->findByLogin($login);

            if ($user && $password === $user->getPassword()) {

                return $this->redirectToRoute('app_login_succeed');

            } else {

                return $this->redirectToRoute('app_login_failed');
            }
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}