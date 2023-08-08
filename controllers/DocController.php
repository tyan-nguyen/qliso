<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use PhpOffice\PhpWord\TemplateProcessor;
use app\modules\manage\models\Template;


class DocController extends Controller {
    
    public function actionTest(){
        $templateProcessor = new TemplateProcessor(Yii::getAlias('@webroot') . Template::FOLDER_TEMPALTE . '73722a8f111fcf0cdc296977c5483430.docx');        
        $templateProcessor->setValue('invoice_no', 'aaaaaaaaaaa');
        $templateProcessor->cloneRow('item', 3);
        for($i=1; $i<=3; $i++){
            $templateProcessor->setValue('item#'. $i, $i . '-abc');
        }
        $templateProcessor->saveAs(Yii::getAlias('@webroot') . '/results/Sample_08_TemplateCloneRow.docx');
       // Yii::$app->response->sendFile('results/Sample_08_TemplateCloneRow.docx', 'thua_bien_dong.docx');    
    }
    
    
}