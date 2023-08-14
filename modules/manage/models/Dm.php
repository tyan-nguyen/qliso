<?php

namespace app\modules\manage\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_dm".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_created
 * @property int|null $user_created
 */
class Dm extends \app\models\BmDm
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_created'], 'safe'],
            [['user_created'], 'integer'],
            [['name'], 'string', 'max' => 200],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên danh mục',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }
    
    /**
     * get list dm
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
