$('input[type="checkbox"]').on('change', function(){
		if(this.checked){
			$('div[data-depend="'+ $(this).attr('data-id') +'"]').show();
		}else{
			$('div[data-depend="'+ $(this).attr('data-id') +'"] input[type="text"],div[data-depend="'+ $(this).attr('data-id') +'"] textarea').val('');
			$('div[data-depend="'+ $(this).attr('data-id') +'"] input[type="radio"],div[data-depend="'+ $(this).attr('data-id') +'"] input[type="checkbox"]').prop("checked",false);
			$('div[data-depend="'+ $(this).attr('data-id') +'"]').hide();
		}
});

$('input[type="radio"]').on('change', function(){
		if(this.checked){
			$('div[data-depend="'+ $(this).attr('data-id') +'"] input[type="text"],div[data-depend="'+ $(this).attr('data-id') +'"] textarea').val('');
			$('div[data-depend="'+ $(this).attr('data-id') +'"] input[type="radio"],div[data-depend="'+ $(this).attr('data-id') +'"] input[type="checkbox"]').prop("checked",false);
			$('div[data-depend="'+ $(this).attr('data-id') +'"]').hide();
			$('div[data-depend="'+ $(this).attr('data-id') +'"][data-value="'+ $(this).attr('value') +'"]').show();
		}/* else{
			$('div[data-depend="'+ $(this).attr('data-id') +'"]').hide();
		} */
});

$('input[type="checkbox"]').each(function() {
	if(this.checked)
		$('div[data-depend="'+ $(this).attr('data-id') +'"]').show();
});

$('input[type="radio"]').each(function() {
	if(this.checked)
		$('div[data-depend="'+ $(this).attr('data-id') +'"][data-value="'+ $(this).attr('value') +'"]').show();
});

