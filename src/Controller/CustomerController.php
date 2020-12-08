<?php

namespace App\Controller;

use App\Form\editDataForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\registerForm;
use App\Form\loginForm;
use App\Form\editPasswordForm;
use App\Entity\Customer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;



class CustomerController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function registerAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(registerForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager("customer");
            $formData = $form->getData();
            if (!$em->getRepository(Customer::class)->findOneBy((array("username" => $formData["Username"])))) {
                $customer->fillCustomer($formData);
                $em->persist($customer);
                $em->flush();
                $form = $this->createForm(loginForm::class);
                $this->addFlash("notice", "Registrierung erfolgreich");
                return $this->render('login.twig', [
                    'form' => $form->createView(),
                ]);
            } else {
                $this->addFlash("notice", "Username bereits vergeben");
                return $this->render('register.twig', [
                    'form' => $form->createView(),
                ]);
            }
        }
        return $this->render('register.twig',
            ['form' => $form->createView()]);
    }

    public function logInAction(Request $request)
    {
        $form = $this->createForm(loginForm::class);
        $form->handleRequest($request);
        if($this->session->get('username')) {
            $em = $this->getDoctrine()->getManager("customer");
            $customer = $em->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
            return $this->render('userOptions.twig',
                ['customer' => $customer]);
        } else {
            if ($form->isSubmitted() && $form->isValid()) {

                $em = $this->getDoctrine()->getManager("customer");
                $formData = $form->getData();
                $customer = $em->getRepository(Customer::class)->findOneBy((array("username" => $formData["Username"])));
                if (isset($customer)) {

                    if ($this->matchPassword($this->hashPassword($formData["Passwort"]), $customer->getPassword())) {
                        $this->session->set('username', $formData['Username']);
                        if(!$this->session->get('cart')){
                            $cartArray = array();
                            $this->session->set('cart', $cartArray);
                        }

                        return $this->render('userOptions.twig',['customer' => $customer]);
                    } else {
                        $this->addFlash("notice", "Keine gültige Kombination für Benutzer und Passwort gefunden");
                        return $this->render('login.twig', [
                            'form' => $form->createView(),
                        ]);
                    }
                }
            }
        }
        return $this->render('login.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function logOut(Session $session) {
        $this->get('session')->clear();
        $this->addFlash("notice", "Du hast Dich erfolgreich ausgeloggt!");

        return $this->render('index.html.twig');
    }

    public function customerAccountAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager("customer");
        $customer = $em->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
        $form = $this->createForm(editDataForm::class, $customer, array('csrf_protection' => false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("notice", "Daten erfolgreich geändert");
            $customer->setSurname($form->get("Vorname")->getNormData());
            $customer->setLastname($form->get("Nachname")->getNormData());
            $customer->setCity($form->get("Stadt")->getNormData());
            $customer->setPostcode($form->get("PLZ")->getNormData());
            $customer->setStreet($form->get("Strasse")->getNormData());
            $customer->setNumber($form->get("Hausnummer")->getNormData());
            $em->persist($customer);
            $em->flush();

            return $this->render('userOptions.twig',['customer' => $customer]);

        }


        return $this->render('userAccount.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function changePasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager("customer");
        $customer = $em->getRepository(Customer::class)->findOneBy((array("username" => $this->session->get('username'))));
        $form = $this->createForm(editPasswordForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            if ($this->hashPassword($formData['oldPassword']) === $customer->getPassword() && ($formData['newPassword'] === $formData['passwordConfirm'])) {
                $this->addFlash("notice", "Pasword erfolgreich geändert");
                $customer->setPassword($this->hashPassword($formData['newPassword']));
                $em->persist($customer);
                $em->flush();

                return $this->render('password.twig', [
                    'form' => $form->createView(),
                ]);
            } else {
                $this->addFlash("notice", "Bitte überprüfe deine Eingaben!");
            }
        } 
        return $this->render('password.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function hashPassword($password)
    {
        return hash("sha256", $password);
    }

    public function matchPassword($givenPassword, $savedPassword)
    {
        return $savedPassword === $givenPassword;
    }

}