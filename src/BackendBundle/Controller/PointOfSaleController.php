<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\PointOfSale;
use BackendBundle\Form\PointOfSaleType;
use CoreBundle\Services\Crud\Builder\CrudMapper;

class PointOfSaleController extends CrudController {

    const CLASS_PATH = PointOfSale::class;
    const GROUP_NAME = 'pointofsale';
    const FORM_TYPE = PointOfSaleType::class;


    public function indexAction()
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('section_title', 'Gestionar puntos de venta')
            ->add('section_icon', 'home')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
            ->addColumn('Code', " '<small class=\"label label-success\">' + obj.code + '</small>' ")
            ->addColumn('Name', 'obj.name')
            ->addColumn('latitude', 'obj.latitude', [
                'icon' => 'map-marker'
            ])
            ->addColumn('longitude', 'obj.longitude', [
                'icon' => 'map-marker'
            ])
            ->addColumn('Slug', 'obj.slug')
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addButtonTable(['edit', 'delete'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
            ->addRowCallBack('class', ' "alert" ')
        ;

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
