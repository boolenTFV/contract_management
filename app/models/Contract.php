<?php

class Contract extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(column="department_id", type="integer", length=11, nullable=false)
     */
    public $department_id;

    /**
     *
     * @var string
     * @Column(column="contract_number", type="string", length=45, nullable=true)
     */
    public $contract_number;

    /**
     *
     * @var string
     * @Column(column="date", type="string", nullable=true)
     */
    public $date;

    /**
     *
     * @var string
     * @Column(column="theme", type="string", length=200, nullable=true)
     */
    public $theme;

    /**
     *
     * @var string
     * @Column(column="product_name", type="string", length=45, nullable=true)
     */
    public $product_name;

    /**
     *
     * @var string
     * @Column(column="work_completion", type="string", nullable=true)
     */
    public $work_completion;

    /**
     *
     * @var string
     * @Column(column="product_use_method", type="string", length=45, nullable=true)
     */
    public $product_use_method;

    /**
     *
     * @var string
     * @Column(column="transfer_mony", type="string", length=45, nullable=true)
     */
    public $transfer_mony;

    /**
     *
     * @var string
     * @Column(column="pay_method", type="string", length=45, nullable=true)
     */
    public $pay_method;

    /**
     *
     * @var string
     * @Column(column="surcharge", type="string", length=45, nullable=true)
     */
    public $surcharge;

    /**
     *
     * @var string
     * @Column(column="surcharge_condition", type="string", length=45, nullable=true)
     */
    public $surcharge_condition;

    /**
     *
     * @var string
     * @Column(column="fine", type="string", length=45, nullable=true)
     */
    public $fine;

    /**
     *
     * @var string
     * @Column(column="fine_conditions", type="string", length=45, nullable=true)
     */
    public $fine_conditions;

    /**
     *
     * @var string
     * @Column(column="start_date", type="string", nullable=true)
     */
    public $start_date;

    /**
     *
     * @var string
     * @Column(column="end_date", type="string", nullable=true)
     */
    public $end_date;

    /**
     *
     * @var string
     * @Column(column="transfer_right", type="string", nullable=true)
     */
    public $transfer_right;

    /**
     *
     * @var string
     * @Column(column="publication_rights", type="string", length=45, nullable=true)
     */
    public $publication_rights;

    /**
     *
     * @var string
     * @Column(column="other_rights", type="string", length=45, nullable=true)
     */
    public $other_rights;

    /**
     *
     * @var integer
     * @Column(column="trunsfer_profit_percent", type="integer", length=11, nullable=true)
     */
    public $trunsfer_profit_percent;

    /**
     *
     * @var string
     * @Column(column="status", type="string", nullable=false)
     */
    public $status;

    /**
     *
     * @var integer
     * @Column(column="contractor_id", type="integer", length=11, nullable=false)
     */
    public $contractor_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("contract");
        $this->hasMany('id', 'ContractHasEmployee', 'contract_id', ['alias' => 'ContractHasEmployee']);
        $this->hasMany('id', 'Document', 'contract_id', ['alias' => 'Document']);
        $this->hasMany('id', 'WorkStageHasContract', 'contract_id', ['alias' => 'WorkStageHasContract']);
        $this->belongsTo('contractor_id', '\Contractor', 'id', ['alias' => 'Contractor']);
        $this->belongsTo('department_id', '\Department', 'id', ['alias' => 'Department']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contract[]|Contract|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contract|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public static function searchColumns($searchStr)
    {
        $search = explode(' ',$searchStr);
        $searchColumns=['contract_number','theme','product_name', 'fine','surcharge'];
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
        return 'contract';
    }
}
