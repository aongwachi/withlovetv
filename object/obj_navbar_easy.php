<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<!--- Top Bar -------------->
<div class="Object_NavBarTop">
    <a href="javascript:void(0)" class="Object_NavBarRightLink" onclick="doToggleLeftBar();"><span class="navbar-brand cursor"></span></a>
    <span class="Object_NavBarTop_BigText"><?php echo $SYSTEM_SITE['name']; ?></span>
</div>
<!--- Top Bar Right -------------->
<div id="idObject_NavBarRight" class="Object_NavBarRightHide">
    <div class="pull-right Object_NavBarRightBg" id="idObject_NavBarRightDrop1Area">
    	<ul id="idObject_NavBarRightDrop1"><li>
        <a href="javascript:void(0)" class="Object_NavBarRightLink"><span class="fa fa-cog" style=" font-size: 30px; "></span></a>
        <ul class="drop-right Object_NavBarRightDropDown" id="idObject_NavBarRightDrop1Sub" style="width:240px; height:260px; margin-top: 5px; ">
	    
		<?php
		   include_once(SYSTEM_DOC_ROOT."notification/obj_setting.php");
		?>	    
	</ul>
        </li></ul>
    </div>
    <div class="pull-right Object_NavBarRightBg" id="idObject_NavBarRightDrop2Area">
    	<ul id="idObject_NavBarRightDrop2"><li>
        <a href="javascript:void(0)" class="Object_NavBarRightLink"><span class="fa fa-cloud" style=" font-size: 30px; "></span></a>
        <ul class="drop-right Object_NavBarRightDropDown" id="idObject_NavBarRightDrop2Sub" style="width:240px; margin-top: 5px; ">
		
		<?php
		   include_once(SYSTEM_DOC_ROOT."notification/obj_notify.php");
		?>
		
	</ul>
        </li></ul>
    </div>
    <div class="pull-right Object_NavBarRightBg" id="idObject_NavBarRightDrop3Area">
    	<ul id="idObject_NavBarRightDrop3"><li>
        <a href="javascript:void(0)" class="Object_NavBarRightLink"><span class="fa fa-comments" style=" font-size: 30px; "></span></a>
        <ul class="drop-right Object_NavBarRightDropDown" id="idObject_NavBarRightDrop3Sub" style="width:140px; margin-top: 5px; ">
	    
		<?php
		   include_once(SYSTEM_DOC_ROOT."notification/obj_pm.php");
		?>
	
	</ul>
        </li></ul>
    </div>
    <div class="pull-right Object_NavBarRightBg" style="padding:0px; padding-top:3px; ">
    <img src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/upload/people1.png" width="40" height="40" border="0" class="img-circle" />
    </div>
</div>
<script>
$(document).ready(function() {
    $('#idObject_NavBarRight').switchClass("Object_NavBarRightHide","Object_NavBarRight",800); // slide in right bar down
    $('#idObject_NavBarRightDrop1').dropit({ 
        beforeShow: function(){ FunctionObject_NavBarRight_HideAll(); },
        afterShow: function(){ FunctionObject_NavBarRight_ShowMenu('1'); },
        afterHide: function(){ FunctionObject_NavBarRight_HideAll(); }
    });
    $('#idObject_NavBarRightDrop2').dropit({ 
        beforeShow: function(){ FunctionObject_NavBarRight_HideAll(); },
        afterShow: function(){ FunctionObject_NavBarRight_ShowMenu('2'); },
        afterHide: function(){ FunctionObject_NavBarRight_HideAll(); }
    });
    $('#idObject_NavBarRightDrop3').dropit({ 
        beforeShow: function(){ FunctionObject_NavBarRight_HideAll(); },
        afterShow: function(){ FunctionObject_NavBarRight_ShowMenu('3'); },
        afterHide: function(){ FunctionObject_NavBarRight_HideAll(); }
    });
    $('#idObject_NavBarRightDrop4').dropit({ 
        beforeShow: function(){ FunctionObject_NavBarRight_HideAll(); },
        afterShow: function(){ FunctionObject_NavBarRight_ShowMenu('4'); },
        afterHide: function(){ FunctionObject_NavBarRight_HideAll(); }
    });
    //-------------------------------------------------
    function FunctionObject_NavBarRight_ShowMenu(myi) {
    //-------------------------------------------------
        $('#idObject_NavBarRightDrop'+myi+'Area').switchClass('Object_NavBarRightBg','Object_NavBarRightBgActive',100);
    }
    //-------------------------------------------------
    function FunctionObject_NavBarRight_HideAll() {
    //-------------------------------------------------
        for(i=1;i<=4;i++) {
            $('#idObject_NavBarRightDrop'+i+'Area').switchClass('Object_NavBarRightBgActive','Object_NavBarRightBg',100);
        }
    }
});
</script>