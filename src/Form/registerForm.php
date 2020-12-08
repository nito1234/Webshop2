<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class registerForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Username', TextType::class)
            ->add('Passwort', PasswordType::class)
            ->add('Nachname', TextType::class)
            ->add('Vorname', TextType::class)
            ->add('Stadt', TextType::class)
            ->add('PLZ', NumberType::class)
            ->add('Strasse', TextType::class)
            ->add('Hausnummer', NumberType::class)
            ->add('Registrieren', SubmitType::class);
    }
}