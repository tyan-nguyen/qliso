<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_doctype".
 *
 * @property int $id
 * @property string $name
 * @property string|null $date_created
 * @property int|null $user_created
 *
 * @property BmDocs[] $bmDocs
 */
class DocType extends \app\models\BmDoctype
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_doctype';
    }

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
            'name' => 'Tên loại văn bản',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
        ];
    }

    /**
     * Gets query for [[BmDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::class, ['id_type' => 'id']);
    }
    
    /**
     * before save
     * set ngay luu, nguoi luu
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->user_created = Yii::$app->user->id;
                $this->date_created = date('Y-m-d H:i:s');
            }
        }
        return true;
    }
    /**
     * show user name
     */
    public function getUserCreated(){
        $user = User::findOne($this->user_created);
        if($user != null)
            return $user->username;
            else
                return '';
    }
    
    /**
     * get list doc type
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
