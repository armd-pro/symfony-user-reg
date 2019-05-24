<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('email', EmailType::class)

            ->add('password', PasswordType::class, [

                'label' => 'Password',
                'mapped' => false,

                'constraints' => [

                    new NotBlank([
                        'message' => 'password.empty',
                    ]),

                    new Length([
                        'min' => 6,
                        'minMessage' => 'password.min-length',
                        'max' => 4096,
                    ]),

                ],
            ])

            ->add('name', TextType::class, [
                'label' => 'Name'
            ])

            ->add('photo', ImageType::class, [

            ])

            ->add('submit-btn', SubmitType::class, [
                'label' => 'Send'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'registration-form'
        ]);
    }
}
