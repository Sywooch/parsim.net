<?php

namespace common\models\searchForms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QueueMail;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class QueueMailSearch extends QueueMail
{

    
    public function rules()
    {
        return [
            [['subject'], 'safe'],
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
        $query = QueueMail::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['subject'=>SORT_ASC]],
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
        //$query->andFilterWhere([
        //    'status' => $this->status,
        //]);
        
        $query->andFilterWhere(['like', 'lower(subject)', strtolower($this->subject)]);
          
            
        return $dataProvider;
    }
}
