<?php

namespace app\models;

use Yii;

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
class BmDocgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bm_docgroup';
    }

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
            [['id_iso'], 'exist', 'skipOnError' => true, 'targetClass' => BmIso::class, 'targetAttribute' => ['id_iso' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_iso' => 'Id Iso',
            'date_created' => 'Date Created',
            'user_created' => 'User Created',
        ];
    }

    /**
     * Gets query for [[BmDocs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBmDocs()
    {
        return $this->hasMany(BmDocs::class, ['id_group' => 'id']);
    }

    /**
     * Gets query for [[Iso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIso()
    {
        return $this->hasOne(BmIso::class, ['id' => 'id_iso']);
    }
}
