<?php

namespace BackendBundle\Form;

use CoreBundle\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class CourseType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('ciclo', ChoiceType::class, [
                'label' => 'Ciclo',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombre',
                ],
	            'choices'  => [
		            '01' => '1',
		            '02' => '2',
		            '03' => '3',
		            '04' => '4',
		            '05' => '5',
		            '06' => '6',
		            '07' => '7',
		            '08' => '8',
		            '09' => '9',
		            '10' => '10',
	            ],
            ])
	        ->add('rangeStart', TimeType::class, [
		        'input'  => 'datetime',
		        'widget' => 'choice',
		        'label' => 'Rango Hora de inicio',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control required',
			        'placeholder' => '',
		        ],
	        ])
	        ->add('rangeEnd', TimeType::class, [
		        'input'  => 'datetime',
		        'widget' => 'choice',
		        'label' => 'Rango Hora fin',
		        'label_attr' => [
			        'class' => ''
		        ],
		        'attr' => [
			        'class' => 'form-control required',
			        'placeholder' => '',
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
            'data_class' => Course::class,
        ]);

        $resolver->setRequired(['form_data']);
    }

}
