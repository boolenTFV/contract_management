<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class UserController extends ControllerBase
{
    /**
     * Searches for user
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query=null;
            if(isset($_POST['search'])) {
                $query = $_POST['search'];
            }
            $this->persistent->parameters = $query;

        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }
        //$user = User::find($parameters);
        $parameters = $this->persistent->parameters;
        $user = User::searchColumns($parameters);
        if (count($user) == 0) {
            $this->flash->notice("Поиск не дал результатов.");
        }

        $paginator = new Paginator([
            'data' => $user,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
        $this->view->department = Department::find();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = User::findFirstByid($id);
            if (!$user) {
                $this->flash->error("Пользователь не найден!");

                $this->dispatcher->forward([
                    'controller' => "user",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("name", $user->name);
            $this->tag->setDefault("surname", $user->surname);
            $this->tag->setDefault("patronymic", $user->patronymic);
            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("pass", $user->pass);
            $this->tag->setDefault("type", $user->type);
            $this->tag->setDefault("department_id", $user->department_id);
            if($user->department_id!=null){
                $this->tag->setDefault("department", $user->department->name);
            }
            
        }
    }

    public function activeAction($id)
    {
        $user = User::findFirstByid($id);

        if (!$user) {
            $this->flash->error("Пользователь не существует! " . $id);

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }
        $message = "";
        if($user->is_active==1){
            $user->is_active = 0;
            $message = "Пользователь успешно разблокирован!";
        }else{
            $user->is_active = 1;
            $message = "Пользователь успешно заблокирован!";
        }

        if (!$user->save()) {
            $this->flash->error("Не уадлось изменить статус пользователя.");
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("Пользователь успешно разблокирован!");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => 'index'
        ]);
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $user = new User();
        $user->id = $this->request->getPost("id");
        $user->name = $this->request->getPost("name");
        $user->surname = $this->request->getPost("surname");
        $user->patronymic = $this->request->getPost("patronymic");
        $user->email = $this->request->getPost("email", "email");
        $user->pass = $this->security->hash($this->request->getPost("pass"));
        $user->type = $this->request->getPost("type");
        $user->department_id = $this->request->getPost("department_id");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error("Ошибка регистрации!");
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Регистрация прошла успешно. Ожидайте, пока ваша учтеная запись не будет проверена админестратором.");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $user = User::findFirstByid($id);

        if (!$user) {
            $this->flash->error("Пользователь не существует! " . $id);

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $user->id = $this->request->getPost("id");
        $user->name = $this->request->getPost("name");
        $user->surname = $this->request->getPost("surname");
        $user->patronymic = $this->request->getPost("patronymic");
        $user->email = $this->request->getPost("email", "email");
        $user->pass = $this->request->getPost("pass");
        $user->type = $this->request->getPost("type");
        $user->department_id = $this->request->getPost("department_id");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'edit',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("Пользователь успешно изменен!");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = User::findFirstByid($id);
        if (!$user) {
            $this->flash->error("Пользователь не найден!");

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Пользователь был успешно удален!");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => "index"
        ]);
    }

}
