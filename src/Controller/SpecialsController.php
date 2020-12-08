<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class SpecialsController extends AbstractController
{
    /**
     * @Route(
     *     "/specials",
     *     name="specials",
     * )
     */

    public function specials(Request $request)
    {
        $access=$request->cookies->get("ITFO");
        if(isset($access)) {
            /* @var $em Connection */
            $em = $this->getDoctrine()->getConnection('Webshop');
            $em->connect();
            $query = "Select * from products";
            $res = $em->fetchAll($query);
            $response = $this->render('specials.twig',
                ['products' => $res]);


        } else {
            $response = $this->render('base.html.twig');
        }



        $cookie = new Cookie("ITFO",true);

        $response->headers->setCookie($cookie);

        return $response;
    }
}