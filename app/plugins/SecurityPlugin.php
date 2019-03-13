<?php

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;

class SecurityPlugin extends Plugin
{
	public const ADMIN = 'admin';
	public const TEACH = 'user';
	public const GUEST = 'guest';

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the 'auth' variable exists in session to define the active role
        $auth = $this->session->get('auth');

        if (!$auth) {
            $role = self::GUEST;
        } else {
        	//ENUM('admin', 'user')
            $role = $auth['role'];
        }

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getAcl();

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);

        if (!$allowed) {
            // If he doesn't have access forward him to the index controller
            // $this->flash->error(
            //     "You don't have access to this module"
            // );
            switch ($role) {
            	case self::GUEST:
        			$dispatcher->forward(
		                [
		                    'controller' => 'index',
		                    'action'     => 'index',
		                ]
		            );
            		break;
            	case self::ADMIN:
        			$dispatcher->forward(
		                [
		                    'controller' => 'contract',
		                    'action'     => 'index',
		                ]
		            );
            		break;	
            	case self::TEACH:
        			$dispatcher->forward(
		                [
		                    'controller' => 'contract',
		                    'action'     => 'index',
		                ]
		            );
            		break;
            	
            	default:
            		# code...
            		break;
            }


            // Returning 'false' we tell to the dispatcher to stop the current operation
            return false;
        }
    }
    private function getAcl(){
    	// Create the ACL
		$acl = new AclList();

		// The default action is DENY access
		$acl->setDefaultAction(
		    Acl::DENY
		);

		// Register two roles, Users is registered users
		// and guests are users without a defined identity
		$roles = [
		    self::ADMIN  => new Role(self::ADMIN),
		    self::TEACH  => new Role(self::TEACH),
		    self::GUEST => new Role(self::GUEST),
		];

		foreach ($roles as $role) {
		    $acl->addRole($role);
		}
		// Private area resources (backend)
		$allPrivateResources = [
		    'test'			=> ['index'],
		    'session'		=> ['auth', 'reg', 'logout'],
		    'user'			=> ['index','edit','create','search','new','save','delete','active'],
		    'accounting'	=> ['index','edit','create','search','new','save','delete'],
		    'record'		=> ['index','edit','create','search','new','save','delete'],
		    'document'		=> ['index','edit','create','search','new','save','delete','generate','get'],
		    'contract'		=> ['index','edit','create','search','new','save','delete','setstatus'],
		    'department'	=> ['index','edit','create','search','new','save','delete'],
		    'employee'		=> ['index','edit','create','search','new','save','delete'],
		    'contractor'	=> ['index','edit','create','search','new','save','delete','get'],
		    'organization'	=> ['index','edit','create','search','new','save','delete','get'],
			'index'			=> ['index'],
		];
		$adminResources = [
		    'test'		=> ['index'],
		    'session'	=> ['logout'],
		    'user'			=> ['index','edit','create','search','new','save','delete','active'],
		    'record'		=> ['index','edit','create','search','new','save','delete'],
		    'accounting'	=> ['index','edit','create','search','new','save','delete'],
		    'contract'		=> ['index','edit','create','search','new','save','delete','setstatus'],
		    'department'	=> ['index','edit','create','search','new','save','delete'],
		    'employee'		=> ['index','edit','create','search','new','save','delete'],
		    'document'		=> ['index','edit','create','search','new','save','delete','generate','get'],
		    'contractor'	=> ['index','edit','create','search','new','save','delete','get'],
		    'organization'	=> ['index','edit','create','search','new','save','delete','get'],
			'index'			=> ['index'],
		];
		$teachResources = [
		    'test'		=> ['index'],
		    'session'	=> ['logout'],
		    'user'			=> ['index','edit','create','search','new','save','delete','active'],
		    'record'		=> ['index','edit','create','search','new','save','delete'],
		    'accounting'	=> ['index','edit','create','search','new','save','delete'],
		    'document'		=> ['index','edit','create','search','new','save','delete','generate'],
		    'contract'		=> ['index','edit','create','search','new','save','delete','setstatus'],
		    'department'	=> ['index','edit','create','search','new','save','delete'],
		    'employee'		=> ['index','edit','create','search','new','save','delete'],
		    'contractor'	=> ['index','edit','create','search','new','save','delete','get'],
		    'organization'	=> ['index','edit','create','search','new','save','delete','get'],
			'index'			=> ['index'],
		];

		$guestResources = [
		    'index'		=> ['index'],
		    'session'	=> ['auth','reg'],
		];

		foreach ($allPrivateResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}

		// Public area resources (frontend)
		$publicResources = [
		    'errors'   => ['show404', 'show500'],
		    'theme'   => ['change'],
		    'department'=>['get'],
		    'user'=>['create','new'],
		];

		foreach ($publicResources as $resourceName => $actions) {
		    $acl->addResource(
		        new Resource($resourceName),
		        $actions
		    );
		}
		// Grant access to public areas to both users and guests
		foreach ($roles as $role) {
		    foreach ($publicResources as $resource => $actions) {
		    	foreach ($actions as $action) {
			        $acl->allow(
			            $role->getName(),
			            $resource,
			            $action
			        );
			    }
		    }
		}

		// Grant access to private area only to role Users
		foreach ($adminResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            self::ADMIN,
		            $resource,
		            $action
		        );
		    }
		}
		foreach ($teachResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            self::TEACH,
		            $resource,
		            $action
		        );
		    }
		}

		foreach ($guestResources as $resource => $actions) {
		    foreach ($actions as $action) {
		        $acl->allow(
		            self::GUEST,
		            $resource,
		            $action
		        );
		    }
		}
		return $acl;
    }
}