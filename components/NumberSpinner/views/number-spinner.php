<?php
use yii\helpers\Html;

/**
 * view for NumberSpinner widget
 * @author : Anyu @date: 27/02/2021
 * important: include jquery before call this
 */
?>
<label><?= $model->getAttributeLabel($attribute) ?></label>

<div class="input-group number-spinner">
	<span class="input-group-btn">
		<span class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></span>
	</span>
	
	<?= Html::activeTextInput($model, $attribute, ['class' => 'form-control text-center', 
			'value'=>($model->$attribute==null?1:$model->$attribute)]) ?>
	
	<span class="input-group-btn">
		<span class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></span>
	</span>
</div>

<script>
	$(document).on('click', '.number-spinner .btn', function () {    
		var btn = $(this);
			oldValue = btn.closest('.number-spinner').find('input').val().trim();
			newVal = 0;
		
		if (btn.attr('data-dir') == 'up') {
			newVal = parseInt(oldValue) + 1;
		} else {
			if (oldValue > 1) {
				newVal = parseInt(oldValue) - 1;
			} else {
				newVal = 1;
			}
		}
		btn.closest('.number-spinner').find('input').val(newVal);
	});
</script>
