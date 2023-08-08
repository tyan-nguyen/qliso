<?php
/**
 * @author : Anyu @date: 27/02/2021
 * widget NumberSpinnerWidget
 * hiển thị thanh tăng giảm cho number
 */
namespace app\components\NumberSpinner;

use yii\base\Widget;

class NumberSpinnerWidget extends Widget
{
	public $id; //required to prenvent conflict #id
    public $model;
    public $attribute;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('number-spinner', [
        		'id' => $this->id,
        		'model' => $this->model,
        		'attribute' => $this->attribute
        ]);
    }
}