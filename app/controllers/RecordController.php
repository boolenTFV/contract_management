<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model as Paginator;


class RecordController extends ControllerBase
{
    /**
     * Поиск записей в учетных таблицах
     * id - страница поиска
     */
    public function indexAction($id)
    {
        $numberPage = 1;
        $this->view->id = $id;
        if ($this->request->isGet()) {
            $numberPage = $this->request->getQuery("page", "int");
        }
        $accountingRecord = AccountingRecord::query()
                            ->where("accounting_page_id = :id:")
                            ->bind(['id'=>$id])
                            ->execute();

        if (count($accountingRecord) == 0) {
            $this->flash->notice("Страница не содержит записей");
        }

        $paginator = new Paginator([
            'data' => $accountingRecord,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction($id)
    {


        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }
        $records = $this->request->getPost("record");
        if($records!=null){
            foreach ($records as $record_id => $record) {
                $accountingRecord = AccountingRecord::findFirst($record_id);
                if($accountingRecord){
                    $accountingRecord->contract_id = $record['contract_id'];
                    $accountingRecord->admission_date = $record['admission_date'];
                    $accountingRecord->admission = $record['admission'];
                    $accountingRecord->additional_expenses = $record['additional_expenses'];
                    $accountingRecord->reminder = $record['reminder'];
                    $accountingRecord->tax = $record['tax'];
                    $accountingRecord->wage = $record['wage'];
                    $accountingRecord->reminder = $record['reminder'];
                    if (!$accountingRecord->save()) {
                        foreach ($accountingRecord->getMessages() as $message) {
                            $this->sflash->error($accountingRecord->contract->contract_number.
                                ": ".$message);
                        }
                    }
                }
            }
        }

        $this->sflash->success("Лист учета был сохранен!");

/*        $this->dispatcher->forward([
            'controller' => 'record',
            'action' => 'index',
            'params' =>['id'=>$id]
        ]);*/
        $response = new Response();
        return $response->redirect("record/index/".$id);
    }

/**
     * Creates a new user
     */
    public function createAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {
             $this->flash->error("Запрос не был POST!");
            $this->dispatcher->forward([
                'controller' => "record",
                'action' => 'index'
            ]);

            return;
        }
        $isExist = AccountingRecord::findFirst(    [
            'conditions' => 'contract_id = ?1 AND accounting_page_id=?2',
            'bind'       => [
                1 => $request->getPost('contract_id'),
                2 => $id
            ]
        ]);

        if($isExist){
            $this->sflash->error("Запись с таким договором уже существует!");
            $response = new Response();
            return $response->redirect("record/index/".$id);
        }

        $accountingRecord = new AccountingRecord();
        $accountingRecord->accounting_page_id = $id;
        $accountingRecord->contract_id = $request->getPost('contract_id');
        $accountingRecord->admission = $request->getPost('admission');
        $accountingRecord->admission_date = $request->getPost('admission_date');
        $accountingRecord->additional_expenses = $request->getPost('additional_expenses');
        $accountingRecord->reminder = $request->getPost('reminder');
        $accountingRecord->tax = $request->getPost('tax');
        $accountingRecord->wage = $request->getPost('wage');


        

        if (!$accountingRecord->save()) {
            foreach ($accountingRecord->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "record",
                'action' => 'index'
            ]);

            return;
        }

        $this->sflash->success("Запись успешно добавлена!");

/*        $this->dispatcher->forward([
            'controller' => 'record',
            'action' => 'index',
            'params' =>['id'=>$id]
        ]);*/
        $response = new Response();
        return $response->redirect("record/index/".$id);
    }


    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id,$record_id)
    {
        $accountingRecord = AccountingRecord::findFirstByid($record_id);
        if (!$accountingRecord) {
            $this->flash->error("Записи не существует!");

            $this->dispatcher->forward([
                'controller' => "record",
                'action' => 'index',
                'params'=>["id"=>$id] 
            ]);

            return;
        }

        if (!$accountingRecord->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "record",
                'action' => 'index',
                'params'=>["id"=>$id] 
            ]);

            return;
        }

        $this->flash->success("Запись была удалена!");

        $this->dispatcher->forward([
            'controller' => "record",
            'action' => 'index',
            'params'=>["id"=>$id] 
        ]);
    }

}
