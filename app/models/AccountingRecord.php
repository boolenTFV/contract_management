<?php

class AccountingRecord extends SuperModel
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
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("accounting_record");
        $this->belongsTo('accounting_page_id', '\AccountingPage', 'id', ['alias' => 'AccountingPage']);
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
    }


    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'accounting_record';
    }
}
