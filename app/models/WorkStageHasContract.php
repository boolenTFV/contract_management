<?php

class WorkStageHasContract extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="work_stage_id", type="integer", length=11, nullable=false)
     */
    public $work_stage_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(column="contract_id", type="integer", length=11, nullable=false)
     */
    public $contract_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("work_stage_has_contract");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
        $this->belongsTo('work_stage_id', '\WorkStage', 'id', ['alias' => 'WorkStage']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WorkStageHasContract[]|WorkStageHasContract|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WorkStageHasContract|\Phalcon\Mvc\Model\ResultInterface
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
        return 'work_stage_has_contract';
    }

}
