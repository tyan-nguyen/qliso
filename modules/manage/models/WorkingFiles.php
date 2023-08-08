<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use app\models\Custom;

/**
 * This is the model class for table "bm_working_files".
 *
 * @property int $id
 * @property int $id_working
 * @property int|null $id_user
 * @property string $file_name
 * @property string|null $file_type
 * @property string $file_url
 * @property string|null $shared_with
 * @property string|null $summary
 * @property string|null $date_created
 * @property int|null $user_created
 */
class WorkingFiles extends \app\models\BmWorkingFiles
{
    CONST FOLDER_DOCUMENT = '/results/';
    public $file;
    CONST TYPE_BB = 'TYPE_BB';
    CONST TYPE_CN = 'TYPE_CN';
    CONST TYPE_OTHER = 'TYPE_OTHER';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_working', 'file_name'], 'required'],
            [['id_working', 'id_user', 'user_created'], 'integer'],
            [['summary'], 'string'],
            [['date_created'], 'safe'],
            [['file_name', 'file_url', 'shared_with'], 'string', 'max' => 200],
            [['file_type'], 'string', 'max' => 20],
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
            'id_user' => 'Thành viên',
            'file_name' => 'File Name',
            'file_type' => 'Loại file',
            'file_url' => 'File Url',
            'shared_with' => 'Shared With',
            'summary' => 'Ghi chú',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
            'file' => 'File biên bản',
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
        if($this->file_name != ''){
            $filePath = Yii::getAlias('@webroot') . $this::FOLDER_DOCUMENT . $this->working->code . '/' . $this->file_name;
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }
        
        parent::beforeDelete();
        
        return true;
    }
    
    
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'id_user']);
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
     * get list type file
     */
    public function getTypeList(){
        return [
            'TYPE_BB' => 'Mẫu biên bản',
            'TYPE_CN' => 'Mẫu cá nhân',
            'TYPE_OTHER' => 'Mẫu hoàn thành'
        ];
    }
    /**
     * get list type file
     */
    public function getTypeName(){
        if($this->file_type == $this::TYPE_BB)
            return 'Mẫu biên bản';
        else if($this->file_type == $this::TYPE_CN)
            return 'Mẫu cá nhân';
        else if($this->file_type == $this::TYPE_OTHER)
            return 'Mẫu hoàn thành';
        else 
            return null;
    }
    /**
     * get host_file
     */
    public function getHostFile(){
        if($this->file_url != null){
            return '<span class="badge badge-primary">drive</span>';
        } else {
            return '<span class="badge badge-success">server</span>';
        }
    }
    /**
     * get file type ext
     */
    public function getFileExt(){
        $ext = explode('.', $this->file_name);
        return '<span class="badge badge-primary">' . end($ext) . '</span>';
    }
    /**
     * get file type ext
     */
    public function getFileExtIcon(){
        $extension = explode('.', $this->file_name);
        $custom = new Custom();
        return $custom->showIconExt(end($extension));
    }
}
