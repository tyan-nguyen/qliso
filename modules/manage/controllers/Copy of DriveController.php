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

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;

use yii\web\Session;

/**
 * Default controller for the `manage` module
 */
class DriveController extends Controller
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
     * reset authorizone google
     */
    public function actionResetGoogle(){
        $session = Yii::$app->session;
        if($session->get('code') != null)
            $session->remove('code');
        if($session->get('access_token') != null)
            $session->remove('access_token');
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionUpload()
    {
       

        $client = new Client();
        /* Get your credentials from the console */
        $client->setClientId('334834496758-cht6o914su0fuv0v4o3q99kncu81kskd.apps.googleusercontent.com');
        $client->setClientSecret('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');
        $client->setRedirectUri('http://localhost/qlbm/manage/drive/upload');
        $client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
        
        session_start();
        
        if (isset($_GET['code']) || (isset($_SESSION['access_token']) && $_SESSION['access_token'])) {
            if (isset($_GET['code'])) {
                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
            } else
                $client->setAccessToken($_SESSION['access_token']);
            
                
                $session = Yii::$app->session;
                echo $session->get('fileid');
                $fileModel = WorkingFiles::findOne($session->get('fileid'));
                $fName = $fileModel->file_name;
                $fPath = Yii::getAlias('@webroot/results/') . $fileModel->working->code . '/' . $fName;
                echo '<br/>' . $fName;
                echo '<br/>' . $fPath;
                echo '<br/>' . $fileModel->user->email;
                /* if($fileModel->id_user == null){
                    foreach ($fileModel->working->workingMembers as $indexMember=>$member){
                        echo '<br/>'. $member->memberUser->email;
                    }
                } */
                
                $service = new Drive($client);
                $file = new DriveFile();
                //$file->setName(uniqid().'.jpg');
                $file->setName($fName);
                $file->setDescription('A test document');
                $file->setMimeType('application/msword');
                $file->setParents(['1q6L-6dAsngIU6BGmsIHT36mW5S21f37F']);
                
                $data = file_get_contents($fPath);
                
                $createdFile = $service->files->create($file, array(
                    'data' => $data,
                    'mimeType' => 'application/msword',
                    'uploadType' => 'multipart'
                ));
                
                print_r($createdFile);
                echo '<br/>';
                echo '------' . $createdFile["id"];
                
                //set permission
                $fileId = $createdFile["id"];
                $service->getClient()->setUseBatch(true);
                $batch = $service->createBatch();
                
                if($fileModel->id_user!=null){                
                    $userPermission = new Drive\Permission(array(
                        'type' => 'user',
                        'role' => 'writer',
                        'emailAddress' => $fileModel->user->email
                    ));
                    //$userPermission['emailAddress'] = $realUser;
                    $request = $service->permissions->create(
                        $fileId, $userPermission, array('fields' => 'id'));
                    $batch->add($request, 'user');
                    $results = $batch->execute();
                    
                    foreach ($fileModel->working->workingMembers as $indexMember=>$member){
                        if ($member->memberUser->email != null && $member->memberUser->email != $fileModel->user->email){
                            
                            echo '<br/>'. $member->memberUser->email;
                            
                            $userPermission = new Drive\Permission(array(
                                'type' => 'user',
                                'role' => 'reader',
                                'emailAddress' => $member->memberUser->email
                            ));
                            //$userPermission['emailAddress'] = $realUser;
                            $request = $service->permissions->create(
                                $fileId, $userPermission, array('fields' => 'id'));
                            $batch->add($request, 'user');
                            $results = $batch->execute();
                        }
                    }
                    
                } else {
                    //get all user of team
                    foreach ($fileModel->working->workingMembers as $indexMember=>$member){
                        if ($member->memberUser->email != null){
                            $userPermission = new Drive\Permission(array(
                                'type' => 'user',
                                'role' => 'writer',
                                'emailAddress' => $member->memberUser->email
                            ));
                            //$userPermission['emailAddress'] = $realUser;
                            $request = $service->permissions->create(
                                $fileId, $userPermission, array('fields' => 'id'));
                            $batch->add($request, 'user');
                            $results = $batch->execute();
                        }
                    }
                    
                }
                
                //save file id to model
                $fileModel->file_url = $createdFile["id"];
                if($fileModel->save()){
                    echo '<br/>'. 'file save!!!!!!!!!!!!!!';
                    return $this->redirect(Yii::getAlias('@web') . '/manage/working/update?id=' . $fileModel->id_working);
                    //$linkRedirect = Yii::getAlias('@web') . '/manage/working/update?id=' . $fileModel->id_working;
                    //header('Location: ' . $linkRedirect);
                    //exit();
                }
                
                
               /*  $userPermission = new Drive\Permission(array(
                    'type' => 'user',
                    'role' => 'writer',
                    'emailAddress' => 'travinhfashion@gmail.com'
                ));
                //$userPermission['emailAddress'] = $realUser;
                $request = $service->permissions->create(
                    $fileId, $userPermission, array('fields' => 'id'));
                $batch->add($request, 'user');
                $results = $batch->execute(); */
                
                /* $userPermission2 = new Drive\Permission(array(
                    'type' => 'user',
                    'role' => 'reader',
                    'emailAddress' => 'khucthuydu.2801@gmail.com'
                ));
                //$userPermission['emailAddress'] = $realUser;
                $request2 = $service->permissions->create(
                    $fileId, $userPermission2, array('fields' => 'id'));
                $batch->add($request2, 'user');
                
                $results = $batch->execute();
                 */
                
        } else {
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);
            exit();
        }
        
    }

}