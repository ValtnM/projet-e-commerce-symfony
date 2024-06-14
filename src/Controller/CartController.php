<?php

namespace App\Controller;

use App\Entity\OrderLine;
use App\Form\OrderLineType;
use Symfony\UX\Turbo\TurboBundle;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart/add', name: 'app_cart', methods: ['POST'])]
    public function add(ProductRepository $productRepository, Request $request): Response 
    {
        $id = $request->request->get('id', null);
        if ($id == null)
            return $this->redirectToRoute('app_home'); //nothing to do here

        $product = $productRepository->find($id);
        $quantity = $request->request->get('quantity', 0);
         
        // GERER ICI LA SESSION DU PANIER !
        $session = $request->getSession();
        $cartProduct = $session->get('product');
        $cartQuantity = $session->get('quantity');
        if($cartProduct->getId() == $id){
            $quantity += $cartQuantity;
        } else {
            $session->set('product', $product);
        }
        $session->set('quantity', $quantity);
        // $this->get('session')->set('product', $product)
       
        //dd(TurboBundle::STREAM_FORMAT, $request->getPreferredFormat());
        if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
            // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
            return $this->render(
                'front/_cartNav.html.twig',
                [
                    'cartQty' => 10,
                    'product' => $product
                ],
                new Response(
                    '',
                    200,
                    ['content-type' => TurboBundle::STREAM_MEDIA_TYPE]
                )
            );
        }

        // si pas de TURBO (js desactivé par exemple...) : redirection vers l'affichage du panier !
        return $this->redirectToRoute('app_cart');
    }
}
