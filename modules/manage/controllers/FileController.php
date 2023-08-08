<?php

namespace app\modules\manage\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use app\modules\manage\models\Working;
use app\modules\manage\models\File;
use PhpOffice\PhpWord\TemplateProcessor;
use app\modules\manage\models\Template;
use app\modules\manage\models\WorkingFiles;
use app\modules\manage\models\TeamMember;
use yii\web\Session;
use app\models\Custom;
/**
 * Default controller for the `manage` module
 */
class FileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionCreate($idWorking)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $content = '';        
        $working = Working::findOne($idWorking);
        $custom= new Custom();
        
        if($working == null){
            $content = 'Không tìm thấy thông tin cuộc họp!';
        }else{
            $file = new File();
            $file->idWorking = $idWorking;
            if($file->createWorkingFolder()){
                //$content = 'Tạo folder thành công!';
                //create file from template
                $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . Template::FOLDER_TEMPALTE 
                    . $working->templateGroup->file_name);
                
                
                $templateProcessor->setValue('tenkykiemtra', mb_strtoupper($working->workingExamination->name, 'UTF-8'));
                $templateProcessor->setValue('ngay', $custom->convertYMDtoD($working->date_exam));
                $templateProcessor->setValue('thang', $custom->convertYMDtoM($working->date_exam));
                $templateProcessor->setValue('nam', $custom->convertYMDtoY($working->date_exam));
                $templateProcessor->setValue('phongban', $working->workingRoom->room_name);
                $templateProcessor->setValue('phongbaninhoa', mb_strtoupper($working->workingRoom->room_name, 'UTF-8'));
                
                $truongDoan = TeamMember::find()->where([
                    'id_working'=>$idWorking,
                    'id_position'=>1 //1 in database is trưởng đoàn
                ])->one();
                
                $doanDanhGiaQuery = TeamMember::find()->where([
                    'id_working'=>$idWorking
                ]);
                $doanDanhGiaCount = $doanDanhGiaQuery->count();
                $doanDanhGia = $doanDanhGiaQuery->all();
                
                $templateProcessor->setValue('truongdoan', $truongDoan!=null ? $truongDoan->memberUser->info->name : '');
                $templateProcessor->cloneRow('item', $doanDanhGiaCount);
                foreach ($doanDanhGia as $indexDDG=>$member){
                    $templateProcessor->setValue('item#'. ($indexDDG+1), ($indexDDG+1) . '. ' . $member->memberUser->info->name 
                        . ' - ' . $member->memberPosition->name);
                }
                
                $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/results/'. $working->code . '/' . $working->templateGroup->file_name);
                //luu vao WorkingFiles
               $wFiles = WorkingFiles::find()->where([
                                'id_working' => $idWorking
                            ])->andWhere('id_user IS NULL')->one();
                if($wFiles == null){
                    $wFiles = new WorkingFiles();
                    $wFiles->id_working = $idWorking;
                    $wFiles->id_user = null;
                    $wFiles->file_name = $working->templateGroup->file_name;
                    $wFiles->file_type = WorkingFiles::TYPE_BB;
                    $wFiles->file_url = null;
                    $wFiles->shared_with = null;
                    $wFiles->summary = null;
                    if($wFiles->save())
                        $content .= '- File được tạo thành công! ';
                    else 
                        $content .= '- File không được tạo';
                } else {
                    //$content .= 'File đã có!';
                }
                
                /**
                 * duyet teamember, tao file và luu vào working files
                 */
                
                $team = TeamMember::find()->where([
                    'id_working' => $idWorking
                ])->all();
                foreach ($team as $indexTeam => $member){
                    
                    //create file from template
                    $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . Template::FOLDER_TEMPALTE
                        . $working->templateSingle->file_name);
                    
                    $templateProcessor->setValue('ngay', $custom->convertYMDtoD($working->date_exam));
                    $templateProcessor->setValue('thang', $custom->convertYMDtoM($working->date_exam));
                    $templateProcessor->setValue('nam', $custom->convertYMDtoY($working->date_exam));
                    $templateProcessor->setValue('phongban', $working->workingRoom->room_name);
                    $templateProcessor->setValue('thanhvien', $member->memberUser->info->name);
                    
                    for($i=1; $i<=3; $i++){
                        $templateProcessor->setValue('item#'. $i, $i . '-abc');
                    }
                    $filename =  $member->id_user . '_' . $working->templateSingle->file_name;
                    $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/results/'. $working->code . '/' . $filename);
                    
                    
                    $wFiles = WorkingFiles::find()->where([
                        'id_working' => $idWorking,
                        'id_user'=>$member->id_user
                    ])->one();
                    if($wFiles == null){
                        $wFiles = new WorkingFiles();
                        $wFiles->id_working = $idWorking;
                        $wFiles->id_user = $member->id_user;
                        $wFiles->file_name = $filename;
                        $wFiles->file_type = WorkingFiles::TYPE_CN;
                        $wFiles->file_url = null;
                        $wFiles->shared_with = null;
                        $wFiles->summary = null;
                        if($wFiles->save())
                            $content .= '-File được tạo thành công!';
                            else
                                $content .= '-File không được tạo';
                    } else {
                        //$content .= 'File đã có!';
                    }
                }
                
            }else
                $content = 'Tạo folder thất bại!';
        }
        
        return [
            'forceReload'=>'#crud-datatable1-pjax',
            'title'=> "Tạo file biểu mẫu tự động",
            'content'=>$content != null ? $content : 'Biểu mẫu đã tồn tại, để tạo lại vui lòng xóa các biểu mẫu!',
            'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
        ];  
    }
    
    /**
     * upload to drive
     * first get file and set id file to session
     * process to redirect to drive controller and process
     */
    public function actionUploadDrive($id){
        $session = Yii::$app->session;
        $session->set('fileid', $id);
        return $this->redirect(Yii::getAlias('@web/manage/drive/upload'));
    }
    
    /**
     * view file drive
     * first get file and set id file to session
     * process to redirect to drive controller and process
     */
    public function actionViewDrive($id){
       $fileWorking = WorkingFiles::findOne($id);
       if($fileWorking == null || $fileWorking->file_url == null){
           echo 'file not found';
       } else {
           return $this->redirect(File::DRIVE_PATH . $fileWorking->file_url);
       }
        
    }
    
    /**
     * download file from hosting
     * first get file and set id file to session
     * process to redirect to drive controller and process
     */
    public function actionDownload($id){
        $fileWorking = WorkingFiles::findOne($id);
        if($fileWorking == null || $fileWorking->file_name == null){
            echo 'file not found';
        } else {
            $fPath = Yii::getAlias('@webroot/results/') . $fileWorking->working->code . '/' . $fileWorking->file_name;
            Yii::$app->response->sendFile($fPath, $fileWorking->file_name);
        }
        
    }
    
}
