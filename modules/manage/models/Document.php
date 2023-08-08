<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use app\models\Custom;

/**
 * This is the model class for table "bm_document".
 *
 * @property int $id
 * @property int $id_working
 * @property string|null $document_name
 * @property string|null $document_url
 * @property string|null $document_type
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class Document extends \app\models\BmDocument
{    
    CONST FOLDER_DOCUMENT = '/results/';
    public $file;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_working'], 'required'],
            [['id_working', 'user_created'], 'integer'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['document_name', 'document_url'], 'string', 'max' => 200],
            [['document_type'], 'string', 'max' => 20],
            [['file'], 'file', 'extensions' => 'doc, docx, png, jpg, jpeg, xls, xlsx, pdf, ppt, pptx'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_working' => 'Cuộc họp',
            'document_name' => 'Tên tài liệu',
            'document_url' => 'Url',
            'document_type' => 'Loại tài liệu',
            'summary' => 'Ghi chú',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
            'file' => 'File document',
        ];
    }
    
    /**
     * Gets query for [[Working]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorking()
    {
        return $this->hasOne(Working::className(), ['id' => 'id_working']);
    }
    
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_created']);
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
     * before delete, xoa tat ca cac file lien quan
     */
    public function beforeDelete()
    {
        if($this->document_name != ''){
            $filePath = Yii::getAlias('@webroot') . $this::FOLDER_DOCUMENT . $this->working->code . '/' . $this->id . '.' . $this->document_type;
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }
        
        parent::beforeDelete();
        
        return true;
    }
    
    /**
     * show user name
     */
    public function getUserCreated(){
        if($this->user != null)
            return $this->user->username;
            else
                return '';
    }
    
    /**
     * get host_file
     */
    public function getDocumentType(){
        if($this->document_url != null){
            return '<span class="label label-primary">web</span>';
        } else {
            return '<span class="label label-warning">file</span>';
        }
    }
    
    /**
     * get file type ext
     */
    public function getFileExtIcon(){
        $custom = new Custom();
        return $custom->showIconExt($this->document_type);
    }
}
