<?php

class Employee extends SuperModel
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
     * @Column(column="patronymic", type="string", length=45, nullable=true)
     */
    public $patronymic;

    /**
     *
     * @var string
     * @Column(column="position", type="string", length=45, nullable=true)
     */
    public $position;

    /**
     *
     * @var integer
     * @Column(column="department_id", type="integer", length=11, nullable=false)
     */
    public $department_id;

    /**
     * Initialize method for model
     *
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("employee");
        $this->hasMany('id', 'ContractHasEmployee', 'employee_id', ['alias' => 'ContractHasEmployee']);
        $this->belongsTo('department_id', '\Department', 'id', ['alias' => 'Department']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'employee';
    }

}
