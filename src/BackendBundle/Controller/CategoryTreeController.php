<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\TreeController;
use BackendBundle\Form\CategoryType;
use CoreBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;


class CategoryTreeController extends TreeController {

    const CLASS_PATH = Category::class;
    const GROUP_NAME = 'category';
    const FORM_TYPE = CategoryType::class;
    const SECTION_TITLE = 'Gestionar categorias';

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
