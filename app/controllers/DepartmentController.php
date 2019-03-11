<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DepartmentController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;

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
        $parameters = $this->persistent->parameters;
        $this->tag->setDefault("search", $parameters);
        $department = Department::searchColumns($parameters);
        if (count($department) == 0) {
            $this->flash->notice("Поиск не дал результатов.");
        }

        $paginator = new Paginator([
            'data' => $department,
            'limit'=> 8,
            'page' => $numberPage
        ]);
        $page= $paginator->getPaginate();
        $this->view->page= $page;
    }

    public function getAction()
    {
        if ($this->request->isAjax()) {
            if ($this->request->isPost()) {
                $query="";
                if(isset($_POST['search'])) {
                    $query = $_POST['search'];
                }
            } 
            $department = Department::searchColumns($query);
            $this->view->disable();
            echo json_encode($department);
        }
    }

    /**
     * Searches for department
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Department', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $department = Department::find($parameters);
        if (count($department) == 0) {
            $this->flash->notice("The search did not find any department");

            $this->dispatcher->forward([
                "controller" => "department",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $department,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a department
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $department = Department::findFirstByid($id);
            if (!$department) {
                $this->flash->error("department was not found");

                $this->dispatcher->forward([
                    'controller' => "department",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $department->id;

            $this->tag->setDefault("id", $department->id);
            $this->tag->setDefault("name", $department->name);
            $this->tag->setDefault("abbreviation", $department->abbreviation);
            $this->tag->setDefault("code", $department->code);
            
        }
    }

    /**
     * Creates a new department
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'index'
            ]);

            return;
        }

        $department = new Department();
        $department->id = $this->request->getPost("id");
        $department->name = $this->request->getPost("name");
        $department->abbreviation = $this->request->getPost("abbreviation");
        $department->code = $this->request->getPost("code");
        

        if (!$department->save()) {
            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("department was created successfully");

        $this->dispatcher->forward([
            'controller' => "department",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a department edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $department = Department::findFirstByid($id);

        if (!$department) {
            $this->flash->error("department does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'index'
            ]);

            return;
        }

        $department->id = $this->request->getPost("id");
        $department->name = $this->request->getPost("name");
        $department->abbreviation = $this->request->getPost("abbreviation");
        $department->code = $this->request->getPost("code");
        

        if (!$department->save()) {

            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'edit',
                'params' => [$department->id]
            ]);

            return;
        }

        $this->flash->success("department was updated successfully");

        $this->dispatcher->forward([
            'controller' => "department",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a department
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $department = Department::findFirstByid($id);
        if (!$department) {
            $this->flash->error("department was not found");

            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'index'
            ]);

            return;
        }

        if (!$department->delete()) {

            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "department",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("department was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "department",
            'action' => "index"
        ]);
    }

}
