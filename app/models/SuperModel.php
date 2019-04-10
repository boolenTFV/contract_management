<?php

use Phalcon\Mvc\Model\MetaData;

class SuperModel extends \Phalcon\Mvc\Model
{
    public const searchColumns = null;
    /**
     * Возвращает столбцы таблицы 
     */
    public static function getColumns(){
        $model = new static();
        $metadata = $model->getModelsMetaData();
        $attributes = $metadata->getAttributes($model);
        return $attributes;
    }

    /**
     * В качестве параметра принимает поисковую строку. 
     * Также есть дополнительный параметр, относительно 
     * которого нужно осуществлять поиск.
     * Взвращает результирующий запрос.
     * 
     *@codeCoverageIgnore
     */
    public static function searchColumns($searchStr, $query = null)
    {
        $search = explode(' ',$searchStr);
        //если поля для поиска не определены
        $searchColumns = static::searchColumns;
        if($searchColumns==null){
            //записать все поля таблицы
            $searchColumns = static::getColumns();
        }
        if( $query==null ){
            $query = self::query();
        }
        $paramIndex=1;
        foreach ($search as $key => $tag) {
            $andQueryStr = '';
            foreach ($searchColumns as $colIndex => $column) {
                if($colIndex===0){
                    $andQueryStr = $column . ' LIKE ?'.$paramIndex;
                }else{
                    $andQueryStr .= ' OR '.$column . ' LIKE ?'.$paramIndex;
                }      
            }  
            $param = '%' . $tag . '%';
            $query->andWhere($andQueryStr)
                ->bind( [$paramIndex=>$param], true );
            $paramIndex++;
        }
        $query;
        return $query;
     }
}
