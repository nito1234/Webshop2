<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends AbstractController
{
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig');
    }

    public function impressumAction()
    {
        return $this->render('impressum.html.twig');
    }

    public function dataPrivacyAction()
    {
        return $this->render('datenschutz.html.twig');
    }

    public function aboutUsAction(Request $request)
    {
        return $this->render('aboutUs.twig');
    }
    public function contactAction(Request $request)
    {
        return $this->render('contact.html.twig');
    }
}