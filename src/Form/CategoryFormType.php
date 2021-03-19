<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr'=>['placeholder'=>'Entrez le nom de la Catégories', 'class'=>'test'],
                'label'=>'Entrez le nom de la Catégories'])
            ->add('content', TextareaType::class, [
                'attr'=>['style'=>'height:200px; width:300px;',
                'placeholder'=>'Entrez un commentaire de la Catégories'
                ],
                'label'=>'Entrez un commentaire'
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
