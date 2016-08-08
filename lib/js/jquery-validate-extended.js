// Add new validate to config_dms.php at --> array $arDMSValidator //
$.validateExtend({
	Validate_IDCard : {
		conditional : function(myvalue) {
			if(myvalue.length==13 && Number(myvalue) > 0) { return true; } else { return false; } 
		},
		pattern : /^[0-9]+$/
	},
	Validate_Number : {
		pattern : /^[0-9]+$/
	},
	Validate_Date : {
		pattern : /^[0-9]{4}-[0-9]{2}-[0-9]{2}/
	},
	Validate_Time : {
		pattern : /^[0-9]{2}:[0-9]{2}/
	}
});
