<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email' EmailType::class)
            ->add('roles')
            ->add('password' PasswordType::class)
            ->add('firstname' TextType::class)
            ->add('lastname' TextType::class)
            ->add('city' TextType::class)
            ->add('birthday')
            ->add('gender')
            ->add('phone')
            ->add('picture')
            ->add('description' TextareaType::class)
            ->add('countries' TextType::class)
            ->add('answers')
            ->add('id_chats')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
