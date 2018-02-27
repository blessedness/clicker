<?php

namespace app\modules\clicker\entities;

/**
 * This is the model class for table "{{%click}}".
 *
 * @property string $id
 * @property string $ua
 * @property string $ip
 * @property string $ref
 * @property string $param1
 * @property string $param2
 * @property int $error
 * @property string $bad_domain
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%click}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ua', 'ip'], 'required'],
            [['error', 'bad_domain'], 'integer'],
            [['id', 'ip'], 'string', 'max' => 25],
            [['ua', 'ref', 'param1', 'param2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ua' => 'Ua',
            'ip' => 'Ip',
            'ref' => 'Ref',
            'param1' => 'Param1',
            'param2' => 'Param2',
            'error' => 'Error',
            'bad_domain' => 'Bad Domain',
        ];
    }
}
