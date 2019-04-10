<?php

class WorkStage extends SuperModel
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
     * @Column(column="start_date", type="string", nullable=true)
     */
    public $start_date;

    /**
     *
     * @var string
     * @Column(column="end_date", type="string", nullable=true)
     */
    public $end_date;

    /**
     *
     * @var string
     * @Column(column="name", type="string", length=45, nullable=true)
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
        $this->setSource("work_stage");
        $this->hasMany('id', 'WorkStageHasContract', 'work_stage_id', ['alias' => 'WorkStageHasContract']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @codeCoverageIgnore
     * @return string
     */
    public function getSource()
    {
        return 'work_stage';
    }

}
