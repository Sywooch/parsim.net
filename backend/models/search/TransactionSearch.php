<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transaction;

/**
 * OrderSearch represents the model behind the search form about `common\models\order`.
 */
class TransactionSearch extends Transaction
{

    public $begin;
    public $end;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin', 'end'], 'integer'],
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
        $query = Transaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->where(['between', 'created_at', $this->begin, $this->end]);

        return $dataProvider;
    }

    public function getAmountTotal($params)
    {
        $amount=0;
        foreach ($this->search($params)->getModels() as $order) {
            $amount+=$order->amount;
        }
        return $amount;
    }
}