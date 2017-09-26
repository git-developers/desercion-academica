<?php

namespace BackendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GoogleDriveController extends BaseController {


    public function indexAction($id, Request $request)
    {

        $search = $request->get('search');
        $pageToken = $request->get('page', null);

        $google = $this->get('core.service.google_service_drive');
        $authUrl = $google->getAuthUrl();

        if(!$authUrl['status']){
            return $this->redirect($this->generateUrl('backend_googledrive_account_permissions'));
        }

        $results = $google->getGoogleFiles($id, $search, $pageToken);
        $files = $results->getFiles();
        $smallText = $google->createSmallText($id);

        /*
        //**************************
        $google->redisDelete('pollo');
        $files = $google->redisGet('pollo');

        if(empty($files)){
            $files = $google->redisSet('pollo', $results->getFiles());
        }
        //**************************
        */

        $response = $this->render(
            'BackendBundle:Googledrive:index.html.twig',
            [
                'files' => $files,
                'next_page_token' => $results->nextPageToken,
                'small_text' => $smallText,
                'id' => $id,
                'search' => $search,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_WEEK);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    public function accountPermissionsAction(Request $request)
    {

        $authCode = $request->get('code');

        $google = $this->get('core.service.google_service_drive');
        $authUrl = $google->getAuthUrl();

        if($authUrl['status']){
            return $this->redirect($this->generateUrl('backend_googledrive_index', ['id' => 'my-drive']));
        }

        if(isset($authCode)){
            $result = $google->storeCredentials($authCode);
            if(!$result){
                $this->flashWarning('Oops! parece que no se termino el proceso, reintente.');
                return $this->redirect($this->generateUrl('backend_googledrive_account_permissions'));
            }
            return $this->redirect($this->generateUrl('backend_googledrive_index', ['id' => 'my-drive']));
        }

        return $this->render(
            'BackendBundle:Googledrive:account_permissions.html.twig',
            [
                'auth_url' => $authUrl['auth_url'],
            ]
        );
    }

    public function revokeTokenAction(Request $request)
    {
        $google = $this->get('core.service.google_service_drive');
        $google->revokeToken();
        return $this->redirect($this->generateUrl('backend_googledrive_index', ['id' => 'my-drive']));
    }

    public function mimetypeAction(Request $request)
    {

        return $this->render(
        'BackendBundle:Googledrivesettings:index.html.twig',
            [
                'auth_url' => '',
            ]
        );
    }

    public function breadcrumbAction($files) {

        $file = array_shift($files);
        $name = isset($file['name']) ? $file['name'] : '(no disponible)';
        $parents = isset($file['parents']) ? $file['parents'] : [];
        $parents = array_shift($parents);

        /*
        $bread = explode('/', $path);
        $crumbtrail = '';
        foreach ($bread as $crumb) {
            list($id, $name) = $this->explode_node_path($crumb);
            $name = empty($name) ? $id : $name;
            $breadcrumb[] = array(
                'name' => $name,
                'path' => $this->build_node_path($id, $name, $crumbtrail)
            );
            $tmp = end($breadcrumb);
            $crumbtrail = $tmp['path'];
        }
        return $breadcrumb;
        */

        return $this->render(
            'BackendBundle:Googledrive:breadcrumb.html.twig',
            [
                'parents' => $parents,
                'name' => $name,
            ]
        );
    }

}



