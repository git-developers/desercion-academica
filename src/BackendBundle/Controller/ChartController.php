<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CoreBundle\Form\AclMaskType;
use CoreBundle\Entity\AclMask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class ChartController extends Controller {

    public function pieChartAction()
    {

        return $this->render(
            'BackendBundle:Chart:pie_chart.html.twig',
            [
                'entitiesJson' => null,
            ]
        );
    }

    public function columnChartAction()
    {

        return $this->render(
            'BackendBundle:Chart:column_chart.html.twig',
            [
                'entitiesJson' => null,
            ]
        );
    }

}
