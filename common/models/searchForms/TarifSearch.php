<?php

namespace common\models\searchForms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tarif;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class TarifSearch extends Tarif
{

    
    public function rules()
    {
        return [
            [['status','name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    
    public function search($params)
    {
        $query = Tarif::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['name'=>SORT_ASC]],
            'pagination' => [
                'pageSize'=>10,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status' => $this->status,
        ]);
        
        $query->andFilterWhere(['like', 'lower(name)', strtolower($this->name)]);
          
            
        return $dataProvider;
    }
}
