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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints\IsTrue;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array('label' => 'Prénom'))
            ->add('lastname', TextType::class, array('label' => 'Nom'))
            ->add('gender', ChoiceType::class, array(
                'label' => ' ',
                'choices' =>array(
                    'Femme' => 'femme',
                    'Homme' => 'homme')))
            ->add('city', TextType::class, array('label' => 'Ville'))
            ->add('birthday', DateType::class, array(
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd'))

            ->add('phone', TextType::class, array('label' => 'Numéro de téléphone'))
            ->add('picture', FileType::class, array(
                'data_class'=> null, 
                'label' => 'Choisis ta photo de profil', 'required' => false))
            // ->add('pictureBg', Choicetype::class, array(
            //     'choices'=> array('photo1' => 'photo1.jpg',
            //                       'photo2' => 'photo2.jpg',
            //                       'photo3' => 'photo3.jpg',
            //                       'photo4' => 'photo4.jpg'),
            //     'label' => 'Choisis ta photo de couverture', 
            //     'required' => true,
            //     'expanded' => true,
            //     'multiple' => false))
            ->add('description', TextareaType::class, array('label' => 'Parle-nous un peu de toi !'))
            ->add('countries', TextType::class, array('label' => 'Quels pays as-tu visités ?'))
            ->add('facebook', UrlType::class, array('label' => 'Lien vers ton profil facebook'))
            ->add('instagram', TextType::class, array('label' => 'Ton compte Instagram'))
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