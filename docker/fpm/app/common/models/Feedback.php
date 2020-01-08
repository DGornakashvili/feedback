<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "postgres.feedback".
 *
 * @property int $id
 * @property string|null $name
 * @property string $phone
 * @property int $status 0 - на модерации | 1 - модерация пройдена
 */
class Feedback extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'string', 'max' => 256],
            ['status', 'integer'],
            ['status', 'default', 'value' => 0],
            ['phone', 'required'],
            ['phone', 'match', 'pattern' => Yii::$app->params['regExpPhone'], 'message' => 'Incorrect phone format.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'status' => 'Статус',
        ];
    }
}
