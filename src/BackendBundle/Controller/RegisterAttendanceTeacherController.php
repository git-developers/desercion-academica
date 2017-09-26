<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;

class RegisterAttendanceTeacherController extends BaseController
{

    public function indexAction()
    {
        return $this->render(
            'BackendBundle:RegisterAttendanceTeacher:index.html.twig',
            [
                'crud' => '',
            ]
        );
    }

}
