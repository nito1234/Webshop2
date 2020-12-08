<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class editPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'required'   => true])
            ->add('newPassword', PasswordType::class, [
                'required'   => true])
            ->add('passwordConfirm', PasswordType::class, [
                'required'   => true])
            ->add('Speichern', SubmitType::class);
    }
}