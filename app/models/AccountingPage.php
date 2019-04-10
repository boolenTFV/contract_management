<?php

class AccountingPage extends SuperModel
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
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("accounting_page");
        $this->hasMany('id', 'AccountingRecord', 'accounting_page_id', ['alias' => 'AccountingRecord']);
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
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
