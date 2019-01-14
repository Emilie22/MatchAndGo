<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('label' => 'Votre prénom'))
            ->add('lastname', TextType::class, array('label' => 'Votre nom'))
            ->add('city', TextType::class, array('label' => 'Votre ville'))
            ->add('birthday', DateType::class, array('label' => 'Votre date de naissance'))
            ->add('gender', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
                'label' => 'Homme'))
            ->add('phone', TextType::class, array('label' => 'Votre numéro de téléphone'))
            ->add('picture', FileType::class, array('data_class'=> null, 'label' => 'Votre photo'))
            ->add('description', TextareaType::class, array('label' => 'Parlez-nous un peu de vous !'))
            ->add('countries', TextType::class, array('label' => 'Pays visités'))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
