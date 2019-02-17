<?php

namespace CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const CIRCLE_1_YELLOW = 'fa-circle-o text-yellow';
    const CIRCLE_2_AQUA = 'fa-circle-o text-aqua';
    const CIRCLE_3_BLUE = 'fa-circle-o text-blue';
    const CIRCLE_4_ORANGE = 'fa-circle-o text-orange';
    const CIRCLE_5_RED = 'fa-circle-o text-red';


    public function mainMenu(FactoryInterface $factory, array $options)
    {
//
//        $user = $this->getUser();
//
//        if($user){
//            echo '<pre>';
//            print_r($user->getRoles());
//            exit;
//        }



        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
            'class' => 'sidebar-menu',
            ],
        ])
        ;


        /**
         * USER
         */
        $child = 'Usuarios';
        $userView = $this->isGranted('ROLE_USER_VIEW');
        $roleView = $this->isGranted('ROLE_ACLROLE_VIEW');
        $profileView = $this->isGranted('ROLE_ACLPROFILE_VIEW');
        $groupOfUsersView = $this->isGranted('ROLE_GROUPOFUSERS_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'childrenAttributes' => [
            'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay($userView || $roleView || $profileView || $groupOfUsersView)
        ;

        $menu[$child]->addChild('Listar', [
            'route' => 'backend_user_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($userView)
        ;

        $menu[$child]->addChild('Roles', [
            'route' => 'backend_aclrole_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($roleView)
        ;

        $menu[$child]->addChild('Profile', [
            'route' => 'backend_aclprofile_index'
        ])
        ->setAttribute('icon', self::CIRCLE_3_BLUE)
        ->setDisplay($profileView)
        ;

//        $menu[$child]->addChild('Usuarios y grupos', [
//            'route' => 'backend_groupofusers_index'
//        ])
//        ->setAttribute('icon', self::CIRCLE_4_ORANGE)
//        ->setDisplay($groupOfUsersView)
//        ;



        /**
         * COURSES
         */
        $child = 'Cursos';
        $view = true; //$this->isGranted('ROLE_PRODUCT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-book')
            ->setDisplay($view)
        ;
        
        $user = $this->getUser();
        
        if ($user) {
        	
        	$profile = $user->getProfile();
        	
        	if ($profile) {
        	 
        		if (strtoupper($profile->getName()) == "ADMINISTRATOR") {
			        $menu[$child]->addChild('Listar', [
				        'route' => 'backend_course_index_admin'
			        ])
				        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
				        ->setDisplay($view)
			        ;
		        } else {
			        $menu[$child]->addChild('Listar', [
				        'route' => 'backend_course_index'
			        ])
				        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
				        ->setDisplay($view)
			        ;
		        }
	        }
        }





        /**
         * EXAMENES
         */
        $child = 'Examenes';
        $view = true; //$this->isGranted('ROLE_PRODUCT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-file-text-o')
            ->setDisplay($view)
        ;

        $menu[$child]->addChild('Gestionar', [
            'route' => 'backend_exam_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setDisplay($view)
        ;




        /**
         * CATEGORIES
         */
//        $child = 'Categorías';
//        $categoryTreeView = $this->isGranted('ROLE_CATEGORYTREE_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('allow_angle', true)
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-sitemap')
//        ->setDisplay($categoryTreeView)
//        ;
//
//        $menu[$child]->addChild('Gestionar', [
//            'route' => 'backend_categorytree_index'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($categoryTreeView)
//        ;


//        /**
//         * PRODUCT
//         */
//        $child = 'Productos';
//        $productView = $this->isGranted('ROLE_PRODUCT_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('allow_angle', true)
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-cube')
//        ->setDisplay($productView)
//        ;
//
//        $menu[$child]->addChild('Listar', [
//            'route' => 'backend_product_index'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($productView)
//        ;



        /**
         * ACCESS CONTROL LISTS
         */
//        $child = 'Access Control Lists';
//        $clasesView = true; //$this->isGranted('ROLE_CLIENT_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('allow_angle', true)
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-user-secret')
//        ->setDisplay($clasesView)
//        ;
//
//        $menu[$child]->addChild('Clases', [
//            'route' => 'backend_acl_classes'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($clasesView)
//        ;
//
//        $menu[$child]->addChild('Object identities', [
//            'route' => 'backend_acl_object_identities'
//        ])
//        ->setAttribute('icon', self::CIRCLE_2_AQUA)
//        ->setDisplay($clasesView)
//        ;
//
//        $menu[$child]->addChild('Entries', [
//            'route' => 'backend_acl_entries'
//        ])
//        ->setAttribute('icon', self::CIRCLE_3_BLUE)
//        ->setDisplay($clasesView)
//        ;


        /**
         * ASSOCIATION
         */
        $child = 'Asociación';
        $categoryHasProduct = $this->isGranted('ROLE_CATEGORYTREETOASSIGN_VIEW');
        $pdvHasProduct = $this->isGranted('ROLE_ASSIGNPOINTOFSALEHASPRODUCT_VIEW');
        $userHasPdv = $this->isGranted('ROLE_ASSIGNUSERHASPOINTOFSALE_VIEW');
        $groupHasUser = $this->isGranted('ROLE_ASSIGNGROUPHASUSER_VIEW');
        $templateHasModule = $this->isGranted('ROLE_ASSIGNTEMPLATEHASMODULE_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-exchange')
        ->setDisplay($categoryHasProduct || $pdvHasProduct || $userHasPdv || $groupHasUser || $templateHasModule)
        ;

        $menu[$child]->addChild('Curso <i class="fa fa-fw fa-arrow-right"></i> Docente', [
            'route' => 'backend_assigncoursehasuserteacher_index',
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($categoryHasProduct)
        ;

        $menu[$child]->addChild('Curso <i class="fa fa-fw fa-arrow-right"></i> Alumno', [
            'route' => 'backend_assigncoursehasuserstudent_index',
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($categoryHasProduct)
        ;

//        $menu[$child]->addChild('Curso <i class="fa fa-fw fa-arrow-right"></i> Examen', [
//            'route' => 'backend_assigncoursehasexam_index',
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($categoryHasProduct)
//        ;





//        /**
//         * SETTINGS
//         */
//        $child = 'Settings';
//        $loadFixture = true; //$this->isGranted('ROLE_CLIENT_VIEW');
//        $menu->addChild($child, [
//            'route' => 'backend_default_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//        ->setAttribute('class', 'treeview')
//        ->setAttribute('icon', 'fa-fw fa-cog')
//        ->setDisplay($loadFixture)
//        ;
//
//        $menu[$child]->addChild('Load Fixtures', [
//            'route' => 'core_default_load_fixtures'
//        ])
//        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//        ->setDisplay($loadFixture)
//        ;
//
//        $menu[$child]->addChild('GoogleDrive mimetype', [
//            'route' => 'backend_googledrivesettings_mimetype'
//        ])
//        ->setAttribute('icon', self::CIRCLE_2_AQUA)
//        ->setDisplay($loadFixture)
//        ;



        /**
         * CHART
         */
        $child = 'Reportes';
        $clientView = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-bar-chart')
        ->setDisplay($clientView)
        ;

        $menu[$child]->addChild('Pie Chart', [
            'route' => 'backend_chart_piechart'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clientView)
        ;

        $menu[$child]->addChild('Column Chart', [
            'route' => 'backend_chart_columnchart'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setDisplay($clientView)
        ;








        return $menu;
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

}

