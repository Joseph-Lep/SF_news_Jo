<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/api')]
class ApiController extends AbstractController
    // £ ARTICLE
{
    #[Route('/articles', name: 'api_articles')]
    public function articles(ArticleRepository $articleRepository): JsonResponse
    {
        return $this->json(
            $articleRepository->findAll(),
            context: [
                'groups' => ['articles:read'], // Tu serialise les articles en utilisant la ressource:action
            ]
        );
    }
    #[Route('/article/{id}', name: 'api_article')]
    public function article(Article $article): JsonResponse
    {

        return $this->json(
            [
                'Article' => $article,
                // recuperer ma route + l'id et l'incure dans mon json
            ],
            context: [
                'groups' => ['article:read'],
            ]
        );
    }
    // £ ARTICLE
    // * CATEGORY
    #[Route('/category', name: 'api_categories')]
    public function categories(CategoryRepository $categoryRepository): JsonResponse
    {
        return $this->json(
            $categoryRepository->findAll(),
            context: [
                'groups' => ['category:read'],
            ]
        );
    }
    #[Route('/category/{id}', name: 'api_category')]
    public function category(Category $category): JsonResponse
    {

        return $this->json(
            [
                'Category' => $category, // ! WAT.jpg ???
                [$_SERVER]
            ],
            context: [
                'groups' => ['category:read'],
            ]
        );
    }
    // * CATEGORY







    // * CATEGORY
}
