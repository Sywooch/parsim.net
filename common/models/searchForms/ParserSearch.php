<?php

namespace common\models\searchForms;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Parser;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class ParserSearch extends Parser
{
    public $url;
    //public $type=self::TYPE_DESTINATION;
    /**
     * @inheritdoc
     */
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Parser::find();
        

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

        
        $query->andFilterWhere(['like', 'name', $this->name]);
          
            
        return $dataProvider;
    }
}
