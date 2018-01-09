<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

use common\models\Transaction;

class Dashboard extends Model
{
    
    
    public static function getSalesStats($start=null,$finish=null)
    {
        if(!isset($start)){
            $start=Date('Y-m-d 00:00:00');
        }

        if(!isset($finish)){
            $finish=Date('Y-m-d 23:59:59');
        }

        $query = Transaction::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort'=> ['defaultOrder' => ['name'=>SORT_ASC]],
            'pagination' => false
        ]);

       
        // grid filtering conditions
        $query->andFilterWhere([
            'status' => Transaction::STATUS_SUCCESS,
            'type' => Transaction::TYPE_IN,
        ]);
        
        //$query->andFilterWhere(['like', 'lower(name)', strtolower($this->name)]);
          
            
        return $dataProvider;


    
    }
}

?>