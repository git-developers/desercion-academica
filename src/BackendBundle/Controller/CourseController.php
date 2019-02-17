<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\CrudController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Crud\Builder\CrudMapper;
use CoreBundle\Entity\Course;
use BackendBundle\Form\CourseType;

class CourseController extends CrudController {

    const CLASS_PATH = Course::class;
    const GROUP_NAME = 'course';
    const FORM_TYPE = CourseType::class;
	
	
	public function index3Action()
	{
		$crud = $this->get('core.service.crud');
		$crudMapper = $crud->getCrudMapper();
		$dataTable = $crud->getDataTableMapper();
		
		$crudMapper
			->add('section_title', 'Gestionar cursos')
			->add('section_icon', 'book')
			->add('class_path', self::CLASS_PATH)
			->add('group_name', self::GROUP_NAME)
			->add('section_box_class', 'primary')
			->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
			->add('test', 'test', [
				'label' => '',
			])
		;
		
		$dataTable
			->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
			->addColumn('Name', 'obj.name')
			->addColumn('Ciclo', 'obj.ciclo')
			->addColumn('Rango inicio', 'obj.range_start', [
				'icon' => 'clock-o'
			])
			->addColumn('Rango fin', 'obj.range_end', [
				'icon' => 'clock-o'
			])
//            ->addColumn('description', 'obj.description')
			->addColumn('Creado', 'obj.created_at', [
				'icon' => 'calendar'
			])
			->addButtonTable(['edit', 'delete'], 'obj.id_increment')
			->addButtonHeader(['create', 'info'])
			->addRowCallBack('id', 'aData.id_increment')
			->addRowCallBack('data-id', 'aData.id_increment')
			->addRowCallBack('class', ' "alert" ')
		;

//        $dataTable->setOptions([
//            'pageLength' => 20,
//        ]);
		
		return parent::index($crudMapper, $dataTable);
		
	}


    public function indexAction()
    {
        $crud = $this->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();
        $dataTable = $crud->getDataTableMapper();

        $crudMapper
            ->add('section_title', 'Gestionar cursos')
            ->add('section_icon', 'book')
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_box_class', 'primary')
            ->add('modal_info_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
            ->addColumn('Name', 'obj.name')
//            ->addColumn('description', 'obj.description')
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addButtonTable(['edit', 'delete'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
            ->addRowCallBack('class', ' "alert" ')
        ;

//        $dataTable->setOptions([
//            'pageLength' => 20,
//        ]);

        return parent::index2($crudMapper, $dataTable);

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
