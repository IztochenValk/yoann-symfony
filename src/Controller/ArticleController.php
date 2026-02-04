<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'article_list')]
    public function list(ArticleRepository $repo): Response
    {
        $articles = $repo->findBy([], ['publishedAt' => 'DESC', 'id' => 'DESC']);

        return $this->render('article/list-article.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/{id}', name: 'article_single')]
    public function single(Article $article): Response
    {
        return $this->render('article/single-article.html.twig', [
            'article' => $article,
        ]);
    }
}
