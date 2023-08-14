<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use johnitvn\ajaxcrud\BulkButtonWidget;

class BulkButtomCustom extends BulkButtonWidget{
    
    public function run(){
        $content = '<div class="pull-left">'.
            $this->buttons.
            '</div>';
            return $content;
    }
}
?>
