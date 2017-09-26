<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use CoreBundle\Entity\Role;
use CoreBundle\Entity\Profile;
use Doctrine\ORM\EntityManager;


class ProfileType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getRoles() {
        $roleRepository = $this->em->getRepository(Role::class);
        return $roleRepository->findAll();
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre del perfil',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'e.g. conductor, editor, redactor',
                ],
            ])
            ->add('role', EntityType::class, [
                'choices' => $this->getRoles(),
                'class' => Role::class,
                'required' => true,
                'empty_data' => null,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Profiles roles',
                'label_attr' => ['class' => ''],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('toggleCheckbox', CheckboxType::class, [
                'label' =>'Check all',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
                    'placeholder' => '',
                ],
            ])
            ->add('collapsedBox', CheckboxType::class, [
                'label' =>'Collapsed Box',
                'required' => false,
//                'data' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => '',
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
            'data_class' => Profile::class
        ]);

        $resolver->setRequired(['form_data']);
    }

}
