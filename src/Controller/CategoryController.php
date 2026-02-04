<?php

namespace App\Controller;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route("/categories", name: "category_list")]
    public function list(CategoryRepository $repo): Response{
        $categories = $repo->findAll();

        return $this->render("category/list-category.html.twig", [
            "categories" => $categories
        ]);
    }

    #[Route('/categories/{id}', name: 'category_single')]
    public function single(Category $category): Response{
        return $this->render('category/single-category.html.twig', [
            'category' => $category,
        ]);
    }

}
