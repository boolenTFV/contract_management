<?php

class Employee extends \Phalcon\Mvc\Model
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("employee");
        $this->hasMany('id', 'ContractHasEmployee', 'employee_id', ['alias' => 'ContractHasEmployee']);
        $this->belongsTo('department_id', '\Department', 'id', ['alias' => 'Department']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Employee[]|Employee|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Employee|\Phalcon\Mvc\Model\ResultInterface
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
        return 'employee';
    }

}
