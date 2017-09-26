<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BoxOneToManyController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Course;


class AssignUserHasCourseController extends BoxOneToManyController {

    const ASSOC_GROUP_NAME = 'user_has_course';
    const ASSOC_GROUP_NAME_KEY = 'course';

    const BOXLEFT_CLASS_PATH = User::class;
    const BOXLEFT_LIMIT = 20;
    const BOXLEFT_TITLE = 'Usuarios';
    const BOXLEFT_ICON = 'user';
    const BOXLEFT_GROUP_NAME = 'user';

    const BOXRIGHT_CLASS_PATH = Course::class;
    const BOXRIGHT_LIMIT = 20;
    const BOXRIGHT_TITLE = 'Cursos';
    const BOXRIGHT_ICON = 'globe';
    const BOXRIGHT_GROUP_NAME = 'course';


    public function indexAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomany');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $leftMapper
            ->add('limit', self::BOXLEFT_LIMIT)
            ->add('box_icon', self::BOXLEFT_ICON)
            ->add('box_title', self::BOXLEFT_TITLE)
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        $rightMapper
            ->add('limit', self::BOXRIGHT_LIMIT)
            ->add('box_icon', self::BOXRIGHT_ICON)
            ->add('box_title', self::BOXRIGHT_TITLE)
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::index($boxMapper, $leftMapper, $rightMapper);
    }

    public function assignAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomany');
        $boxMapper = $boxService->getBoxMapper();
        $rightMapper = $boxService->getBoxRightMapper();
        $leftMapper = $boxService->getBoxLeftMapper();

        $boxMapper
            ->add('collection_get', 'getCourse')
            ->add('collection_add', 'addCourse')
            ->add('collection_remove', 'removeCourse')
        ;

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
        ;

        return parent::assign($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxLeftSearchAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomany');
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
        $boxService = $this->get('core.service.boxonetomany');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
            ->add('assoc_group_name_key', self::ASSOC_GROUP_NAME_KEY)
        ;

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
        ;

        $rightMapper
            ->add('limit', self::BOXRIGHT_LIMIT)
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxRightSearch($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxleftHasBoxrightAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomany');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
            ->add('assoc_group_name_key', self::ASSOC_GROUP_NAME_KEY)
        ;

        $leftMapper
            ->add('limit', self::BOXLEFT_LIMIT)
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        return parent::boxleftHasBoxright($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function infoAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomany');
        $boxMapper = $boxService->getBoxMapper();

        return parent::info($request, $boxMapper);
    }

}
