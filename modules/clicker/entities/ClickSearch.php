<?php
/**
 * Created by Yuriy Hritsaiy.
 * Email: yu.hritsaiy@gmail.com
 */

namespace app\modules\clicker\entities;

use yii\data\ActiveDataProvider;

/**
 *
 */
class ClickSearch extends Click
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['error', 'bad_domain'], 'integer'],
            [['id', 'ip'], 'string', 'max' => 25],
            [['ua', 'ref', 'param1', 'param2'], 'string', 'max' => 255],
        ];
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
        $query = Click::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['LIKE', 'ip', $this->ip])
            ->andFilterWhere(['LIKE', 'ua', $this->ua])
            ->andFilterWhere(['LIKE', 'ref', $this->ref])
            ->andFilterWhere(['LIKE', 'param1', $this->param1])
            ->andFilterWhere(['LIKE', 'param2', $this->param2])
            ->andFilterWhere(['bad_domain' => $this->bad_domain]);

        return $dataProvider;
    }
}
