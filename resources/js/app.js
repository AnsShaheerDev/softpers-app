require('./bootstrap');

require('alpinejs');

$(function(){
	$('#app-file-ele').on('change',function(){
		$("#app-page-loader").removeClass('hidden');
		$(this).closest('form').addClass('hidden');
		$(this).closest('form').submit();
	})
});
