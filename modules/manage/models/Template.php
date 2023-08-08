<?php

namespace app\modules\manage\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "bm_template".
 *
 * @property int $id
 * @property string $name
 * @property string|null $summary
 * @property string|null $code
 * @property string|null $file_name
 * @property int|null $is_default
 * @property string|null $date_created
 * @property int|null $user_created
 */
class Template extends \app\models\BmTemplate
{
    CONST FOLDER_TEMPALTE = '/templates/';
    
    public $file;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['summary'], 'string'],
            [['is_default', 'user_created'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'code', 'file_name'], 'string', 'max' => 200],
            [['file'], 'file', 'extensions' => 'doc, docx'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên mẫu',
            'summary' => 'Ghi chú',
            'code' => 'Code',
            'file_name' => 'Tên file',
            'is_default' => 'Mặc định',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
            'file' => 'File đính kèm',
        ];
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
                if($this->is_default == null)
                    $this->is_default = 0;
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
            $filePath = Yii::getAlias('@webroot') . $this::FOLDER_TEMPALTE . '.' . $this->file_name;
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
        $user = User::findOne($this->user_created);
        if($user != null)
            return $user->username;
        else 
            return '';
    }
    
    /**
     * show is_default
     */
    public function getIsDefault(){
        if($this->is_default == 1)
            return 'YES';
        else
            return 'NO';
    }
    
    /**
     * get list template
     */
    public function getList(){
        $list = $this::find()->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }
}
