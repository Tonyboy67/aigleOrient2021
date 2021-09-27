<?php

namespace App\Form;

use App\Entity\CategoriePlat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoriePlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'请添加菜品类型 - Ajoutez une catégorie de plat'
            ])
            ->add('description', TextareaType::class, [
                'label'=>'菜品类型描述 - Decrivez la catégorie de plat'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoriePlat::class,
        ]);
    }
}
