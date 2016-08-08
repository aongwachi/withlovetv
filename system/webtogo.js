//-------------------------------------------
function System_HideAlert() {
//-------------------------------------------
	$('#System_FloatAlert').hide('fast');
}
//-------------------------------------------
function System_Notice(mytext,mystatus) {
//-------------------------------------------
	$('#System_Notice').clearQueue();
	$('#System_Notice').dequeue();
	$('#System_NoticeBox').removeAttr('class').attr('class', '');
	if(mystatus=='') { $('#System_NoticeBox').addClass('system-notice-default'); }
	$('#System_NoticeBox').addClass('system-notice-'+mystatus);
	$('#System_NoticeBox').html(mytext);
	$('#System_Notice').show('fast').delay(3000).fadeOut(300);
}
//-------------------------------------------
function System_ShowToast(mytext1,mytext2,mystatus) {
//-------------------------------------------
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }        
    var $toast = toastr[mystatus](mytext2,mytext1);
    //"preventDuplicates": true,
}
//-------------------------------------------
$(document).ready(function() {

});
//-------------------------------------------
