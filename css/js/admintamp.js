// validasi form
$('#nama').focusin(function() 
	{
	$('#nama-span').html('Masukan username anda');
});

$('#nama').focusout(function()
	{
		$('#nama-span').html('');
});


$('#pass').focusin(function() 
	{
	$('#pass-span').html('Masukan password anda dengan benar');
});

$('#pass').focusout(function()
	{
		$('#pass-span').html('');
});



$('#login') .click(function() 
	{
		$(this) .attr('value', 'proses...' );
		$(this) .attr('disabled', true);

});


//slide down login form

$(document).ready(function()
	{
	$('.slide-login').slideDown(1000);
	
});

	
//validasi form login/register jika kosong.
/*
<script type="text/javascript">
	function check_info(){
		var username = document.getElementById('username').value;
		var password = document.getElementById('password').value;
		
	if(username=="" || password=="" ){
		alert('Masukan username atau password anda.');
			return false;
	}
	else {
		return true;
	}
		
	}

</script> */