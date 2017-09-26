<?php

namespace CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use CoreBundle\Entity\AclMask;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;


class AclMaskType extends AbstractType
{

    private $container;
    private $em;

    public function __construct(Container $container) {

        $this->container = $container;
        $this->em = $this->container->get('doctrine')->getManager();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


//        const MASK_VIEW = 1;           // 1 << 0
//        const MASK_CREATE = 2;         // 1 << 1
//        const MASK_EDIT = 4;           // 1 << 2
//        const MASK_DELETE = 8;         // 1 << 3
//        const MASK_UNDELETE = 16;      // 1 << 4
//        const MASK_OPERATOR = 32;      // 1 << 5
//        const MASK_MASTER = 64;        // 1 << 6
//        const MASK_OWNER = 128;        // 1 << 7
//        const MASK_IDDQD = 1073741823; // 1 << 0 | 1 << 1 | ... | 1 << 30

        $builder
            ->add('entry', HiddenType::class, array(
                'label' => false,
                'label_attr' => [],
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ))
            ->add('view', CheckboxType::class, array(
                'label' => 'view',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_VIEW,
                ],
                'error_bubbling' => true
            ))
            ->add('create', CheckboxType::class, array(
                'label' => 'create',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_CREATE,
                ],
                'error_bubbling' => true
            ))
            ->add('edit', CheckboxType::class, array(
                'label' => 'edit',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_EDIT,
                ],
                'error_bubbling' => true
            ))
            ->add('delete', CheckboxType::class, array(
                'label' => 'delete',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_DELETE,
                ],
                'error_bubbling' => true
            ))
            ->add('undelete', CheckboxType::class, array(
                'label' => 'undelete',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_UNDELETE,
                ],
                'error_bubbling' => true
            ))
            ->add('operator', CheckboxType::class, array(
                'label' => 'operator',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_OPERATOR,
                ],
                'error_bubbling' => true
            ))
            ->add('master', CheckboxType::class, array(
                'label' => 'master',
                'label_attr' => [
                    'class' => 'col-sm-2 control-label'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'data',
                    'value' => MaskBuilder::MASK_MASTER,
                ],
                'error_bubbling' => true
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar',
                'attr' => array(
                    'class' => 'btn btn-outline',
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AclMask::class,

        ));
    }

}
