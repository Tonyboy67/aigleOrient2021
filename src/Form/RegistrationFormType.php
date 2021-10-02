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
                'label' => '请输您的名字 - Votre prénom',
                'required' => false,
            ])
            ->add('nom', TextType::class, [
                'label' => '请输您的姓 - Votre nom',
                'required' => false,
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email',
                'attr' => [
                    'placeholder' => '请输您的电子邮箱 - Votre email',
                ],
                 'required' => false,
            ])
            ->add('telephone', TextType::class, [
                'label' => '请输您的电话号码 - Téléphone',
                'attr' => [
                    'placeholder' => '请输您的电话号 - Votre téléphone',],
                'required' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [

                'type' => PasswordType::class,
                'mapped' => false,
                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],

                'first_options'  => [
                    'label' => '请输您的密码 - Mot de passe',
                    'constraints'=> [
                           new NotBlank([
                            'message' => '请输您的密码 - Entrez un mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => '请您输最少一个 {{ limit }} 位密码 - {{ limit }} caractères minimum pour votre mot de passe',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],

                'second_options' => [
                    'label' => '请再输您的密码 - Répetez le mot de passe',
                    'constraints' => [
                        new NotBlank([
                            'message' => '请确认您的密码 - Confirmez votre mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => '请您输最少一个 {{ limit }} 位密码 - {{ limit }} caractères minimum pour votre mot de passe',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => '同意我们的条款 - Accepter nos conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => '同意我们的条款 - Accepter nos conditions',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
