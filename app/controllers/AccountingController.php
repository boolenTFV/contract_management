<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AccountingController extends ControllerBase
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
        $accountingPage = AccountingPage::searchColumns($parameters)->execute();
        if (count($accountingPage) == 0) {
            $this->flash->notice("Поиск не дал результатов.");
        }

        $paginator = new Paginator([
            'data' => $accountingPage,
            'limit'=> 8,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "accounting",
                'action' => 'index'
            ]);

            return;
        }

        $accountingPage = new AccountingPage();
        $accountingPage->name = $this->request->getPost("name");
        $isAddContracts = $this->request->getPost("is_add_contracts");

        if (!$accountingPage->save()) {
            foreach ($accountingPage->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "accounting",
                'action' => 'index'
            ]);

            return;
        }

        $this->flash->success("Контракт был успешно добавлен!!");

        if($isAddContracts){
            $activeContracts = Contract::find("status='active'");
            foreach ($activeContracts as $contract) {
                $record = new AccountingRecord();
                $record->contract_id = $contract->id;
                $record->accounting_page_id = $accountingPage->id;
                if (!$record->save()) {
                    $this->flash->error("Не удалось добавить контракт: ".$contract->contract_number);
                    foreach ($record->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                }
            }

        }

        $this->dispatcher->forward([
            'controller' => "accounting",
            'action' => 'index'
        ]);
    }

    public function deleteAction($id)
    {
        $AccountingPage = AccountingPage::findFirstByid($id);
        if (!$AccountingPage) {
            $this->flash->error("Страница не найдена!");

            $this->dispatcher->forward([
                'controller' => "accounting",
                'action' => 'index'
            ]);

            return;
        }

        if (!$AccountingPage->delete()) {

            foreach ($AccountingPage->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "accounting",
                'action' => 'index'
            ]);

            return;
        }

        $this->flash->success("Страница была успешно удалена!");

        $this->dispatcher->forward([
            'controller' => "accounting",
            'action' => "index"
        ]);
    }
}
