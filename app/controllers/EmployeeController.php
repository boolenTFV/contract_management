<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class EmployeeController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for employee
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Employee', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $employee = Employee::find($parameters);
        if (count($employee) == 0) {
            $this->flash->notice("The search did not find any employee");

            $this->dispatcher->forward([
                "controller" => "employee",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $employee,
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
     * Edits a employee
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $employee = Employee::findFirstByid($id);
            if (!$employee) {
                $this->flash->error("employee was not found");

                $this->dispatcher->forward([
                    'controller' => "employee",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $employee->id;

            $this->tag->setDefault("id", $employee->id);
            $this->tag->setDefault("name", $employee->name);
            $this->tag->setDefault("surename", $employee->surename);
            $this->tag->setDefault("patronymic", $employee->patronymic);
            $this->tag->setDefault("position", $employee->position);
            $this->tag->setDefault("department_id", $employee->department_id);
            
        }
    }

    /**
     * Creates a new employee
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'index'
            ]);

            return;
        }

        $employee = new Employee();
        $employee->id = $this->request->getPost("id");
        $employee->name = $this->request->getPost("name");
        $employee->surename = $this->request->getPost("surename");
        $employee->patronymic = $this->request->getPost("patronymic");
        $employee->position = $this->request->getPost("position");
        $employee->departmentId = $this->request->getPost("department_id");
        

        if (!$employee->save()) {
            foreach ($employee->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("employee was created successfully");

        $this->dispatcher->forward([
            'controller' => "employee",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a employee edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $employee = Employee::findFirstByid($id);

        if (!$employee) {
            $this->flash->error("employee does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'index'
            ]);

            return;
        }

        $employee->id = $this->request->getPost("id");
        $employee->name = $this->request->getPost("name");
        $employee->surename = $this->request->getPost("surename");
        $employee->patronymic = $this->request->getPost("patronymic");
        $employee->position = $this->request->getPost("position");
        $employee->departmentId = $this->request->getPost("department_id");
        

        if (!$employee->save()) {

            foreach ($employee->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'edit',
                'params' => [$employee->id]
            ]);

            return;
        }

        $this->flash->success("employee was updated successfully");

        $this->dispatcher->forward([
            'controller' => "employee",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a employee
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $employee = Employee::findFirstByid($id);
        if (!$employee) {
            $this->flash->error("employee was not found");

            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'index'
            ]);

            return;
        }

        if (!$employee->delete()) {

            foreach ($employee->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "employee",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("employee was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "employee",
            'action' => "index"
        ]);
    }

}
