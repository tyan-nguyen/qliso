<?php

namespace app\modules\manage\models;

use Yii;
use app\models\Custom;
use webvimark\modules\UserManagement\models\User;
use app\modules\admin\models\Room;

/**
 * This is the model class for table "bm_working".
 *
 * @property int $id
 * @property string|null $code
 * @property int $id_examination
 * @property int $id_room
 * @property string|null $date_exam
 * @property string|null $date_created
 * @property int|null $user_created
 * @property string|null $summary
 * @property int|null $id_template_group
 * @property int|null $id_template_single
 */
class Working extends \app\models\BmWorking
{
    public $idRoomParent;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_examination', 'id_room'], 'required'],
            [['id_examination', 'id_room', 'user_created', 'id_template_group', 'id_template_single'], 'integer'],
            [['date_exam', 'date_created'], 'safe'],
            [['summary'], 'string'],
            [['code'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Mã cuộc họp',
            'id_examination' => 'Kỳ đánh giá',
            'id_room' => 'Đơn vị',
            'date_exam' => 'Thời gian đánh giá',
            'date_created' => 'Ngày tạo',
            'user_created' => 'Người tạo',
            'summary' => 'Ghi chú',
            'id_template_group' => 'Mẫu biên bản',
            'id_template_single' => 'Mẫu phiếu đánh giá',
        ];
    }
    
    /**
     * Gets query for [[Examination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingExamination()
    {
        return $this->hasOne(Examination::className(), ['id' => 'id_examination']);
    }
    
    /**
     * Gets query for [[TeamMember]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingMembers()
    {
        return $this->hasMany(TeamMember::className(), ['id_working' => 'id']);
    }
    
    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkingRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'id_room']);
    }
    
    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateGroup()
    {
        return $this->hasOne(Template::className(), ['id' => 'id_template_group']);
    }
    
    /**
     * Gets query for [[Template]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateSingle()
    {
        return $this->hasOne(Template::className(), ['id' => 'id_template_single']);
    }
    
    /**
     * before save
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if($this->isNewRecord){
                $this->user_created = Yii::$app->user->id;
                $this->date_created = date('Y-m-d H:i:s');
            }
            
            if($this->date_exam != null){
                $custom = new Custom();
                $this->date_exam = $custom->convertDMYtoYMD($this->date_exam);
            }
        }
        return true;
    }
    
    /**
     * get date_exam d/m/y
     */
    public function getDateExam(){
        $custom = new Custom();
        return $custom->convertYMDtoDMY($this->date_exam);
    }
    
    /**
     * get date_created d/m/y
     */
    public function getDateCreated(){
        $custom = new Custom();
        return $custom->convertYMDHIStoDMYHIS($this->date_created);
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
     * show working name
     */
    public function getWorkingName(){
        return $this->workingExamination->name . ' tại đơn vị ' . $this->workingRoom->room_name;
    }
    
    /**
     * show working name in html
     */
    public function getWorkingNameHtml(){
        return '<strong>' . $this->workingExamination->name . '</strong> tại đơn vị <strong>' . $this->workingRoom->room_name . '</strong>';
    }
    
    public function getMemberListHtml(){
        $html = '';
        foreach($this->workingMembers as $mem){
            $html .= '<span class="label label-primary">'. $mem->memberUser->info->name .'</span>&nbsp;';
        }
        return $html;
    }
}
