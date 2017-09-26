<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use CoreBundle\Entity\TemplateHasModule;


class TemplateHasModuleEditType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('path', TextType::class, [
                'label' => 'path',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'path',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'name',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'name',
                ],
            ])
            ->add('templateName', ChoiceType::class, [
                'choices' => TemplateHasModule::CHOICES_TEMPLATE_HTML,
                'required' => false,
                'placeholder' => '[ sin template ]',
                'label' => 'Template name',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('settings', TextType::class, [
                'label' => 'settings',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'settings',
                ],
            ])
        ;
    }

    public function getBlockPrefix() {
        return 'template_has_module';
        return null;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TemplateHasModule::class,
        ]);
    }
}
