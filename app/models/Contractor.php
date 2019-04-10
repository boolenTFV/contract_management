<?php

class Contractor extends SuperModel
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
     * @Column(column="surename", type="string", length=45, nullable=true)
     */
    public $surename;

    /**
     *
     * @var string
     * @Column(column="position", type="string", length=45, nullable=true)
     */
    public $position;

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="organization_id", type="integer", length=11, nullable=false)
     */
    public $organization_id;

    /**
     * Initialize method for model.
     * 
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("contractor");
        $this->hasMany('id', 'Contract', 'contractor_id', ['alias' => 'Contract']);
        $this->belongsTo('organization_id', '\Organization', 'id', ['alias' => 'Organization']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'contractor';
    }
}
