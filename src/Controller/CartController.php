<?php

namespace App\Controller;


use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Handy;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartController extends AbstractController
{

    private $session;
    private $cartService;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->cartService = new CartService();
    }

    public function cartAction()
    {
        $cartArray = $this->session->get('cart');
        if ($cartArray) {
            sort($cartArray);
            $this->session->set('cart',$cartArray);
            $em = $this->getDoctrine()->getManager("handy");
            $res = $this->cartService->getValuesForCart($cartArray, $em);
        } else {
            $res = ['handys' => ""];
        }
        return $this->render('cart.twig', $res);
    }

    public function addToCart()
    {

        $cartArray = $this->session->get('cart');
        if (!$cartArray) {
            $cartArray = array();
        }
        array_push($cartArray, $_POST['id']);
        $this->session->set('cart', $cartArray);

        return new JsonResponse(count($cartArray));
    }

    public function removeItemFromCart()
    {

        $cartArray = $this->session->get('cart');
        foreach ($cartArray as $key => $item) {
            if ($_POST['id'] == $item) {
                unset ($cartArray[$key]);
                $this->session->set('cart', $cartArray);
                break;
            }
        }
        return new JsonResponse();
    }

    public function checkOutAction()
    {
        $em = $this->getDoctrine()->getManager("handy");
        $cartArray = $this->session->get('cart');
        $res = $this->cartService->getValuesForCart($cartArray, $em);
        if (!$this->session->get('username')) {
            $this->addFlash("notice", "Bitte einloggen um zu bestellen");
            return $this->render('cart.twig',
                $res);
        }
        if (!$cartArray) {
            return $this->render('cart.twig',
                $res);
        } else {
            return new RedirectResponse('/orderOverview');
        }
    }

    public function getCartElements()
    {
        $cartArray = $this->session->get('cart');
        if (!$cartArray) {
            $cartArray = array();
        }
        return new JsonResponse(count($cartArray));
    }
}