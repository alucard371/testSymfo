<?php

namespace App\Form;

use App\Entity\Adopter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdopterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('kids', TextType::class)
            ->add('married', TextType::class)
            ->add('description', TextareaType::class, array('attr' => array('class' => 'ckeditor') ))
            ->add('presentation', TextareaType::class, array('attr' => array('class' => 'ckeditor') ))
            ->add('motivation', TextareaType::class, array('attr' => array('class' => 'ckeditor') ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adopter::class,
        ]);
    }
}
