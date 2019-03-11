<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class SessionController extends ControllerBase
{

    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            [
                'id'   => $user->id,
                'email' => $user->email,
                'role' => $user->type,
            ]
        );
    }

    /**
     * Index action
     */
    public function regAction()
    {
    }

    
    public function authAction()
    {
    	if (!$this->request->isPost()) {
    		return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action'     => 'index',
                    'params' => [error=>'Пожалйста, не хакайте нас. Оч просим.'],
                ]
            );;
    	}
    	$email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

         //найдем пользователя, подходящего под параметры
        $user = User::findFirst(
                [
                    "email = :email:",
                    'bind' => [
                        'email'    => $email
                    ]
                ]
            );
        if ($user !== false && $this->security->checkHash($password, $user->pass)) {
          	/*если пользователь найден и
          	пароли совпадают
          	авторизуем и переходим на след страницу*/
            $this->_registerSession($user);
            
            return $this->dispatcher->forward(
                [
                    'controller' => 'contract',
                    'action'     => 'index',
                ]
            );
      	    
        }
		$this->flash->error('Неверный логин или пароль!!! '.$password."  ".$email);
        return $this->dispatcher->forward(
            [
                'controller' => 'index',
                'action'     => 'index'
            ]
        );
    }

     public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect();
    }
}
