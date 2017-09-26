<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Files;
use CoreBundle\Entity\FileMimeType;
use JMS\Serializer\SerializationContext;

class FilesController extends BaseController {

    const STATUS_SUCCESS = 1;
    const STATUS_WARNING = 2;
    const STATUS_ERROR = 3;
    const STATUS_LOADING = 4;
    const STATUS_DELETE = 5;
    const STATUS_DUPLICATE_ENTRY = 1062;

    public function indexAction(Request $request)
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CoreBundle:Files')->findAll();

        $serializer = $this->container->get('jms_serializer');
        $entitiesJson = $serializer->serialize(
            $entities,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups(array('file_data'))
        );


//        echo '<pre>';
//        print_r($entitiesJson);
//        exit;


        return $this->render(
            'BackendBundle:Files:index.html.twig',
            [
                'small_text' => '',
                'entitiesJson' => $entitiesJson,
            ]
        );
    }

    public function watchAction(Request $request, $slug)
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneBySlug($slug);

        if(!$entity){
            throw $this->createNotFoundException('el archivo que busca no existe');
        }

        return $this->render(
            'BackendBundle:Files/Watch:index.html.twig',
            [
                'small_text' => '',
                'entity' => $entity,
            ]
        );
    }

    public function saveAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();
        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }

        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $idFile = isset($file[0]) ? $file[0] : '';
            $name = isset($file[1]) ? $file[1] : '';
            $iconLink = isset($file[2]) ? $file[2] : '';
            $mimeType = isset($file[3]) ? $file[3] : '';
            $size = isset($file[4]) ? $file[4] : '';

            $response->id = $idFile;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

            // sleep for 2 seconds
            sleep(2);

            try {

                //files mime type
                $mimeTypeEntity = $em->getRepository('CoreBundle:FileMimeType')->findOneByName($mimeType);

                if(!$mimeTypeEntity){
                    $mimeTypeEntity = new FileMimeType();
                    $mimeTypeEntity->setName($mimeType);
                    $this->save($mimeTypeEntity);

                    // sleep for 2 seconds
                    sleep(2);
                }

                //file
                $fileEntity = $em->getRepository('CoreBundle:Files')->findOneByIdFile($idFile);

                if(is_null($fileEntity)){
                    $fileEntity = new Files;
                    $response->message = 'Se agrego el archivo';
                }else{
                    $fileEntity->setIsActive(true);
                    $response->message = 'Se actualizo el archivo';
                }


                $fileEntity->setUniqueId(uniqid());
                $fileEntity->setIdFile($idFile);
                $fileEntity->setName($name);
                $fileEntity->setIconLink($iconLink);
                $fileEntity->setSize($size);
//                $fileEntity->setSize($size);
//                $fileEntity->setIdMimeType($mimeTypeEntity);
                $this->save($fileEntity);

                sleep(1);

                //user
                $user->removeFile($fileEntity);
                $user->addFile($fileEntity);
                $this->save($user);

                $response->id = $idFile;
                $response->status = self::STATUS_SUCCESS;

            } catch(UniqueConstraintViolationException $e) {
                $response->id = $idFile;
                $response->status = self::STATUS_DUPLICATE_ENTRY;
                $response->message = 'El archivo ya fue incluido anteriormente.';
            }

            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

    public function deleteOneAction(Request $request)
    {

        $response = new \stdClass();
        $response->status = "fail";

//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_DELETE_PROFILE')) {
//            $response->status = "access-denied";
//            $responseJson = json_encode($response);
//            return new Response($responseJson);
//        }

        $uniqueId = $request->get('id', null);
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneByUniqueId($uniqueId);

        if($entity){
            try {
                $entity->setIsActive(0);
                $this->save($entity);
                $response->status = "ok";
            }catch (\Exception $e){

            }
        }

        return $this->json($response);
    }

    public function deleteManyAction(Request $request)
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $response = new \stdClass();
        $pusher = $this->container->get('gos_web_socket.zmq.pusher');
        $files = $request->get('files', []);

        if(empty($files)){
            return new Response(0);
        }


        foreach ($files as $key => $file){

            $file = isset($file['file']) ? $file['file'] : '';
            $file = json_decode(base64_decode($file));

            $idFile = isset($file[0]) ? $file[0] : '';

            $response->id = $idFile;
            $response->status = self::STATUS_LOADING;
            $response->message = 'loading';
            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

            // sleep for 2 seconds
            sleep(2);

            try {
                $fileEntity = $em->getRepository('CoreBundle:Files')->findOneByIdFile($idFile);

                if($fileEntity){
                    $fileEntity->setIsActive(0);
                    $this->save($fileEntity);
                }

                $response->id = $idFile;
                $response->status = self::STATUS_DELETE;
                $response->message = 'Se elimino el archivo';

            } catch(\Exception $e) {
                $response->id = $idFile;
                $response->status = self::STATUS_ERROR;
                $response->message = 'Ocurrio una excepcion, reintentar.';
            }

            $pusher->push(['msg' => json_encode($response)], 'googledrive_topic');

        }

        return new Response(1);

    }

}
