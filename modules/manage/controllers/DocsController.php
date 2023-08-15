<?php

namespace app\modules\manage\controllers;

use Yii;
use app\modules\manage\models\Docs;
use app\modules\manage\models\DocsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;
use app\modules\manage\models\Dm;
use app\models\User;

/**
 * DocsController implements the CRUD actions for Docs model.
 */
class DocsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Docs models.
     * @return mixed
     */
    public function actionIndex($dm=NULL)
    {    
        $searchModel = new DocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $dm);
        
        if($dm!=null){
            $dmModel = Dm::findOne($dm);
            if($dmModel != null){
                Yii::$app->view->title = $dmModel->name;
            }
        } else {
            Yii::$app->view->title = 'Các đơn vị trực thuộc Hệ thống Quản lý chất lượng';
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dm'=>$dm
        ]);
    }

    /**
     * Displays a single Docs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            $addText = '';
            if($model->dm != null){
                $addText = ' thuộc ' . $model->dm->name;
            }
            
            return [
                    'title'=> "Tài liệu" . $addText,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * download to view template in local
     */
    public function actionDownload($id){
        $model = Docs::findOne($id);
        if($model != null){
            if($model->doc_url != null){
                return $this->redirect($model->doc_url);
            } else if($model->doc_name != null){
                $fPath = Yii::getAlias('@webroot') . Docs::FOLDER_DOCUMENT . $model->id . '.' . $model->doc_ext;
                Yii::$app->response->sendFile($fPath, $model->doc_name);
            }
        }
    }

    /**
     * Creates a new Docs model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($dm=NULL)
    {
        $request = Yii::$app->request;
        $model = new Docs();
        $model->id_dm = $dm;
        $addText = '';
        $dmModel = Dm::findOne($dm);
        if($dmModel != null){
            $addText = ' thuộc ' . $dmModel->name;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới tài liệu" . $addText,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) ){
                $model->code = md5(date('Y-m-d H:i:s'));
                $fileTemp = UploadedFile::getInstance($model, 'file');
                if(isset($fileTemp->extension) && $fileTemp->extension!=null){
                    $model->doc_name = $fileTemp->name;
                    $model->doc_ext = $fileTemp->extension;
                }
                
                if($model->save()){                    
                    //save file
                    if(isset($fileTemp->extension) && $fileTemp->extension!=null){
                        $fileTemp->saveAs( Yii::getAlias('@webroot') . Docs::FOLDER_DOCUMENT . $model->id . '.' . $model->doc_ext);
                    }
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Thêm mới tài liệu" . $addText,
                        'content'=>'<span class="text-success">Thêm mới tài liệu thành công!</span>',
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            
                    ];    
                } else {
                    return [
                        'title'=> "Thêm mới tài liệu" . $addText,
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
            }else{           
                return [
                    'title'=> "Thêm mới tài liệu" . $addText,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Docs model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);   
        $oldFilePath = Yii::getAlias('@webroot') . Docs::FOLDER_DOCUMENT .  $model->id . '.' . $model->doc_ext;
        
        $addText = '';
        if($model->dm != null){
            $addText = ' thuộc ' . $model->dm->name;
        }
        
        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật tài liệu" . $addText,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                $fileTemp = UploadedFile::getInstance($model, 'file');
                if(isset($fileTemp->extension) && $fileTemp->extension!=null){
                    $model->doc_name = $fileTemp->name;
                    $model->doc_ext = $fileTemp->extension;
                }
                if($model->save()){
                    
                    $newFilePath = Yii::getAlias('@webroot') . Docs::FOLDER_DOCUMENT . $model->id . '.' . $model->doc_ext;
                    if(file_exists($oldFilePath) && $oldFilePath != $newFilePath){
                        unlink($oldFilePath);
                    }
                    //save new file
                    if(isset($fileTemp->extension) && $fileTemp->extension!=null){
                        $fileTemp->saveAs($newFilePath);
                    }
                    
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Tài liệu" . $addText,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];    
                } else {
                    return [
                        'title'=> "Cập nhật tài liệu" . $addText,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    ];  
                }
            }else{
                 return [
                     'title'=> "Cập nhật tài liệu" . $addText,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Docs model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing Docs model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
       
    }

    /**
     * Finds the Docs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Docs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Docs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
