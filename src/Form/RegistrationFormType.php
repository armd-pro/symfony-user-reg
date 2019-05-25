<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormField;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolver;
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

            ->add('name', FormField\TextType::class, [
                'label' => 'Name'
            ])

            ->add('email', FormField\EmailType::class)

            ->add('password', FormField\RepeatedType::class, [

                'type' => FormField\PasswordType::class,
                'mapped' => false,

                'invalid_message' => 'password.match',
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat password'],

                'constraints' => [

                    new Assert\NotBlank([
                        'message' => 'password.empty',
                    ]),

                    new Assert\Length([
                        'min' => 6,
                        'minMessage' => 'password.min-length',
                        'max' => 4096,
                    ]),

                ],
            ])

            ->add('photo', ImageType::class, [
                'required' => false,
                'label' => 'Photo',
                'constraints' => [
                    new Assert\Image([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/gif',
                            'image/png',
                        ],
                        'minWidth'  => 200,
                        'minHeight' => 200,
                        'maxWidth'  => 600,
                        'maxHeight' => 600
                    ]),
                ]
            ])

            ->add('submit-btn', FormField\SubmitType::class, [
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
