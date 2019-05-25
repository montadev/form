<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                'help' => 'Choose something catchy!',
                 'attr'=>['placeholder'=>'Tape votre nom'],
                   'required'   => false,
                    'empty_data' => 'John Doe',
            ])
            ->add('content')
            ->add('createdAt',DateTimeType::class,[
                'widget' => 'single_text'
            ])
            ->add('category', EntityType::class, [
    // looks for choices from this entity
    'class' => Category::class,

    // uses the User.username property as the visible option string
    'choice_label' => 'name',

    // used to render a select box, check boxes or radios
    // 'multiple' => true,
    // 'expanded' => true,
])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
              'data_class' => Article::class
        ]);
    }
}
