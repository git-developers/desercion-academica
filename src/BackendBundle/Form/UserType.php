<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Profile;
use CoreBundle\Entity\Client;


// http://symfony.com/doc/current/form/form_dependencies.html

class UserType extends AbstractType
{

    protected $em;

    public function __construct(EntityManager $em) {
//        $this->em = $this->container->get('doctrine')->getManager();
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $em = $this->container->get('doctrine')->getManager();
//        $em = $options['entity_manager'];

        $builder
            ->add('client', EntityType::class, array(
                'class' => Client::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->where('a.isActive = :active')
                        ->orderBy('a.idIncrement', 'DESC')
                        ->setParameter('active', true)
                        ;
//                        ->add('orderBy', 's.sort_order ASC')
//                        ->innerJoin('a.languages', 'b')
//                        ->addSelect('b')
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'Cliente',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ))
            ->add('profile', EntityType::class, array(
                'class' => Profile::class,
                'query_builder' => function(EntityRepository $a) {
                    return $a->createQueryBuilder('a')
                        ->where('a.isActive = :active')
                        ->orderBy('a.idIncrement', 'DESC')
                        ->setParameter('active', true)
                        ;
//                        ->add('orderBy', 's.sort_order ASC')
//                        ->innerJoin('a.languages', 'b')
//                        ->addSelect('b')
                },
                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'required' => false,
                'label' => 'Profile',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ))
            ->add('phone', IntegerType::class, [
                'label' => 'Telefono',
                'required' => false,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'ingrese el telefono del usuario',
                ],
                'error_bubbling' => true
            ])
            ->add('dob', DateType::class , [
                'label' => 'Fecha de nacimiento',
                'required' => false,
                'widget' => 'single_text',
                'label_attr' => [
                    'class' => ''
                ],
//                'format' => 'dd-MM-yyyy',
//                'years' => range(date('Y') -18, date('Y') -80),
//                'placeholder' => array(
//                    'year' => 'Año', 'month' => 'Mes', 'day' => 'Dia',
//                ),
                'attr' => [
                    'class' => 'form-control',
                    'title'=>'',
                ],
                'error_bubbling' => true
            ])
//            ->add('password', PasswordType::class, array(
//                'label' => 'Password',
//                'required' => false,
//                'label_attr' => array('class' => ''),
//                'attr' => array(
//                    'class' => 'form-control',
//                    'placeholder' => 'password',
//                ),
//            ))
//            ->add('username', TextType::class, array(
//                'label' => 'Username',
//                'required' => false,
//                'label_attr' => array('class' => ''),
//                'attr' => array(
//                    'class' => 'form-control',
//                    'placeholder' => 'username',
//                ),
//                'error_bubbling' => true
//            ))
//            ->add('image', FileType::class , [
//                'label' => 'Selecciona tu foto',
//                'required' => true,
//                'label_attr' => ['class' => ''],
//                'attr' => [
//                    'class' => 'form-control',
//                    'title'=>'',
//                ],
//                'data_class' => null,
//                'error_bubbling' => true
//            ])
            ->add('dni', TextType::class, [
                'label' => 'Dni',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'dni (8 caracteres)',
                    'pattern'=>'[0-9]{8}',
                    'maxlength'=>'8',
                    'minlength'=>'8',
//                    'form'=>'user-form',
                ],
                'error_bubbling' => true
            ])
            ->add('name', TextType::class, [
                'label' =>' Nombres',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'nombres',
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Apellidos',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'apellidos',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'required' => true,
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control required',
                    'placeholder' => 'test@test.com',
                ],
                //'error_bubbling' => true
            ])
        ;


        /*
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();
        });
        */

    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
//            'cascade_validation' => true,
        ));
//        $resolver->setRequired('entity_manager');
    }

}
