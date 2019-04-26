<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Article;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('creation_date', DateType::class)
            ->add('auteur', TextType::class,[
                  'label' => 'auteur'
              ])
              ->add('titre', TextType::class,[
                  'label' => 'titre'
              ])
              ->add('corps', TextareaType::class,[
                  'label' => 'corps',
              ],
              array('attr' => array('class' => 'ckeditor') )
              )
              ->add('categorie', ChoiceType::class,[
                  'choices' => [
                      'health' => 'health',
                      'security' => 'security',
                      'common things' => 'common',
                      'thoughts' => 'thoughts'
                  ]
              ])
              
              
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}