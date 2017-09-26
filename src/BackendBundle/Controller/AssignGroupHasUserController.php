<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BoxOneToManyGroupController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\User;
use CoreBundle\Entity\GroupOfUsers;


class AssignGroupHasUserController extends BoxOneToManyGroupController {

    const COLLECTION_ADD = 'addUser';
    const COLLECTION_REMOVE = 'removeUser';

    const BOXLEFT_CLASS_PATH = GroupOfUsers::class;
    const BOXLEFT_TITLE = 'Grupos';
    const BOXLEFT_ICON = 'users';
    const BOXLEFT_GROUP_NAME = 'groupofusers';
    const BOXLEFT_LIMIT = 20;
    const BOXLEFT_GROUP_NAME_JOIN = 'user_of_group';

    const BOXMIDDLE_TITLE = 'Usuarios del grupo';
    const BOXMIDDLE_ICON = 'user';

    const BOXRIGHT_CLASS_PATH = User::class;
    const BOXRIGHT_TITLE = 'Todos los usuarios';
    const BOXRIGHT_ICON = 'user-plus';
    const BOXRIGHT_GROUP_NAME = 'user';
    const BOXRIGHT_LIMIT = 20;

    public function indexAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $middleMapper = $boxService->getBoxMiddleMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
            ->add('box_title', self::BOXLEFT_TITLE)
            ->add('box_icon', self::BOXLEFT_ICON)
            ->add('limit', self::BOXLEFT_LIMIT)
        ;

        $middleMapper
            ->add('box_title', self::BOXMIDDLE_TITLE)
            ->add('box_icon', self::BOXMIDDLE_ICON)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
            ->add('box_title', self::BOXRIGHT_TITLE)
            ->add('box_icon', self::BOXRIGHT_ICON)
            ->add('limit', self::BOXRIGHT_LIMIT)
        ;

        return parent::index($boxMapper, $leftMapper, $middleMapper, $rightMapper);
    }

    public function assignAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('collection_add', self::COLLECTION_ADD)
        ;

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::assign($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function unAssignAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('collection_remove', self::COLLECTION_REMOVE)
        ;

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
        ;

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::unAssign($request, $boxMapper, $leftMapper, $rightMapper);
    }

    public function boxleftHasBoxrightAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
            ->add('group_name_join', self::BOXLEFT_GROUP_NAME_JOIN)
        ;

        $rightMapper
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxleftHasBoxright($request, $leftMapper, $rightMapper);
    }

    public function boxLeftSearchAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $leftMapper = $boxService->getBoxLeftMapper();

        $leftMapper
            ->add('class_path', self::BOXLEFT_CLASS_PATH)
            ->add('group_name', self::BOXLEFT_GROUP_NAME)
            ->add('limit', self::BOXLEFT_LIMIT)
        ;

        return parent::boxLeftSearch($request, $leftMapper);
    }

    public function boxRightSearchAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $rightMapper = $boxService->getBoxRightMapper();

        $rightMapper
            ->add('class_path', self::BOXRIGHT_CLASS_PATH)
            ->add('limit', self::BOXRIGHT_LIMIT)
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxRightSearch($request, $rightMapper);
    }

    public function infoAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanygroup');
        $boxMapper = $boxService->getBoxMapper();

        return parent::info($request, $boxMapper);
    }

}
