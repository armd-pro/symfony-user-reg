<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RegistrationFormType
 * @package App\Form
 */
class RegistrationFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Name'
            ])

            ->add('email', EmailType::class)

            ->add('password', RepeatedType::class, [

                'type' => PasswordType::class,
                'mapped' => false,

                'invalid_message' => 'password.match',
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat password'],

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

            ->add('photo', ImageType::class, [
                'required' => false,
                'label' => 'Photo'
            ])

            ->add('submit-btn', SubmitType::class, [
                'label' => 'Send'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'registration-form'
        ]);
    }
}
