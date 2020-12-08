<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Service\Cart\CartService;
use App\Entity\Order;
use App\Entity\OrderHandy;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class OrderController extends AbstractController
{

    private $session;
    private $cartService;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->cartService = new CartService();
    }

    public function orderOverviewAction(){

        $emHandy = $this->getDoctrine()->getManager("handy");
        $emCustomer = $this->getDoctrine()->getManager("customer");
        $customer = $emCustomer->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
        $values = $this->cartService->getValuesForCart($this->session->get('cart'), $emHandy);

        return $this->render('orderOverview.twig', ['customer' => $customer, 'values' => $values]);
    }

    public function orderCompleteAction(){
        $emOrder = $this->getDoctrine()->getManager("Order");
        $emOrderHandy = $this->getDoctrine()->getManager("OrderHandy");
        $emCustomer = $this->getDoctrine()->getManager("customer");
        $emHandy = $this->getDoctrine()->getManager("handy");
        $customer = $emCustomer->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
        $values = $this->cartService->getValuesForCart($this->session->get('cart'), $emHandy);

        /* @var $order Order */
        $order = new Order();
        $order->setCustomerId($customer->getId());
        $order->setDate(new DateTime('NOW'));
        $order->setSum($values["gesamtSumme"]);
        $emOrder->persist($order);
        $emOrder->flush();

        $items = $this->session->get('cart');
        foreach ($items as $item){
            $orderHandy = new OrderHandy();
            $orderHandy->setHandyID($item);
            $orderHandy->setOrderID($order->getID());
            $emOrderHandy->persist($orderHandy);
        }
        $emOrderHandy->flush();

        $this->addFlash("notice", "Vielen Dank für Ihre Bestellung");
        $this->session->set("cart", "");
        return new RedirectResponse("/");

    }

    public function orderHistoryAction(){
        $emOrder = $this->getDoctrine()->getManager("Order");
        $emCustomer = $this->getDoctrine()->getManager("customer");
        $customer = $emCustomer->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
        $orders = $emOrder->getRepository(Order::class)->findBy((array('customerId' => $customer->getId())));
        sort($orders);
        return $this->render('orderHistory.twig', ['orders' => $orders]);
    }

    public function orderDetails(){
        $emOrderHandy = $this->getDoctrine()->getManager("OrderHandy");
        $items = $emOrderHandy->getRepository(OrderHandy::class)->findBy(array("orderID" => $_POST['id']));
        $em = $this->getDoctrine()->getManager("handy");
        $itemIDArray = array();
        foreach ($items as $item){
            $itemIDArray[]=$item->getHandyID();
        }

        $res = $this->cartService->getValuesForCart($itemIDArray, $em);



        return $this->render('orderDetails.twig', $res);
    }
}