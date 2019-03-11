<?php

class Contractor extends \Phalcon\Mvc\Model
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
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("contractor");
        $this->hasMany('id', 'Contract', 'contractor_id', ['alias' => 'Contract']);
        $this->belongsTo('organization_id', '\Organization', 'id', ['alias' => 'Organization']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contractor[]|Contractor|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Contractor|\Phalcon\Mvc\Model\ResultInterface
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
        return 'contractor';
    }

    public static function searchColumns($searchStr)
    {
        $search = explode(' ',$searchStr);
        $searchColumns=['name','surename','position'];
        $query = self::query();
        $paramIndex = 0;
        $bindMass=[];
        foreach ($search as $key => $tag) {
            $andQueryStr = '';
            foreach ($searchColumns as $colIndex => $column) {
                if($colIndex===0){
                    $andQueryStr = $column . ' LIKE ?'.$paramIndex;
                }else{
                    $andQueryStr .= ' OR '.$column . ' LIKE ?'.$paramIndex;
                }      
            }  
            $bindMass[$paramIndex] = '%' . $tag . '%';
            $paramIndex++;
            $query->andWhere($andQueryStr);
        }
        $query->bind($bindMass);
        return $query->execute();
     }

}
