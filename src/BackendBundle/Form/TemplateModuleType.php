<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use CoreBundle\Entity\TemplateModule;


class TemplateModuleType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('moduleOrder', IntegerType::class, [
                'label' => 'moduleOrder',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'moduleOrder',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => TemplateModule::TYPE_CHOICES,
                'label' => 'type',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'type',
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
            'data_class' => TemplateModule::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
