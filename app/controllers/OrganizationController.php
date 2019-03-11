<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class OrganizationController extends ControllerBase
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
        $organization = Organization::searchColumns($parameters);
        if (count($organization) == 0) {
            $this->flash->notice("Поиск не дал результатов.");
        }

        $paginator = new Paginator([
            'data' => $organization,
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
            $organization = Organization::searchColumns($query);
            $this->view->disable();
            echo json_encode($organization);
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a organization
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $organization = Organization::findFirstByid($id);
            if (!$organization) {
                $this->flash->error("Организация не найдена");

                $this->dispatcher->forward([
                    'controller' => "organization",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $organization->id;

            $this->tag->setDefault("id", $organization->id);
            $this->tag->setDefault("name", $organization->name);
            $this->tag->setDefault("index", $organization->index);
            $this->tag->setDefault("bank_index", $organization->bank_index);
            $this->tag->setDefault("bank_account", $organization->bank_account);
            
        }
    }

    /**
     * Creates a new organization
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'index'
            ]);

            return;
        }

        $organization = new Organization();
        $organization->id = $this->request->getPost("id");
        $organization->name = $this->request->getPost("name");
        $organization->index = $this->request->getPost("index");
        $organization->bank_index = $this->request->getPost("bank_index");
        $organization->bank_account = $this->request->getPost("bank_account");
        

        if (!$organization->save()) {
            foreach ($organization->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Организация была добавлена!");

        $this->dispatcher->forward([
            'controller' => "organization",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a organization edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $organization = Organization::findFirstByid($id);

        if (!$organization) {
            $this->flash->error("Организация не найдена! " . $id);

            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'index'
            ]);

            return;
        }

        $organization->id = $this->request->getPost("id");
        $organization->name = $this->request->getPost("name");
        $organization->index = $this->request->getPost("index");
        $organization->bank_index = $this->request->getPost("bank_index");
        $organization->bank_account = $this->request->getPost("bank_account");
        

        if (!$organization->save()) {

            foreach ($organization->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'edit',
                'params' => [$organization->id]
            ]);

            return;
        }

        $this->flash->success("Организация успешно отредактирована.");

        $this->dispatcher->forward([
            'controller' => "organization",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a organization
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $organization = Organization::findFirstByid($id);
        if (!$organization) {
            $this->flash->error("Организация не найдена!");

            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'index'
            ]);

            return;
        }

        if (!$organization->delete()) {

            foreach ($organization->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "organization",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Организация успешно удалена.");

        $this->dispatcher->forward([
            'controller' => "organization",
            'action' => "index"
        ]);
    }

}
