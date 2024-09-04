<?php

namespace App\Controller;

use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Repository\LoginRepository;
use App\Entity\Login;
use App\Form\LoginFormType;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]

    public function index(
        Request $request,
        LoginRepository $loginRepository,
        UserPasswordHasherInterface $passwordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        FormLoginAuthenticator $authenticator
    ): Response {
        $loginInfo = new Login();
        $form = $this->createForm(LoginFormType::class, $loginInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $login = $loginInfo->getLogin();
            $password = $loginInfo->getPassword();

            $user = $loginRepository->findByLogin($login);

            if ($user && $passwordHasher->isPasswordValid($user, $password)) {
                // Authenticate the user using the FormLoginAuthenticator
                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            } else {
                return $this->redirectToRoute('app_login_failed');
            }
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}