<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class ChangePasswordType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'El password de confirmación no coincide.',
                'options' => [
                    'attr' => [
                        'class' => 'password-field form-control',
                        'placeholder' => '****',
                    ]
                ],
                'required' => true,
                'first_options'  => ['label' => 'Nuevo password'],
                'second_options' => ['label' => 'Confirmar password'],
            ])
            ->add('togglePassword', CheckboxType::class, [
                'label' =>' Mostrar password',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
                    'style' => 'width:20px; height:20px; margin-right:5px',
                    'placeholder' => '',
                ],
            ])
        ;
    }

}
