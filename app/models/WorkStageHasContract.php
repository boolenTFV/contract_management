<?php

class WorkStageHasContract extends SuperModel
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
     * @codeCoverageIgnore
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("work_stage_has_contract");
        $this->belongsTo('contract_id', '\Contract', 'id', ['alias' => 'Contract']);
        $this->belongsTo('work_stage_id', '\WorkStage', 'id', ['alias' => 'WorkStage']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'work_stage_has_contract';
    }

}
