$(function(){
	
//	切换地址
	$('.content-address .consignee-item .radio').click(function(){
		$(this).parent().find('.radio-img').addClass('pitchOn');
		$(this).parent().siblings('.consignee-item').find('.radio-img').removeClass('pitchOn');
		//将当前选中的地址修改寄送至地址
        $('.mailTo').find('.m-city').text($(this).find('.city').html());
        $('.mailTo').find('.m-particular').text($(this).find('.city-particular').text());
        $('.mailTo').find('.m-name').text('寄送至:'+$(this).find('.e-name').text());
        $('.mailTo').find('.m-number').text('(收件人)'+$(this).find('.codeNumber').text());

	});
	
	$('.invoice .radio').click(function(){
		$(this).parent().find('.radio-img').addClass('pitchOn');
		$(this).parent().siblings('.consignee-item').find('.radio-img').removeClass('pitchOn');
			if($(this).hasClass('yes')){
					$('.con').show();			
				}else{
					$('.con').hide();
				}
	
	
	})
	
	
	
	$('.tongyong').click(function(){
		$(this).addClass('active');
		$(this).siblings().removeClass('active');
		if($(this).hasClass('danwei')){
			$('.danweiname').show();			
		}else{
			$('.danweiname').hide();
		}
	})
	
	
	
	
})
