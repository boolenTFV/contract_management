<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ContractController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query=null;
            if(isset($_POST['search'])){
                $query = $_POST['search'];
            }
            $this->persistent->parameters = $query;
        } else {
            $this->persistent->parameters = null;
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        $this->tag->setDefault("search", $parameters);
        $contract = Contract::searchColumns($parameters);
        if (count($contract) == 0) {
            $this->flash->notice("Поиcк не дал результатов.");
        }

        $this->view->role=$this->session->auth['role'];
        
        if($this->session->auth['role']=="user"){
            $user = User::findFirst($this->session->auth['id']);
            if($user!=null){
                $contract = $user->department->contract;
            }else{
                $this->flash->error("Пользователь не найден!");
            }
        }

        $paginator = new Paginator([
            'data' => $contract,
            'limit'=> 10,
            'page' => $numberPage
        ]);
        $page =  $paginator->getPaginate();
        
        if ($this->request->isAjax()) {
            $this->view->disable();
            foreach ($page->items as $key => $item) {
                $data[]=[   "id"=>$item->id,
                            "contract_number"=>$item->contract_number,
                            "department"=>$item->department->abbreviation,
                ];
            }
            echo json_encode($data);
        }else{
            $this->view->page = $page;
        }
    }

    /**
     * Searches for contract
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = $_POST['search'];
            $this->persistent->parameters = $query;
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        $contract = Contract::searchColumns($parameters);
        if (count($contract) == 0) {
            $this->flash->notice("Поиcк не дал результатов.");
        }


        $paginator = new Paginator([
            'data' => $contract,
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
     * Edits a contract
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $contract = Contract::findFirstByid($id);
            if (!$contract) {
                $this->flash->error("contract was not found");

                $this->dispatcher->forward([
                    'controller' => "contract",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $contract->id;

            $this->tag->setDefault("id", $contract->id);
            $this->tag->setDefault("department_id", $contract->department_id);
            $this->tag->setDefault("contract_number", $contract->contract_number);
            $this->tag->setDefault("date", $contract->date);
            $this->tag->setDefault("theme", $contract->theme);
            $this->tag->setDefault("product_name", $contract->product_name);
            $this->tag->setDefault("work_completion", $contract->work_completion);
            $this->tag->setDefault("product_use_method", $contract->product_use_method);
            $this->tag->setDefault("transfer_mony", $contract->transfer_mony);
            $this->tag->setDefault("pay_method", $contract->pay_method);
            $this->tag->setDefault("surcharge", $contract->surcharge);
            $this->tag->setDefault("surcharge_condition", $contract->surcharge_condition);
            $this->tag->setDefault("fine", $contract->fine);
            $this->tag->setDefault("fine_conditions", $contract->fine_conditions);
            $this->tag->setDefault("start_date", $contract->start_date);
            $this->tag->setDefault("end_date", $contract->end_date);
            $this->tag->setDefault("transfer_right", $contract->transfer_right);
            $this->tag->setDefault("publication_rights", $contract->publication_rights);
            $this->tag->setDefault("other_rights", $contract->other_rights);
            $this->tag->setDefault("trunsfer_profit_percent", $contract->trunsfer_profit_percent);
            $this->tag->setDefault("contractor_id", $contract->contractor_id);
            $this->tag->setDefault("contractor", $contract->contractor->surename." ".$contract->contractor->organization->name);
            
        }
    }

    /**
     * Creates a new contract
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }

        $contract = new Contract();
        $contract->department_id = $this->request->getPost("department_id");
        $contract->contract_number = $this->request->getPost("contract_number");
        $contract->date = $this->request->getPost("date");
        $contract->theme = $this->request->getPost("theme");
        $contract->product_name = $this->request->getPost("product_name");
        $contract->workcompletion = $this->request->getPost("work_completion");
        $contract->product_use_method = $this->request->getPost("product_use_method");
        $contract->transfer_mony = $this->request->getPost("transfer_mony");
        $contract->paym_ethod = $this->request->getPost("pay_method");
        $contract->surcharge = $this->request->getPost("surcharge");
        $contract->surchargecondition = $this->request->getPost("surcharge_condition");
        $contract->fine = $this->request->getPost("fine");
        $contract->fine_conditions = $this->request->getPost("fine_conditions");
        $contract->start_date = $this->request->getPost("start_date");
        $contract->end_date = $this->request->getPost("end_date");
        $contract->transfer_right = $this->request->getPost("transfer_right");
        $contract->publication_rights = $this->request->getPost("publication_rights");
        $contract->other_rights = $this->request->getPost("other_rights");
        $contract->trunsfer_profit_percent = $this->request->getPost("trunsfer_profit_percent");
        $contract->contractor_id = $this->request->getPost("contractor_id");
        

        if (!$contract->save()) {
            foreach ($contract->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Договор был успешно добавлен.");

        $this->dispatcher->forward([
            'controller' => "contract",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a contract edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $contract = Contract::findFirstByid($id);

        if (!$contract) {
            $this->flash->error("Договор не существует " . $id);

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }

        $contract->department_id = $this->request->getPost("department_id");
        $contract->contract_number = $this->request->getPost("contract_number");
        $contract->date = $this->request->getPost("date");
        $contract->theme = $this->request->getPost("theme");
        $contract->product_name = $this->request->getPost("product_name");
        $contract->workcompletion = $this->request->getPost("work_completion");
        $contract->product_use_method = $this->request->getPost("product_use_method");
        $contract->transfer_mony = $this->request->getPost("transfer_mony");
        $contract->pay_method = $this->request->getPost("pay_method");
        $contract->surcharge = $this->request->getPost("surcharge");
        $contract->surchargecondition = $this->request->getPost("surcharge_сondition");
        $contract->fine = $this->request->getPost("fine");
        $contract->fine_conditions = $this->request->getPost("fine_conditions");
        $contract->start_date = $this->request->getPost("start_date");
        $contract->end_date = $this->request->getPost("end_date");
        $contract->transfer_right = $this->request->getPost("transfer_right");
        $contract->publication_rights = $this->request->getPost("publication_rights");
        $contract->other_rights = $this->request->getPost("other_rights");
        $contract->trunsfer_profit_percent = $this->request->getPost("trunsfer_profit_percent");
        $contract->contractor_id = $this->request->getPost("contractor_id");
        

        if (!$contract->save()) {

            foreach ($contract->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'edit',
                'params' => [$contract->id]
            ]);

            return;
        }

        $this->flash->success("Договор был успешно отредактирован.");

        $this->dispatcher->forward([
            'controller' => "contract",
            'action' => 'index'
        ]);
    }

    public function setstatusAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $contract = Contract::findFirstByid($id);

        if (!$contract) {
            $this->flash->error("Договор не существует " . $id);

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }
        $contract->status = $this->request->getPost("status");

        if (!$contract->save()) {

            foreach ($contract->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'edit',
                'params' => [$contract->id]
            ]);

            return;
        }

        $this->flash->success("Статус договора ".$contract->contract_number." был успешно изменен!");

        $this->dispatcher->forward([
            'controller' => "contract",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a contract
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $contract = Contract::findFirstByid($id);
        if (!$contract) {
            $this->flash->error("Договор не найден.");

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'index'
            ]);

            return;
        }

        if (!$contract->delete()) {

            foreach ($contract->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "contract",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Контракт был успешно удален.");

        $this->dispatcher->forward([
            'controller' => "contract",
            'action' => "index"
        ]);
    }

}
