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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\IsTrue;


class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', TextType::class, array('label' => 'Prénom'))
            ->add('lastname', TextType::class, array('label' => 'Nom'))
            ->add('city', TextType::class, array('label' => 'Ville'))
            ->add('birthday', DateType::class, array(
                'label' => 'Votre date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'))
            ->add('gender', ChoiceType::class, array(
                'choices' =>array(
                    'femme' => 'femme',
                    'homme' => 'homme')))
            ->add('phone', TextType::class, array('label' => 'Numéro de téléphone'))
            ->add('picture', FileType::class, array(
                'data_class'=> null, 
                'label' => 'Choisis ta photo de profil', 'required' => false))
            ->add('description', TextareaType::class, array('label' => 'Parle-nous un peu de toi !'))
            ->add('countries', TextType::class, array('label' => 'Quels pays as-tu visités ?'))
            ->add('save', SubmitType::class, array('label' => 'Créer mon profil'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
