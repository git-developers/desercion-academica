<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudUserController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Crud\Builder\CrudMapper;
use CoreBundle\Entity\User;
use BackendBundle\Form\UserType;

class UserController extends CrudUserController {

    const CLASS_PATH = User::class;
    const GROUP_NAME = 'user';
    const VIEW = 'User';
    const FORM_TYPE = UserType::class;
    const LIMIT_USER = 20;
    const GROUPS_VALIDATOR = 'registration_admin';


    public function indexAction()
    {

//
//        $user = $this->getUser();
//
//        if($user){
//            echo '<pre>';
//            print_r($user->getRoles());
//            exit;
//        }

        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('section_title', 'Gestionar usuarios')
            ->add('section_icon', 'user')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
            ->add('route_change_password', $this->generateUrl('backend_user_change_password'))
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('modal_create_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('modal_edit_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id + '</span>' ")
//            ->addColumn('Cliente', 'obj.client', [
//                'property' => '"<span class=\"label label-primary\">" + obj.client.id_increment  + "</span> " + obj.client.name',
//                'icon' => 'industry',
//            ])
            ->addColumn('Name', 'obj.name')
            ->addColumn('LastName', 'obj.lastName')
            ->addColumn('Username', 'obj.username')
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addButtonTable(['edit', 'delete', 'change_password'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id')
            ->addRowCallBack('data-id', 'aData.id')
            ->addRowCallBack('class', ' "alert" ')
        ;

//        $dataTable->setOptions([
//            'pageLength' => 20,
//        ]);

        return parent::index($crudMapper, $dataTable);
    }

    public function createAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('groups_validator', [self::GROUPS_VALIDATOR])
        ;

        return parent::create($request, $crudMapper);
    }

    public function editAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::edit($request, $crudMapper);
    }

    public function changepasswordAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::changepassword($request, $crudMapper);
    }

    public function deleteAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::delete($request, $crudMapper);
    }

    public function infoAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        return parent::info($request, $crudMapper);
    }

    public function viewAction(Request $request)
    {
        $crud = $this->get('core.service.cruduser');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::view($request, $crudMapper);
    }

    public function searchAction(Request $request)
    {
        $q = $request->get('q');
        $users = $this->em()->getRepository(self::CLASS_PATH)->search($q, self::LIMIT_USER);
        $users = $this->getSerializeDecode($users, self::GROUP_NAME);

        return $this->render(
            'BackendBundle:User:li_list_users.html.twig',
            [
                'users' => $users,
            ]
        );
    }

}
