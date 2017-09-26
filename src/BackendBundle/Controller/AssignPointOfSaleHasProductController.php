<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BoxOneToManyAssocController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Product;
use CoreBundle\Entity\PointOfSale;
use CoreBundle\Entity\PointOfSaleHasProduct;
use BackendBundle\Form\PointOfSaleHasProductType;


class AssignPointOfSaleHasProductController extends BoxOneToManyAssocController {

    const ASSOC_GROUP_NAME = 'pointofsales_has_product';
    const ASSOC_GROUP_NAME_RIGHT = 'product';
    const ASSOC_ENTITY = PointOfSaleHasProduct::class;
    const ASSOC_CLASS_PATH = PointOfSaleHasProduct::class;
    const ASSOC_FORM_TYPE = PointOfSaleHasProductType::class;

    const BOXLEFT_CLASS_PATH = PointOfSale::class;
    const BOXLEFT_LIMIT = 20;
    const BOXLEFT_TITLE = 'Puntos de venta';
    const BOXLEFT_ICON = 'globe';
    const BOXLEFT_GROUP_NAME = 'pointofsale';
    const BOXLEFT_COLLECTION = 'setPointOfSale';

    const BOXRIGHT_CLASS_PATH = Product::class;
    const BOXRIGHT_LIMIT = 20;
    const BOXRIGHT_TITLE = 'Producto';
    const BOXRIGHT_ICON = 'cube';
    const BOXRIGHT_GROUP_NAME = 'product';
    const BOXRIGHT_COLLECTION = 'setProduct';


    public function indexAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanyassoc');
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
        $boxService = $this->get('core.service.boxonetomanyassoc');
        $boxMapper = $boxService->getBoxMapper();
        $rightMapper = $boxService->getBoxRightMapper();
        $leftMapper = $boxService->getBoxLeftMapper();

        $boxMapper
            ->add('assoc_entity', self::ASSOC_ENTITY)
            ->add('assoc_class_path', self::ASSOC_CLASS_PATH)
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
            ->add('assoc_boxleft_collection', self::BOXLEFT_COLLECTION)
            ->add('assoc_boxright_collection', self::BOXRIGHT_COLLECTION)
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
        $boxService = $this->get('core.service.boxonetomanyassoc');
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
        $boxService = $this->get('core.service.boxonetomanyassoc');
        $boxMapper = $boxService->getBoxMapper();
        $leftMapper = $boxService->getBoxLeftMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assoc_entity', self::ASSOC_ENTITY)
            ->add('assoc_class_path', self::ASSOC_CLASS_PATH)
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
            ->add('assoc_boxleft_collection', self::BOXLEFT_COLLECTION)
            ->add('assoc_boxright_collection', self::BOXRIGHT_COLLECTION)
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
        $boxService = $this->get('core.service.boxonetomanyassoc');
        $boxMapper = $boxService->getBoxMapper();
        $rightMapper = $boxService->getBoxRightMapper();

        $boxMapper
            ->add('assoc_entity', self::ASSOC_ENTITY)
            ->add('assoc_class_path', self::ASSOC_ENTITY)
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
            ->add('assoc_boxleft_collection', self::BOXLEFT_COLLECTION)
            ->add('assoc_boxright_collection', self::BOXRIGHT_COLLECTION)
        ;

        $rightMapper
            ->add('group_name', self::BOXRIGHT_GROUP_NAME)
        ;

        return parent::boxleftHasBoxright($request, $boxMapper, $rightMapper);
    }

    public function associativeEditAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanyassoc');
        $boxMapper = $boxService->getBoxMapper();

        $boxMapper
            ->add('assoc_entity', self::ASSOC_ENTITY)
            ->add('assoc_form_type', self::ASSOC_FORM_TYPE)
            ->add('assoc_class_path', self::ASSOC_CLASS_PATH)
            ->add('assoc_group_name', self::ASSOC_GROUP_NAME)
        ;

        return parent::associativeEdit($request, $boxMapper);
    }

    public function infoAction(Request $request)
    {
        $boxService = $this->get('core.service.boxonetomanyassoc');
        $boxMapper = $boxService->getBoxMapper();

        return parent::info($request, $boxMapper);
    }

}
