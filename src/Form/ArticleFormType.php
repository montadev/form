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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Repository\CategoryRepository;
class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,[
                 'attr'=>['placeholder'=>'Tape votre nom'],
                 'required'   => false,
                 'label'=>'Title'
                  
            ])
            ->add('content',null,[
                'required' => false,
                'label'=>'Content',
                'required'   => false,
              ])
            ->add('publishedAt',DateType::class,[
               
                 'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd',
                  'label'=>'Published at',
                  'required'   => false,

                            ])
            ->add('category', EntityType::class, [
 
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'placeholder' => 'Choose a category',
                    'label'=>'Category',

                    'required'   => false,

             ])
            ->add('image', FileType::class,[
               
               'label'=>'Image',
               'required'=>false
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
