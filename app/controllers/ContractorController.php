<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ContractorController extends ControllerBase
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
        $contractor = Contractor::searchColumns($parameters);
        if (count($contractor) == 0) {
            $this->flash->notice("Поиск не дал результатов.");
        }

        $paginator = new Paginator([
            'data' => $contractor,
            'limit'=> 8,
            'page' => $numberPage
        ]);

        $page = $paginator->getPaginate();
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
            $contractors = Contractor::searchColumns($query);
            $data=[];
            foreach ($contractors as $contractor) {
                $data[]=[
                    'id'=>$contractor->id,
                    'name' => $contractor->name,
                    'surname' => $contractor->surename,
                    'organization' => $contractor->organization->name
                ];
            }
            $this->view->disable();
            echo json_encode($data);
        }
    }
    /**
     * Searches for contractor
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Contractor', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $contractor = Contractor::find($parameters);
        if (count($contractor) == 0) {
            $this->flash->notice("The search did not find any contractor");

            $this->dispatcher->forward([
                "controller" => "contractor",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $contractor,
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
     * Edits a contractor
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $contractor = Contractor::findFirstByid($id);
            if (!$contractor) {
                $this->flash->error("contractor was not found");

                $this->dispatcher->forward([
                    'controller' => "contractor",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $contractor->id;

            $this->tag->setDefault("id", $contractor->id);
            $this->tag->setDefault("name", $contractor->name);
            $this->tag->setDefault("surename", $contractor->surename);
            $this->tag->setDefault("position", $contractor->position);
            $this->tag->setDefault("organization_id", $contractor->organization_id);
            $this->tag->setDefault("organization", $contractor->organization->name);
            
        }
    }

    /**
     * Creates a new contractor
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'index'
            ]);

            return;
        }

        $contractor = new Contractor();
        $contractor->name = $this->request->getPost("name");
        $contractor->surename = $this->request->getPost("surename");
        $contractor->position = $this->request->getPost("position");
        $contractor->organization_id = $this->request->getPost("organization_id");
        

        if (!$contractor->save()) {
            foreach ($contractor->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Контрагент был успешно добавлен!");

        $this->dispatcher->forward([
            'controller' => "contractor",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a contractor edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $contractor = Contractor::findFirstByid($id);

        if (!$contractor) {
            $this->flash->error("contractor does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'index'
            ]);

            return;
        }

        $contractor->name = $this->request->getPost("name");
        $contractor->surename = $this->request->getPost("surename");
        $contractor->position = $this->request->getPost("position");
        $contractor->organization_id = $this->request->getPost("organization_id");
        

        if (!$contractor->save()) {

            foreach ($contractor->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'edit',
                'params' => [$contractor->id]
            ]);

            return;
        }

        $this->flash->success("Контрагент был успешно отредактирован");

        $this->dispatcher->forward([
            'controller' => "contractor",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a contractor
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $contractor = Contractor::findFirstByid($id);
        if (!$contractor) {
            $this->flash->error("contractor was not found");

            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'index'
            ]);

            return;
        }

        if (!$contractor->delete()) {

            foreach ($contractor->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contractor",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("contractor was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "contractor",
            'action' => "index"
        ]);
    }

}