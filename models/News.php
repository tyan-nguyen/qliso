<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $date
 * @property string $author
 * @property string $description
 * @property string $content
 * @property int $view
 * @property string|null $slug
 * @property int|null $public
 * @property int|null $level
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'title', 'date', 'author', 'description', 'content', 'view'], 'required'],
            [['type', 'view', 'public', 'level'], 'integer'],
            [['description', 'content'], 'string'],
            [['title', 'slug'], 'string', 'max' => 200],
            [['date'], 'string', 'max' => 20],
            [['author'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'title' => 'Title',
            'date' => 'Date',
            'author' => 'Author',
            'description' => 'Description',
            'content' => 'Content',
            'view' => 'View',
            'slug' => 'Slug',
            'public' => 'Public',
            'level' => 'Level',
        ];
    }
}
