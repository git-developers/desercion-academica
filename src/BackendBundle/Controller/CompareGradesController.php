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

        return $this->render(
            'BackendBundle:CompareGrades:index.html.twig',
            [
                'courses' => $courses,
            ]
        );
    }

    public function listStudentsAction(Request $request)
    {
        $cursoId = $request->get('curso_id');

        $course = $this->em()->getRepository(Course::class)->find($cursoId);

        $students = $this->em()->getRepository(User::class)->findAllByCourseId($cursoId, 'alumno');
        $students = $this->getSerializeDecode($students, 'course_has_user');

        return $this->render(
            'BackendBundle:CompareGrades:list-students.html.twig',
            [
                'course' => $course,
                'students' => $students,
            ]
        );
    }

    public function listStudentsGradesAction(Request $request)
    {
        $studentId = $request->get('student_id');
        $courseId = $request->get('course_id');

        $grades = $this->em()->getRepository(Grades::class)->findGradesByCourseAndUser($courseId, $studentId);
        $grades = $this->getSerializeDecode($grades, 'grades');

        return $this->render(
            'BackendBundle:CompareGrades:listado-alumnos-grades.html.twig',
            [
                'grades' => $grades,
            ]
        );
    }

    public function sendEmailAction(Request $request)
    {

        $toEmail = $request->get('email');
        $messageTxt = $request->get('message');

        $now = new \DateTime();
        $now = $now->format('Y-m-d H:i:s');

        $fromEmail = $this->container->getParameter('mailer_main_email');

        $twig = $this->container->get('twig');
        $message = new \Swift_Message();
        $message->setSubject('Sistema USMP: envio de mensaje - ' . $now);
        $message->setFrom($fromEmail);
        $message->setTo($toEmail);
        $message->setBody(

            $twig->render(
                'BackendBundle:Emails:send_email.html.twig',
                [
                    'now' => $now,
                    'message' => $messageTxt
                ]
            ),
            'text/html'
        );

        $mailer = $this->container->get('mailer');
        $mailer->send($message);

        return $this->json([
            'status' => true,
        ]);

    }




}
