<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/front', name: 'app_front')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('front/index.html.twig', [
            'products' => $products,
        ]);
    }
    #[Route('/front/{slug}', name: 'app_front_product')]
    public function product(ProductRepository $productRepository, $slug): Response
    {
        $product = $productRepository->findOneBy(array('slug' => $slug));

        return $this->render('front/product.html.twig', [
            'product' => $product,
        ]);
    }
}
