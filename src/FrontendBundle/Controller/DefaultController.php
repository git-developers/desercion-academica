<?php

namespace FrontendBundle\Controller;

use CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Entity\Template;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEParagraph;

/*
MAIN:: https://livedemo00.template-help.com/wordpress_52146

https://livedemo00.template-help.com/drupal_44386
https://livedemo00.template-help.com/landing_61133
https://livedemo00.template-help.com/wt_44331
https://livedemo00.template-help.com/wordpress_52146
https://livedemo00.template-help.com/joomla_59572
 */

class DefaultController extends BaseController
{

    public function indexAction(Request $request, $path)
    {

        $url = $this->generateUrl('frontend_security_login');

        return $this->redirect($url);


        /*
        $m = $this->get('core.module');
        $templateHasModule = $m->getTemplateHasModuleByPath($path);
        $frontendTemplate = $m->frontendTemplate($templateHasModule);

        $response = $this->render(
            $frontendTemplate,
            [
                'templateHasModule' => $templateHasModule,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_HOUR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
        */
    }

}
