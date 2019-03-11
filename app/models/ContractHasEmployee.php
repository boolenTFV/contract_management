<?php

class ContractHasEmployee extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="contract_id", type="integer", length=11, nullable=false)
     */
    public $contract_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="employee_id", type="integer", length=11, nullable=false)
     */
    public $employee_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("contract_has_employee");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
        $this->belongsTo('employee_id', '\Employee', 'id', ['alias' => 'Employee']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractHasEmployee[]|ContractHasEmployee|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ContractHasEmployee|\Phalcon\Mvc\Model\ResultInterface
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
        return 'contract_has_employee';
    }

}
