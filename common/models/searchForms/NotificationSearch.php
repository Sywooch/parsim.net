<?php

namespace common\models\searchForms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class NotificationSearch extends Notification
{
    
    public function rules()
    {
        return [
            [['status'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Notification::find();
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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

        
        $query->andFilterWhere([
            'user_id' => $this->user_id,
        ]);


        /*
        $query
            ->andFilterWhere(['like', 'orgunit.name', $this->name]);
        */  
            
        return $dataProvider;
    }
}
