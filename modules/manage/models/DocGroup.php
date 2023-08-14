<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_docgroup".
 *
 * @property int $id
 * @property string $name
 * @property int|null $id_iso
 * @property string|null $date_created
 * @property int|null $user_created
 *
 * @property BmDocs[] $bmDocs
 * @property BmIso $iso
 */
class DocGroup extends \app\models\BmDocgroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_iso', 'user_created'], 'integer'],
            [['date_created'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['id_iso'], 'exist', 'skipOnError' => true, 'targetClass' => Iso::class, 'targetAttribute' => ['id_iso' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhóm tài liệu',
            'id_iso' => 'Thuộc ISO',
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
        return $this->hasMany(Docs::class, ['id_group' => 'id']);
    }

    /**
     * Gets query for [[Iso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIso()
    {
        return $this->hasOne(Iso::class, ['id' => 'id_iso']);
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
     * get list doc group
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
    
    /**
     * get list long
     */
    public function getListLong(){
        $list = $this::find()->alias('t')
        ->joinWith(['iso as is'])
        ->select(['t.id', "CONCAT(t.name, ' (', is.name, ')') as longname"])->asArray()->all();
        return ArrayHelper::map($list, 'id', 'longname');
    }
    
    /**
     * get list doc group by room (not iso)
     */
    public function getListByRoom(){
        $list = $this::find()->where('id_iso IS NULL OR id_iso = 0')->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
