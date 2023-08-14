<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\admin\models\ContactStudent;
use app\modules\surveysv\models\SurveyCourse;
use app\modules\manage\models\Examination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        	'ghost-access'=> [
        			'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
        	],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {   	
    	//examination
    	/* $examinations = Examination::find()->orderBy(['id'=>SORT_DESC])->limit(6)->all();
    	
    	return $this->render('index', [
    	    'examinations' => $examinations
    	]); */
        //$this->redirect(Yii::getAlias('@web/admin/thong-ke-truy-cap'));
        return $this->render('index2', []);
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
   /*  public function actionIndex()
    {
        //contact
        $contactStudent = ContactStudent::find()->orderBy(['status'=>SORT_ASC, 'id'=>SORT_DESC])->limit(5)->all();
        
        //survey course
        $surveyCourses = SurveyCourse::find()->orderBy(['id'=>SORT_DESC])->limit(3)->all();
        
        return $this->render('index', [
            'contactStudent' => $contactStudent,
            'surveyCourses' => $surveyCourses
        ]);
    } */
    
    /**
     * Displays error page.
     *
     * @return string
     */
    public function actionShowError($type)
    {
    	$message = '';
    	switch ($type) {
    		case 'notFound':
    			$message = 'Trang bạn yêu cầu không tìm thấy!';
    			break;
    		case 'fileNotFound':
    			$message = 'File bạn yêu cầu không tìm thấy!';
    			break;
    		default:
    			$message = 'Có lỗi xảy ra!';
    	}
    	return $this->render('show-error', ['message' => $message]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionTest(){
    	$inputFile = 'file.xlsx';
    	try{
    		$inputFileType = \PHPExcel_IOFactory::identify($inputFile);
    		$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
    		$objPHPExcel = $objReader->load($inputFile);
    	} catch (Exception $e) {
    		die('Error');
    	}
    	
    	$sheet = $objPHPExcel->getSheet(0);
    	$highestRow = $sheet->getHighestRow();
    	$highestColumn = $sheet->getHighestColumn();
    	
    	for($row=0; $row <= $highestRow; $row++)
    	{
    		$rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
    		
    		/* if($row==1)
    		{
    			continue;
    		} */
    		
    		echo $rowData[0][0];
    		echo $rowData[0][1];
    		
    		/* $siswa = new Siswa();
    		$siswa->nis = $rowData[0][0];
    		$siswa->nama_siswa  = $rowData[0][1];
    		$siswa->jenis_kelamin  = $rowData[0][2];
    		$siswa->ttl  = $rowData[0][3];
    		$siswa->alamat  = $rowData[0][4];
    		$siswa->telp  = $rowData[0][5];
    		$siswa->agama  = $rowData[0][6];
    		$siswa->nama_ortu  = $rowData[0][7];
    		$siswa->telp_ortu  = $rowData[0][8];
    		$siswa->pekerjaan_ortu = $rowData[0][9];
    		$siswa->tahun_masuk = $rowData[0][10];
    		$siswa->kelas = $rowData[0][11];
    		$siswa->save(); */
    		
    		
    		
    		
    		//print_r($siswa->getErrors());
    	}
    	die('okay');
    }
}
