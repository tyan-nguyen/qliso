<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string|null $gender
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $catalog
 * @property string $content
 * @property string $dateCreated
 * @property int|null $viewed
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content', 'dateCreated'], 'required'],
            [['address', 'content'], 'string'],
            [['dateCreated'], 'safe'],
            [['viewed'], 'integer'],
            [['gender', 'phone'], 'string', 'max' => 20],
            [['name', 'email', 'catalog'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gender' => 'Gender',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'catalog' => 'Catalog',
            'content' => 'Content',
            'dateCreated' => 'Date Created',
            'viewed' => 'Viewed',
        ];
    }
}
