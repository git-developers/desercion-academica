<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Course;
use CoreBundle\Entity\Exam;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Grades;
use CoreBundle\Entity\Assistance;

class CompareGradesController extends BaseController
{

    public function indexAction()
    {

        $user = $this->getUser();

        if(!$user){
             throw $this->createNotFoundException('SISTEMA: tiene que logearse para tener el objeto usuario');
        }

        $courses = $this->em()->getRepository(Course::class)->findAllByUserId($user->getId());
        $courses = $this->getSerializeDecode($courses, 'course_has_user');


//        echo '<pre> POLLO:: ';
//        print_r($courses);
//        exit;


        return $this->render(
            'BackendBundle:CompareGrades:index.html.twig',
            [
                'courses' => $courses,
            ]
        );
    }

}
