<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Entity\TemplateModule;
use BackendBundle\Form\TemplateModuleType;
use CoreBundle\Services\Crud\Builder\CrudMapper;

class TemplateModuleController extends CrudController
{

    const CLASS_PATH = TemplateModule::class;
    const GROUP_NAME = 'template_module';
    const FORM_TYPE = TemplateModuleType::class;

    public function indexAction()
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('section_title', 'Gestionar template modules')
            ->add('section_icon', 'object-ungroup')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
            ->addColumn('Order', 'obj.module_order')
            ->addColumn('Type', " '<small class=\"label label-primary\">' + obj.type + '</small>' ")
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
