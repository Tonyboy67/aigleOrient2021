<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\CategoriePlat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => '菜名 - Nom du plat'
            ])
            ->add('description', TextType::class, [
                'label' => '描述 - Description'
            ])
            ->add('image_upload', FileType::class, [
                'label'=> '添加图片 - ajouter une image',
                'mapped'=>false
            ])
           // ->add('prix')
            ->add('prix', MoneyType::class,[
                'divisor' => 100,
                'label' =>  '价格 - Prix',
                'currency' => 'EUR',
                'attr' => [
                'placeholder' => '请输菜的价格 - Veuillez saisir un prix',]
            ])
            ->add('idCategorie', EntityType::class,[
                'required' => false,
                'label' => '菜肴类型 - Catégorie de plat : ',
                'placeholder' => '-- 请选择菜肴类型 - Choisir un type de plat --',
                'class' => CategoriePlat::class,
                'choice_label' => function(CategoriePlat $categorie){
                    return $categorie->getNom();
                    return strtoupper($categorie->getNom());
                }
            ]);
            //->add('idCategorie');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
