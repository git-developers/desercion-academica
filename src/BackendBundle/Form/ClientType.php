<?php

namespace BackendBundle\Form;

use CoreBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name', TextType::class, [
                'label' =>' Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'description',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'description',
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
