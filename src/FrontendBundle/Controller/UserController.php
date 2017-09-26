<?php

namespace FrontendBundle\Controller;

use CoreBundle\Controller\CrudController;
use CoreBundle\Entity\User;
use FrontendBundle\Form\UserRegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use JMS\Serializer\SerializationContext;
use CoreBundle\Services\Crud\Builder\CrudMapper;


class UserController extends CrudController
{

    public function indexAction()
    {

        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTableMapper = $crud->getDataTableMapper();

        $crudMapper
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('section_title', 'Lista de usuarios')
            ->add('section_icon', 'fa-user')
            ->add('class_path', User::class)
            ->add('group_name', 'user')
            ->add('section_box_class', 'success')
        ;

        $dataTableMapper
            ->addColumn('#', [
                'field' => 'id_increment',
                'tag' => '<span class="pull-right badge bg-blue">31</span>',
            ])
            ->addColumn('Name', 'obj.name')
            ->addColumn('Creado', 'obj.created_at')
//            ->addButton(['edit', 'delete'], 'obj.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
        ;

        return parent::index($crudMapper, $dataTableMapper);
    }

    /*
    public function createAction(Request $request)
    {

        $entity = new User();
        $entity->setImage(new File('bundles/core/common/images/no_avatar.jpg'));
        $form = $this->createForm(UserRegisterType::class, $entity, ['attr' => ['class' => 'form-horizontal']]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $form->get('password')->getData();
            $password = $this->get('security.password_encoder')->encodePassword($entity, $password);
            $entity->setPassword($password);

            $entity->setImage(null);
            $this->save($entity);
            $this->flashSuccess('Cuenta creada, puedes iniciar sesión.');

            return $this->redirectToRoute('frontend_default_index');
//            return $this->redirectToRoute('frontend_security_login');
        }

        $response = $this->render(
            'FrontendBundle:User:create.html.twig',
            [
                'formEntity' => $form->createView(),
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;

    }
    */


//            $factory = $this->get('security.encoder_factory');
//            $encoder = $factory->getEncoder($entity);
//            $passwordEncode = $encoder->encodePassword($password, $entity->getSalt());
//            $entity->setPassword($passwordEncode);



}
