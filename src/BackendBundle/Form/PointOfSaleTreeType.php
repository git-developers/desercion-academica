<?php

namespace BackendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use CoreBundle\Entity\PointOfSale;

class PointOfSaleTreeType extends AbstractType
{

    protected $em;
    protected $parentId;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getParentItem($id) {
        return $this->em->getRepository(PointOfSale::class)->find($id);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {

        $em = $this->em;
        $this->parentId = $options['parent_id'];

        $builder
            ->add('code', TextType::class, [
                'label' => 'code',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'code',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'latitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'longitude',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'nombre',
                ],
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($em) {
            $data = $event->getData();
            $form = $event->getForm();

            $options = [
                'class' => PointOfSale::class,
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
                'label' => 'PointOfSale',
                'label_attr' => [
                    'class' => ''
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ];

            if($this->parentId != null){
                $data = ['data' => $this->getParentItem($this->parentId)];
                $options = array_merge($options, $data);
            }

            $form->add('pointOfSale', EntityType::class, $options);

        });


    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PointOfSale::class
        ]);

        $resolver->setRequired('parent_id');
    }

}
