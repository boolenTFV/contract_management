<?php

class AccountingRecord extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    public $id;

    /**
     *
     * @var double
     * @Column(column="admission", type="double", length=10, nullable=true)
     */
    public $admission;

    /**
     *
     * @var string
     * @Column(column="admission_date", type="string", nullable=true)
     */
    public $admission_date;

    /**
     *
     * @var double
     * @Column(column="tax", type="double", length=10, nullable=true)
     */
    public $tax;

    /**
     *
     * @var double
     * @Column(column="wage", type="double", length=10, nullable=true)
     */
    public $wage;

    /**
     *
     * @var double
     * @Column(column="reminder", type="double", length=10, nullable=true)
     */
    public $reminder;

    /**
     *
     * @var double
     * @Column(column="additional_expenses", type="double", length=10, nullable=true)
     */
    public $additional_expenses;

    /**
     *
     * @var integer
     * @Column(column="accounting_page_id", type="integer", length=11, nullable=false)
     */
    public $accounting_page_id;

    /**
     *
     * @var integer
     * @Column(column="contract_id", type="integer", length=11, nullable=false)
     */
    public $contract_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("accounting_record");
        $this->belongsTo('accounting_page_id', '\AccountingPage', 'id', ['alias' => 'AccountingPage']);
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AccountingRecord[]|AccountingRecord|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AccountingRecord|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'accounting_record';
    }

    public static function searchColumns($searchStr)
    {
        $search = explode(' ',$searchStr);
        $searchColumns=['name','surname','patronymic','type'];
        $query = self::query();
        $paramIndex = 0;
        $bindMass=[];
        foreach ($search as $key => $tag) {
            $andQueryStr = '';
            foreach ($searchColumns as $colIndex => $column) {
                if($colIndex===0){
                    $andQueryStr = $column . ' LIKE ?'.$paramIndex;
                }else{
                    $andQueryStr .= ' OR '.$column . ' LIKE ?'.$paramIndex;
                }      
            }  
            $bindMass[$paramIndex] = '%' . $tag . '%';
            $paramIndex++;
            $query->andWhere($andQueryStr);
        }
        $query->bind($bindMass);
        return $query->execute();
     }
}
