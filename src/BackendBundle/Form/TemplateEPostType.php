<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Entity\TemplateECategory;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEPost;
use Doctrine\ORM\EntityManager;


class TemplateEPostType extends AbstractType
{

    protected $em;
    protected $templateHasModule;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getTemplateHasModuleId($options) {
        return isset($options['form_data']['template_has_module_id']) ? $options['form_data']['template_has_module_id'] : null;
    }

    public function getTemplateHasModule($id) {

        if(!$id){
            return;
        }

        return $this->em->getRepository(TemplateHasModule::class)->find($id);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $templateHasModuleId = $this->getTemplateHasModuleId($options);
        $this->templateHasModule = $this->getTemplateHasModule($templateHasModuleId);

        $builder
            ->add('templateHasModule', EntityType::class, [
                'class' => TemplateHasModule::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'data' => $this->templateHasModule,
                'empty_data' => null,
                'required' => false,
                'label' => 'templateHasModule',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('templateECategory', EntityType::class, [
                'class' => TemplateECategory::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => true,
                'label' => 'template category',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'title',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'title',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'title',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'content',
                ],
            ])
            ->add('excerpt', TextType::class, [
                'label' => 'excerpt',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'excerpt',
                ],
            ])
            ->add('keyword', TextType::class, [
                'label' => 'keyword',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'keyword',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn bg-olive margin',
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
            'data_class' => TemplateEPost::class
        ]);

        $resolver->setRequired(['form_data']);
    }

}
