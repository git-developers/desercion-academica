<?php

namespace BackendBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManager;
use CoreBundle\Entity\Qr;

class QrType extends AbstractType
{

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getChs() {
        $array['500x500'] = '500x500';
        $array['300x300'] = '300x300';
        $array['200x200'] = '200x200';

        return $array;
    }

    public function getChoe() {
        $array['UTF-8'] = 'UTF-8';
        $array['Shift_JIS'] = 'Shift_JIS';
        $array['ISO-8859-1'] = 'ISO-8859-1';

        return $array;
    }

    public function getChld() {
        $array['Allows recovery of up to 7% data loss'] = 'L';
        $array['Allows recovery of up to 15% data loss'] = 'M';
        $array['Allows recovery of up to 25% data loss'] = 'Q';
        $array['Allows recovery of up to 30% data loss'] = 'H';

        return $array;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('chl', TextType::class, [
                'label'=>'Data',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'attr' => [
                    'class' => 'form-control col-md-1',
                    'placeholder' => 'data',
                    'required' => true,
                ],
                'error_bubbling' => true
            ])
            ->add('chs', ChoiceType::class, [
                //                'class' => 'BackendBundle:Profile',
                'choices' => $this->getChs(),
//                'placeholder' => '[ Escoge una opción ]',
                'empty_data' => null,
                'label'=>'Tamaño',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('choe', ChoiceType::class, [
                'choices' => $this->getChoe(),
                'empty_data' => null,
                'label'=>'Encode',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'attr' => [
                    'class' => 'form-control col-md-1',
                    'placeholder' => '',
                ],
            ])
            ->add('chld', ChoiceType::class, [
                'choices' => $this->getChld(),
                'empty_data' => null,
                'label'=>'Niveles de corrección de errores',
                'label_attr' => [
                    'class' => 'control-label'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr'       => array(
                    'class' => 'btn btn-info pull-right',
                ),
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Qr::class,
        ]);
    }

}
