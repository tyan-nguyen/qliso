<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\SluggableBehavior;

class News extends \app\models\News
{
	public function behaviors()
	{
		return [
				[
						'class' => SluggableBehavior::className(),
						'attribute' => 'title',
						'immutable' => true,
						'ensureUnique'=>true,
						//'uniqueValidator'=>[]
						// 'slugAttribute' => 'slug',
				],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'title'], 'required'],
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
            'type' => 'Loại bài viết',
            'title' => 'Tiêu đề',
            'date' => 'Ngày tạo',
            'author' => 'Tác giả',
            'description' => 'Tóm tắt',
            'content' => 'Nội dung',
            'view' => 'Lượt xem',
            'slug' => 'Url',
        	'public' => 'Công bố',
        	'level' => 'Thứ tự'
        ];
    }
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    		if($this->isNewRecord){
    			if($this->public == null){
    				$this->public = 0;
    			}
    			if($this->view == null){
    				$this->view = 0;
    			}
    			if($this->date == null){
    				$this->date = date('d/m/Y H:i:s');
    			}
    		}
    		if($this->level == null){
    			$this->level = 0;
    		}
    	}
    	return true;
    }
    
    /**
     * show list type
     * @return string[]
     */
    public function getType()
    {
    	return [
    			1=>'Trang sinh viên',
    			2=>'Trang giảng viên',
    	];
    }
    /**
     * get text of type
     * @return string
     */
    public function getTypeText()
    {
    	$kq = '';
    	if($this->type == 1)
    		$kq = 'Trang sinh viên';
    	else if($this->type == 2)
    		$kq = 'Trang giảng viên';
    	return $kq;
    }
}
