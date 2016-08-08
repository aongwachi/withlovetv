<?php if(0) { ?><$FooTableNamemeta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<!--------------------------------------------------------------------------------------------->
<link href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/footable/footable.core.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/footable/footable.metro.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/footable/footable.js" type="text/javascript"></script>
<!--------------------------------------------------------------------------------------------->
<script type="text/javascript">
var recordstart=0;
var totalrecord=0;
var recordsize=<?php echo $FooTablePageSize; ?>;
var ajaxFilename='<?php echo $FooTableAjaxFile; ?>';
var ajaxFooTableID='<?php echo $FooTableName; ?>';
var orderby='<?php echo $FooTableOrderBy; ?>';
var ascdesc='<?php echo $FooTableASCDESC; ?>';
var FooTableColumn = '<?php echo $FooTableColumn; ?>';
var FooTableAjaxInAction = false;
var FooTableHandleIClick = false;
//----------------------------------------
// Page OnLoad
//----------------------------------------
$(document).ready(function() {
		$('#'+ajaxFooTableID).footable();
		FooTableLoadAjaxData(); // first time auto load
		$('.footable-head a').on('click', function(event) { FooTableSorting(event.target); });
		$('.footable-head i').on('click', function(event) { FooTableSortings(event.target); });
});
//----------------------------------------
function FooTableLoadAjaxData() {
//----------------------------------------
	if(FooTableAjaxInAction) return false;
	FooTableAjaxInAction=true;
	$('#doaction').val('result');
	var datalist=$('#'+ajaxFooTableID+'Form').serialize();
	//console.log(datalist);
	$.ajax({
		url : ajaxFilename,
		contentType: "text/html",
		data: datalist,
		success : function(returndata) {
			$('#'+ajaxFooTableID+' tbody').append(returndata);
			//console.log(returndata)
			$('#'+ajaxFooTableID).trigger('footable_initialize');
			recordstart=recordstart+recordsize;
			$('#recordstart').val(recordstart);
			FooTableLoadAjaxDataTotalRecord();
		},
		error : function(xhr, statusText, error) { 
			System_Notice("Error! Could not retrieve the data.",'danger');
		}
	});
}
//----------------------------------------
function FooTableLoadAjaxDataTotalRecord() {
//----------------------------------------
	$('#doaction').val('count');
	var datalist=$('#'+ajaxFooTableID+'Form').serialize();
	$.ajax({
		url : ajaxFilename,
		contentType: "text/html",
		data: datalist,
		success : function(returndata) {
			totalrecord=parseInt(returndata);
			$('#idFooTableTotalRecord').html(FooTable_AddCommaNumber(totalrecord));
			FooTableDisplayControl();
			FooTableAjaxInAction=false;
		},
		error : function(xhr, statusText, error) { 
			System_Notice("Error! Could not retrieve the data.",'danger');
		}
	});
}
//----------------------------------------
function FooTableLoadAjaxReloadData() {
//----------------------------------------
		if (FooTableAjaxInAction) return false;
		recordstart=0;
		$('#recordstart').val(recordstart);
		$('#'+ajaxFooTableID+' tbody > tr').remove();
		FooTableLoadAjaxData();
}
//----------------------------------------
function FooTableSortings(myobj) {
//----------------------------------------
	FooTableHandleIClick=true;
}
//----------------------------------------
function FooTableSorting(myobj) {
//----------------------------------------
	if(FooTableHandleIClick) {
		FooTableHandleIClick=false;
		return false;
		// skip
	}
	myfiled=$(myobj).attr('data-sort');
	if(myfiled==orderby) {
		if(ascdesc=='ASC') {
				ascdesc='DESC';
				$('#ascdesc').val('DESC');
				$(myobj).find('i').removeAttr('class').attr('class', '');
				$(myobj).find('i').addClass('glyphicon glyphicon-chevron-up font-10 padding-4');
		} else {
				ascdesc='ASC';
				$('#ascdesc').val('ASC');
				$(myobj).find('i').removeAttr('class').attr('class', '');
				$(myobj).find('i').addClass('glyphicon glyphicon-chevron-down font-10 padding-4');
		}
	} else {
		orderby=myfiled;
		$('#orderby').val(myfiled);
		// Set all link to normal
		$('.footable-head a').each( function () {
			$(this).removeAttr('class').attr('class', '');
			$(this).addClass('Link_FooTable');
			$(this).find('i').removeAttr('class').attr('class', '');
		});
		// Set clicked link to active
		$(myobj).removeAttr('class').attr('class', '');
		$(myobj).addClass('Link_FooTableActive');
		if(ascdesc=='ASC') {
			$(myobj).find('i').addClass('glyphicon glyphicon-chevron-down font-10 padding-4');
		} else {
			$(myobj).find('i').addClass('glyphicon glyphicon-chevron-up font-10 padding-4');
		}		
	}
	// Clear all old data and load new
	recordstart=0;
	$('#recordstart').val(recordstart);
	$('#'+ajaxFooTableID+' tbody > tr').remove();
	FooTableLoadAjaxData();
}
//----------------------------------------
function FooTableDisplayControl() {
//----------------------------------------
	if(totalrecord==0) { 
		recordstart=0;
		$('#recordstart').val(recordstart);
		$('#'+ajaxFooTableID+'DataNotFound').show();	
		$('#'+ajaxFooTableID).hide();
		$('#'+ajaxFooTableID+'Loading').hide();
		$('#'+ajaxFooTableID+'Ending').hide();
	} else { 
		$('#'+ajaxFooTableID+'DataNotFound').hide();	
		$('#'+ajaxFooTableID).show();
		if(recordstart>=totalrecord) { 
			$('#'+ajaxFooTableID+'Ending').show();
			$('#'+ajaxFooTableID+'Loading').hide();
		} else {
			$('#'+ajaxFooTableID+'Ending').hide();
			$('#'+ajaxFooTableID+'Loading').show();
		}
	}
}
//--Auto Load when scroll end -------------------------------
$(document).ready(function() {
		$(window).scroll(function() {
				var reactFromBottom = -50;
				var diff=parseInt($('body').scrollTop()+$(window).height())-parseInt($(document).innerHeight());
				if (diff>=reactFromBottom && recordstart<totalrecord && totalrecord>0) {
					FooTableLoadAjaxData();
				}
		});
});
//--------------------------------------------------------------------
function FooTable_AddCommaNumber(val){
//--------------------------------------------------------------------
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}
</script>