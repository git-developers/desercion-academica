<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\Template;
use CoreBundle\Entity\TemplateModule;


class TemplateHasModuleType extends AbstractType
{
    protected $em;
    protected $templateHasModule;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {

        $parent = $options['parent'];
        $leftSelectedValue = $options['left_selected_value'];
        $this->templateHasModule = $this->getTemplateHasModule($parent);

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
            ->add('template', EntityType::class, [
                'class' => Template::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->findAllObjects();
                },
                'placeholder' => '[ Escoge una opción ]',
                'data' => $this->getTemplate($leftSelectedValue),
                'empty_data' => null,
                'required' => true,
                'label' => 'Template',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('module', EntityType::class, [
                'class' => TemplateModule::class,
                'query_builder' => function(EntityRepository $er) {

                    $moduleObj = is_object($this->templateHasModule) ? $this->templateHasModule->getModule() : null;
                    $moduleId = is_object($moduleObj) ? $moduleObj->getIdIncrement() : null;

                    if($moduleId){
                        return $er->findAllObjectsExclude($moduleId);
                    }

                    return $er->findAllObjects();

                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'module',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('path', TextType::class, [
                'label' => 'path',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'index : blog : blog/{slug} : paragraph/5',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'name',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Index : Blog : Blog post : Paragraph - 1',
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
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TemplateHasModule::class,
        ]);

        $resolver->setRequired(['parent', 'left_selected_value']);
    }

    private function getTemplate($id) {

        if(!$id){
            return;
        }

        return $this->em->getRepository(Template::class)->find($id);
    }

    private function getTemplateHasModule($id) {

        if(!$id){
            return;
        }

        return $this->em->getRepository(TemplateHasModule::class)->find($id);
    }

}
