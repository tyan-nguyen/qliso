<?php
namespace app\components;

use kartik\grid\ActionColumn;
use yii\helpers\ArrayHelper;
use kartik\base\Lib;

class ActionColumnCustom extends ActionColumn {
    /**
     * Renders button label
     *
     * @param  array  $options  HTML attributes for the action button element
     * @param  string  $title  the action button title
     * @param  array  $iconOptions  HTML attributes for the icon element (see [[renderIcon]])
     *
     * @return string
     */
    protected function renderLabel(&$options, $title, $iconOptions = [])
    {
        $label = ArrayHelper::remove($options, 'label');
        if (is_null($label)) {
            $icon = $this->renderIcon($options, $iconOptions);
            if (Lib::strlen($icon) > 0) {
                $label = $icon.' '.$title;
            } else {
                $label = $title;
            }
        }
        
        return $label;
    }
}