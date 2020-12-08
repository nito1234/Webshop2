<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class editDataForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* @var $customer \App\Entity\Customer */
        $customer = $options['data'];
        $builder
            ->add('Nachname', TextType::class, array(
                'mapped' => false,
                'data' => $customer->getLastname(),
            ))
            ->add('Vorname', TextType::class, array(
                'mapped' => false,
                'data' => $customer->getSurname(),
            ))
            ->add('Stadt', TextType::class, array(
                'mapped' => false,
                'data' => $customer->getCity(),
            ))
            ->add('PLZ', NumberType::class, array(
                'mapped' => false,
                'data' => $customer->getPostcode(),
            ))
            ->add('Strasse', TextType::class, array(
                'mapped' => false,
                'data' => $customer->getStreet(),
            ))
            ->add('Hausnummer', NumberType::class, array(
                'mapped' => false,
                'data' => $customer->getNumber(),
            ))
            ->add('Speichern', SubmitType::class);
    }
}