<?php

class Organization extends \Phalcon\Mvc\Model
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
     */
    public function initialize()
    {
        $this->setSchema("contracts");
        $this->setSource("organization");
        $this->hasMany('id', 'Contractor', 'organization_id', ['alias' => 'Contractor']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Organization[]|Organization|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Organization|\Phalcon\Mvc\Model\ResultInterface
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
        return 'organization';
    }

        //поиск по полям
    public static function searchColumns($searchStr)
    {
        $search = explode(' ',$searchStr);
        $searchColumns=['name','index','bank_index','bank_account'];
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
