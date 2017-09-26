<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\ListHasTreeController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Template;
use CoreBundle\Entity\TemplateModule;
use CoreBundle\Entity\TemplateHasModule;
use BackendBundle\Form\TemplateHasModuleType;
use BackendBundle\Form\TemplateHasModuleEditType;
use CoreBundle\Services\ListHasTree\Builder\BoxRightMapper;


class AssignTemplateHasModuleController extends ListHasTreeController {

    const ASSIGN_CLASS_PATH = TemplateHasModule::class;
    const ASSIGN_FORM_TYPE = TemplateHasModuleType::class;
    const ASSIGN_FORM_EDIT_TYPE = TemplateHasModuleEditType::class;
    const ASSIGN_GROUP_NAME = 'template_has_module';
    const ASSIGN_GROUP_NAME_KEY = 'module';

    const BOXLEFT_CLASS_PATH = Template::class;
    const BOXLEFT_TITLE = 'Template';
    const BOXLEFT_ICON = 'object-group';
    const BOXLEFT_GROUP_NAME = 'template';
    const BOXLEFT_LIMIT = 20;

    const BOXRIGHT_TITLE = 'Modules';
    const BOXRIGHT_ICON = 'file-text-o';
    const BOXRIGHT_GROUP_NAME = 'template_module';
    const BOXRIGHT_CLASS_PATH = TemplateModule::class;


    public function indexAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_group_name_key', self::ASSIGN_GROUP_NAME_KEY)
        ;

        $leftMapper
            ->add('limit', self::BOXLEFT_LIMIT)
            ->add('box_icon', self::BOXLEFT_ICON)
            ->add('box_title', self::BOXLEFT_TITLE)
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        $rightMapper
            ->add('box_icon', self::BOXRIGHT_ICON)
            ->add('box_title', self::BOXRIGHT_TITLE)
            ->add('modal_assign_size', BoxRightMapper::MODAL_SIZE_LARGE)
            ->add('modal_assign_child_size', BoxRightMapper::MODAL_SIZE_LARGE)
//            ->add('modal_assign_edit_size', BoxRightMapper::MODAL_SIZE_LARGE)
        ;

        return parent::index($boxMapper, $leftMapper, $rightMapper);
    }

    public function boxleftHasBoxrightAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_form_type', self::ASSIGN_FORM_TYPE)
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
            ->add('assign_group_name_key', self::ASSIGN_GROUP_NAME_KEY)
        ;

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        $rightMapper
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxleftHasBoxright($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxRightAssignAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_form_type', self::ASSIGN_FORM_TYPE)
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxRightAssign($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxRightAssignEditAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
            ->add('assign_form_edit_type', self::ASSIGN_FORM_EDIT_TYPE)
        ;

        return parent::boxRightAssignEdit($request, $boxMapper, $rightMapper);
    }

    public function boxRightAssignChildAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_form_type', self::ASSIGN_FORM_TYPE)
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxRightAssignChild($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxRightUnAssignAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();

        $boxMapper
            ->add('assign_form_type', self::ASSIGN_FORM_TYPE)
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
        ;

        return parent::boxRightUnAssign($request, $boxMapper);
    }

    public function boxRightAssignViewAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assign_class_path', self::ASSIGN_CLASS_PATH)
            ->add('assign_group_name', self::ASSIGN_GROUP_NAME)
        ;

        return parent::boxRightAssignView($request, $boxMapper, $rightMapper);
    }

    public function boxLeftSearchAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $leftMapper = $boxService->getBoxLeftMapper();

        $leftMapper
            ->add('limit', self::BOXLEFT_LIMIT)
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        return parent::boxLeftSearch($request, $leftMapper);
    }

    public function boxRightSearchAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $rightMapper = $boxService->getBoxRightMapper();

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxRightSearch($request, $rightMapper);
    }

    public function infoAction(Request $request)
    {
        $boxService = $this->get('core.service.listhastree');
        $boxMapper = $boxService->getBoxMapper();

        return parent::info($request, $boxMapper);
    }

}
