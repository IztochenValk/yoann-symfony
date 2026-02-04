<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route("/members", name: "user_list")]
    public function list(UserRepository $repo): Response
    {
        $users = $repo->findAll();

        return $this->render("user/list-user.html.twig", [
            "users" => $users
        ]);
    }

    #[Route("/account/{email}", name: "account")]
    public function single(UserRepository $repo, string $email): Response
    {
        $user = $repo->findOneBy(["email_user" => $email]);

        if ($user === null) {
            throw $this->createNotFoundException();
        }

        return $this->render("user/single-user.html.twig", [
            "user" => $user
        ]);
    }
}
