<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'customer_id'], 'integer'],
            [['shipping_fees' , 'total_amount'], 'number'],
            [['customer_notes', 'product_notes','created_at'], 'safe'],
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
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'customer_id' => $this->customer_id,
            'shipping_fees' => $this->shipping_fees,
            'total_amount' => $this->total_amount,
        ]);

        $query->andFilterWhere(['like', 'customer_notes', $this->customer_notes])
            ->andFilterWhere(['like', 'product_notes', $this->product_notes])
            ->andFilterWhere(['like', "(date_format( FROM_UNIXTIME(`created_at` ), '%Y-%m-%d %h:%i:%s %p' ))", $this->created_at]);

        return $dataProvider;
    }
}
