<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\TreeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Entity\TemplateECategory;
use BackendBundle\Form\TemplateECategoryType;
use CoreBundle\Services\Crud\Builder\CrudMapper;

class TemplateECategoryController extends TreeController
{

    const CLASS_PATH = TemplateECategory::class;
    const GROUP_NAME = 'template_e_category';
    const FORM_TYPE = TemplateECategoryType::class;
    const SECTION_TITLE = 'Gestionar template categories';

    public function indexAction()
    {
        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
            ->add('section_title', self::SECTION_TITLE)
        ;

        return parent::index($mapper);
    }

    public function createAction(Request $request)
    {
        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::create($request, $mapper);
    }

    public function createChildAction(Request $request)
    {

        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::createChild($request, $mapper);
    }

    public function editAction(Request $request)
    {

        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('form_type', self::FORM_TYPE)
            ->add('class_path', self::CLASS_PATH)
            ->add('group_name', self::GROUP_NAME)
        ;

        return parent::edit($request, $mapper);
    }

    public function deleteAction(Request $request)
    {
        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::delete($request, $mapper);
    }

    public function viewAction(Request $request)
    {
        $tree = $this->get('core.service.tree');
        $mapper = $tree->getTreeMapper();

        $mapper
            ->add('class_path', self::CLASS_PATH)
        ;

        return parent::view($request, $mapper);
    }

}
