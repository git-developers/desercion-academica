<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Course;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Assistance;

class RegisterAttendanceStudentController extends BaseController
{

    public function listadoCursosAction()
    {

        $user = $this->getUser();

        if(!$user){
             throw $this->createNotFoundException('SISTEMA: tiene que logearse para tener el objeto usuario');
        }

        $entities = $this->em()->getRepository(Course::class)->findAllByUserId($user->getId());
        $entities = $this->getSerializeDecode($entities, 'course_has_user');

        return $this->render(
            'BackendBundle:RegisterAttendanceStudent:listado-cursos.html.twig',
            [
                'entities' => $entities,
            ]
        );
    }

    public function listadoAlumnosAction(Request $request, $curso_id)
    {

        $course = $this->em()->getRepository(Course::class)->find($curso_id);

        if(!$course){
            throw $this->createNotFoundException('SISTEMA: el curso no existe');
        }

        $entities = $this->em()->getRepository(User::class)->findAllByCourseId($curso_id, 'alumno');
        $entities = $this->getSerializeDecode($entities, 'course_has_user');


        if ($request->isMethod('POST')) {

            $obj = $request->get('obj');

            foreach ($obj as $key => $value){


                $userId = isset($value['user_id']) ? $value['user_id'] : null;
                $attended = isset($value['attended']) ? $value['attended'] : 0;

                $user = $this->em()->getRepository(User::class)->find($userId);

                if(!$user){
                    continue;
                }

                $assistance = new Assistance();
                $assistance->setUser($user);
                $assistance->setAttended($attended);
                $this->persist($assistance);
            }

            $this->flashSuccess('Se guardo con exito la asistencia');

            $url = $this->generateUrl('backend_registerattendancestudent_listado_alumnos', ['curso_id' => $course->getIdIncrement()]);

            return $this->redirect($url);

        }



        return $this->render(
            'BackendBundle:RegisterAttendanceStudent:listado-alumnos.html.twig',
            [
                'course' => $course,
                'entities' => $entities,
            ]
        );
    }



}
