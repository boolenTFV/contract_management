<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DocumentController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Document', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $document = Document::find($parameters);
        if (count($document) == 0) {
            $this->flash->notice("The search did not find any document");
        }

        $paginator = new Paginator([
            'data' => $document,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Searches for document
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Document', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $document = Document::find($parameters);
        if (count($document) == 0) {
            $this->flash->notice("The search did not find any document");

            $this->dispatcher->forward([
                "controller" => "document",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $document,
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
     * Edits a document
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $document = Document::findFirstByid($id);
            if (!$document) {
                $this->flash->error("document was not found");

                $this->dispatcher->forward([
                    'controller' => "document",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $document->id;

            $this->tag->setDefault("id", $document->id);
            $this->tag->setDefault("contract_id", $document->contract_id);
            $this->tag->setDefault("template", $document->template);
            
        }
    }

    /**
     * Creates a new document
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'index'
            ]);

            return;
        }

        $document = new Document();
        $document->contract_id = $this->request->getPost("contract_id");
        $document->template = $this->request->getPost("template");

        if($this->request->hasFiles() == true){
            foreach ($this->request->getUploadedFiles() as $file){
                echo $file->getName(), " ", $file->getSize(), "\n";
                $document->saveFile($file);
            }
        }

        if (!$document->save()) {
            foreach ($document->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'new'
            ]);

            return;
        }


        $this->flash->success("document was created successfully");

        $this->dispatcher->forward([
            'controller' => "document",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a document edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $document = Document::findFirstByid($id);

        if (!$document) {
            $this->flash->error("document does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'index'
            ]);

            return;
        }

        $document->contractId = $this->request->getPost("contract_id");
        $document->template = $this->request->getPost("template");
        
        if($this->request->hasFiles() == true){
            foreach ($this->request->getUploadedFiles() as $file){
                echo $file->getName(), " ", $file->getSize(), "\n";
                $document->saveFile($file);
            }
        }

        if (!$document->save()) {

            foreach ($document->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'edit',
                'params' => [$document->id]
            ]);

            return;
        }

        $this->flash->success("document was updated successfully");

        $this->dispatcher->forward([
            'controller' => "document",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a document
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $document = Document::findFirstByid($id);
        if (!$document) {
            $this->flash->error("document was not found");

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'index'
            ]);

            return;
        }

        if (!$document->delete()) {

            foreach ($document->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("document was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "document",
            'action' => "index"
        ]);
    }

    /*
    * Генерация документа, на основе его шаблона.
    * Если документу соответсвует некоторый договор, то генерирует данные на его основе
    * Иначе, необходимо указать договор для генерации при запросе ($contractId)
    * P.S.:Документы без указанного договора считаются общими для всех договоров
    */
    public function generateAction($id, $contractId=null)
    {
        $document = Document::findFirstByid($id);
        if (!$document) {
            $this->flash->error("document was not found");

            $this->dispatcher->forward([
                'controller' => "document",
                'action' => 'index'
            ]);

            return;
        }
        $contract = null;
        if(!$document->contract){            
            $contract = Contract::findFirst($contractId); 
        }

        $fileUrl = $document->generateDoc($contract);
        $this->response->redirect($fileUrl);
    }

}
