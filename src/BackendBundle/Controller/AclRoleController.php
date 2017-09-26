<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Role;
use BackendBundle\Form\RoleType;
use CoreBundle\Services\Crud\Builder\CrudMapper;


class AclRoleController extends CrudController
{

    const CLASS_PATH = Role::class;
    const GROUP_NAME = 'role';
    const FORM_TYPE = RoleType::class;


    public function indexAction()
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('section_icon', 'expeditedssl')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
            ->add('section_title', 'Gestionar role')
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
            ->addColumn('Group rol name', 'obj.group_rol')
            ->addColumn('Group rol tag', 'obj.group_rol_tag')
            ->addColumn('Action name', 'obj.name')
            ->addColumn('Role', " '<small class=\"label label-primary\">' + obj.slug + '</small>' ")
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addButtonTable(['edit', 'delete'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
            ->addRowCallBack('class', ' "alert" ')
        ;

        $dataTable->setOptions([
            'pageLength' => 20,
        ]);

        return parent::index($crudMapper, $dataTable);
    }

    public function createAction(Request $request)
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::create($request, $crudMapper);
    }

    public function editAction(Request $request)
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::edit($request, $crudMapper);
    }

    public function deleteAction(Request $request)
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::delete($request, $crudMapper);
    }

    public function infoAction(Request $request)
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        return parent::info($request, $crudMapper);
    }

    public function viewAction(Request $request)
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::view($request, $crudMapper);
    }
}
