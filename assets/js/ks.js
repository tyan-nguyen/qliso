// $(document).on("submit", "#frm", function(e) {
function checkForm() {
	  //e.preventDefault();  
	  var cerr = false;
	  $('.required[type="radio"]').each(function(index,item){
		//alert($(item).attr('name'));
		var radioValue = $("input[name='"+$(item).attr('name')+"']:checked").val();
		if(radioValue == null){
			cerr = true;
			if ($(this).parents('td').length) {
				$(item).parent().parent().addClass('check-error');
			} else {
				$(item).parent().addClass('check-error');
			}
			//return false;
		} else{
			if ($(this).parents('td').length) {
				$(item).parent().parent().removeClass('check-error');
			} else {
				$(item).parent().removeClass('check-error');
			}
		}
		
	});

	$('.required[type="checkbox"]').each(function(index,item){
			//alert($(item).attr('name'));
			/* var radioValue = $("input[name='"+$(item).attr('name')+"']:checked").val();
			if(radioValue == null){
				$cerr = true;
				$(item).parent().addClass('check-error');
				//return false;
			} else{
				$(item).parent().removeClass('check-error');
			} */

		var hasCk = 0;
	 	$(item).parent().children('.required[type="checkbox"]').each(function(index1,item1){
	 		var radioValue1 = $("input[name='"+$(item1).attr('name')+"']:checked").val();
			if(radioValue1 != null){
				hasCk++;
			}
		});
		//alert(hasCk + '');
		if(hasCk == 0){
			cerr = true;
			$(item).parent().addClass('check-error');
		}
		else {
			$(item).parent().removeClass('check-error');
		}
			
	});
		
	 $('.required[type="text"]').each(function(index,item){
		 	//alert($(item).val());
			//alert($(item).attr('name'));
			var radioValue = $(item).val();
			if(radioValue == ''){
				cerr = true;
				$(item).parent().addClass('check-error');
				//return false;
			} else{
				$(item).parent().removeClass('check-error');
			}
			
	});
	 $('textarea.required').each(function(index,item){
		 	//alert($(item).val());
			//alert($(item).attr('name'));
			var radioValue = $(item).val();
			if(radioValue == ''){
				cerr = true;
				$(item).parent().addClass('check-error');
				//return false;
			} else{
				$(item).parent().removeClass('check-error');
			}
			
	});	

		return cerr;
	
	}

	function showError(){
		var cerr = checkForm();
		if(cerr==true){
			$('#perr').html('<div class="alert alert-warning alert-dismissible">' +
	                '<h4><i class="icon fa fa-warning"></i> Phiếu không hợp lệ!</h4>' +
	                'Bạn vui lòng trả lời các câu còn thiếu (đánh dấu nền màu cam)!' +
	              '</div>');
			$('#btnCheck').show();
			$('#btnSend').hide();
		} else {
			$('#perr').html('<div class="alert alert-info alert-dismissible">' +
	                '<h4><i class="icon fa fa-check"></i> Phiếu hợp lệ!</h4>' +
	                'Phiếu hợp lệ. Bạn vui lòng bấm gửi để hệ thống ghi nhận phiếu khảo sát!' +
	              '</div>');
			$('#btnCheck').hide();
			$('#btnSend').show();
		}
	}

	function sendForm(){
		var cerr = checkForm();
		if(cerr==true){
			$('#perr').html('<div class="alert alert-warning alert-dismissible">' +
	                '<h4><i class="icon fa fa-warning"></i> Phiếu không hợp lệ!</h4>' +
	                'Bạn vui lòng trả lời các câu còn thiếu (đánh dấu nền màu cam)!' +
	              '</div>');
			$('#btnCheck').show();
			$('#btnSend').hide();
		} else{
			$('#btnSend').show();
			subm(document.getElementById("frm"));
		}
	}

	function subm(f) {
	    const submitFormFunction = Object.getPrototypeOf(f).submit;
	    submitFormFunction.call(f);
	}