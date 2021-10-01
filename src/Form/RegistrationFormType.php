<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => '请输您的名字 - Ajouter votre prénom',
                'required' => false,
            ])
            ->add('nom', TextType::class, [
                'label' => '请输您的姓 - Ajouter votre nom',
                'required' => false,
            ])
            ->add('telephone', TextType::class, [
                'label' => '请输您的电话号码 - Ajouter un numéro de téléphone',
                'attr' => [
                    'placeholder' => '请输您的电话号 - Votre téléphone',],
                'required' => false,
            ])



            /*
            ->add('email', EmailType::class,[
                'label'=> '请输一个电子邮箱 - Ajouter un email',
                'attr' => [
                    'placeholder' => '请输您的电子邮箱 - Saisir ici votre email',],
                'required' => false,
            ])
            */


            /*->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])*/
            ->add('plainPassword', RepeatedType::class, [
                'first_options'  => ['label' => '请输您的密码 - Votre mot de passe'],
                'second_options' => ['label' => '请再输您的密码 - Répetez votre mot de passe'],
                'type' => PasswordType::class,
                'mapped' => false,

                //'label'=> '请输您的密码 - Ajouter un mot de passe',
                // instead of being set onto the object directly,
                // this is read and encoded in the controller

                
  
               
                
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => '请输您的密码 - Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => '请您输最少一个 {{ limit }} 位密码 - {{ limit }} caractères minimum pour votre mot de passe',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
