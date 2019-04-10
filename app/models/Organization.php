<?php

class Organization extends SuperModel
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
     * @Column(column="name", type="string", length=45, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(column="index", type="string", length=45, nullable=true)
     */
    public $index;

    /**
     *
     * @var string
     * @Column(column="bank_index", type="string", length=45, nullable=true)
     */
    public $bank_index;

    /**
     *
     * @var string
     * @Column(column="bank_account", type="string", length=45, nullable=true)
     */
    public $bank_account;

    /**
     * Initialize method for model.
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("organization");
        $this->hasMany('id', 'Contractor', 'organization_id', ['alias' => 'Contractor']);
    }


    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'organization';
    }
}
