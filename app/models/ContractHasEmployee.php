<?php

class ContractHasEmployee extends SuperModel
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
     * 
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("contract_has_employee");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
        $this->belongsTo('employee_id', '\Employee', 'id', ['alias' => 'Employee']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'contract_has_employee';
    }

}
