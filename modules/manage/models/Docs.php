<?php

namespace app\modules\manage\models;

use Yii;
use app\models\User;
use app\models\Custom;
use app\modules\admin\models\Room;

/**
 * This is the model class for table "bm_docs".
 *
 * @property int $id
 * @property int $id_type
 * @property int $id_group
 * @property string|null $code
 * @property string|null $doc_name
 * @property string|null $doc_ext
 * @property string|null $doc_url
 * @property string|null $summary
 * @property int|null $user_created
 * @property string|null $date_created
 * @property string|null $doc_no
 * @property string|null $doc_summary
 * @property string|null $doc_date
 * @property string|null $doc_sign
 * @property int|null $doc_year
 * @property int|null $id_room
 * @property int|null $id_dm
 * 
 * @property BmDocgroup $group
 * @property BmDoctype $type
 */
class Docs extends \app\models\BmDocs
{
    CONST FOLDER_DOCUMENT = '/docs/';
    public $file;
    public $idRoomParent;
    public $startYear = 2019;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type'], 'required'],
            [['id_type', 'id_group', 'user_created', 'doc_year', 'id_room', 'id_dm'], 'integer'],
            [['summary', 'doc_summary'], 'string'],
            [['date_created', 'doc_date'], 'safe'],
            [['code', 'doc_name', 'doc_url'], 'string', 'max' => 200],
            [['doc_ext'], 'string', 'max' => 20],
            [['doc_no'], 'string', 'max' => 40],
            [['doc_sign'], 'string', 'max' => 100],
            [['id_group'], 'exist', 'skipOnError' => true, 'targetClass' => DocGroup::class, 'targetAttribute' => ['id_group' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => DocType::class, 'targetAttribute' => ['id_type' => 'id']],
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
            'id_type' => 'Loại tài liệu',
            'id_group' => 'Nhóm tài liệu',
            'code' => 'Code',
            'doc_name' => 'Tên tài liệu',
            'doc_ext' => 'Định dạng tệp',
            'doc_url' => 'Đường dẫn',
            'summary' => 'Ghi chú',
            'user_created' => 'User Created',
            'date_created' => 'Date Created',
            'doc_no' => 'Số văn bản',
            'doc_summary' => 'Trích yếu',
            'doc_date' => 'Ngày ký',
            'doc_sign' => 'Người ký',
            'doc_year' => 'Năm',
            'id_room' => 'Đơn vị',
            'id_dm' => 'Danh mục',
            
            'idRoomParent'=>'Khoa'
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(DocGroup::class, ['id' => 'id_group']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DocType::class, ['id' => 'id_type']);
    }
    
    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'id_room']);
    }
    
    /**
     * Gets query for [[Dm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDm()
    {
        return $this->hasOne(Dm::class, ['id' => 'id_dm']);
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
            
            if($this->doc_date != null){
                $custom = new Custom();
                $this->doc_date = $custom->convertDMYtoYMD($this->doc_date);
            }
        }
        return true;
    }
    
    /**
     * before delete, xoa tat ca cac file lien quan
     */
    public function beforeDelete()
    {
        if($this->doc_name != ''){
            $filePath = Yii::getAlias('@webroot') . $this::FOLDER_DOCUMENT . $this->id . '.' . $this->doc_ext;
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
     * get date_created d/m/y
     */
    public function getDateCreated(){
        $custom = new Custom();
        return $custom->convertYMDHIStoDMYHIS($this->date_created);
    }
    
    /**
     * get doc_date d/m/y
     */
    public function getDocDate(){
        $custom = new Custom();
        return $custom->convertYMDHIStoDMY($this->doc_date);
    }
    
    /**
     * get file type ext
     */
    public function getFileExtIcon(){
        $custom = new Custom();
        return $custom->showIconExt($this->doc_ext);
    }
    
    public function getAvailableYear(){
        $years = array();
        $currentYear = date('Y');
        for($year = $currentYear ; $year>=$this->startYear; $year--){
            $years[$year] = $year ;
        }
        return $years;
    }
    
    
}
