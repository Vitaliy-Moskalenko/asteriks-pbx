jQuery('document').ready(function() {

	$('.start-date').datetimepicker({
		format:'Y-m-d H:i:s',
		defaultTime:'00:00',
		lang:'ru',
	});
	
	$('.end-date').datetimepicker({
		format:'Y-m-d H:i:s',
		defaultTime:'23:59',
		lang:'ru',
	});
	
	
	$('.reveal-form').submit(function() {
		
		d1 = new Date($(this).find('.start-date').val());
		d2 = new Date($(this).find('.end-date').val());
		
		if (d1 > d2) {
			alert('Дата окончания раньше чем дата начала!');
			return false;
		}

		return true;
	
	});	
	
	jQuery('.btn-primary').click(function(){
		
		var id = jQuery(this).attr('id').substr(-1);		
		jQuery('input[name=form-id]').val(id);
		
		if(id <= 3)
			jQuery('.reveal').fadeIn('slow');
		else if(id == 4) 
			jQuery('.reveal2').fadeIn('slow');
		else 
			jQuery('.reveal3').fadeIn('slow');
	});
	
	jQuery('.close, .btn-close').click(function(){
		jQuery('.reveal, .reveal2, .reveal3').fadeOut('slow');
	});
	
	
});