<?php

class AccountingPage extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(column="time", type="string", length=6, nullable=false)
     */
    public $time;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=70, nullable=true)
     */
    public $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("accounting_page");
        $this->hasMany('id', 'AccountingRecord', 'accounting_page_id', ['alias' => 'AccountingRecord']);
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AccountingPage[]|AccountingPage|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AccountingPage|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public static function searchColumns($searchStr)
    {
        $search = explode(' ',$searchStr);
        $searchColumns=['id','name','time'];
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

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'accounting_page';
    }

}
