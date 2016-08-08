<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<?php if($SystemSession_Staff_ID>0) { ?>
<!--- Top Bar -------------->
<div class="Object_NavBarTop text-center">
    <?php if(0) { ?><a href="index.php" class="Object_NavBarRightLink"><span class="navbar-brand cursor"></span></a><?php } ?>
</div>
<!-----<a href="index.php" class="Object_NavBarRightLink"><span class="navbar-brand cursor"></span></a>---->
<!--- Top Bar Right -------------->
<div id="idObject_NavBarRight" class="Object_NavBarRight" style=" width:380px; display: none; ">    
    <!--------------------------------------------------------->
    <div class="pull-right Object_NavBarRightBg" id="idObject_NavBarRightDrop1Area">
        <ul id="idObject_NavBarRightDrop1"><li>
        <a href="javascript:void(0)" class="Object_NavBarRightLink"><span class="fa fa-angle-double-down" style=" font-size: 26px; margin-top: -6px; "></span></a>
        <?php
        include_once(SYSTEM_DOC_ROOT."object/obj_submenu_setting.php");
        ?>
        </li>
        </ul>
    </div>
    <!--------------------------------------------------------->
    <div style=" width: 220px; height: 30px; padding-top:12px; padding-right:5px; " class="pull-right text-right">
    <b><font color="#d91c5c"><?php echo $SystemSession_Staff_User; ?></font></b> as <?php echo $SystemSession_Staff_Level; ?>
    </div>
    <!--------------------------------------------------------->    
</div>
<script>
$(document).ready(function() {
    $('#idObject_NavBarRight').switchClass("Object_NavBarRightHide","Object_NavBarRight",800); // slide in right bar down
    $('#idObject_NavBarRightDrop1').dropit({ 
        beforeShow: function(){ FunctionObject_NavBarRight_HideAll(); },
        afterShow: function(){ FunctionObject_NavBarRight_ShowMenu('1'); },
        afterHide: function(){ FunctionObject_NavBarRight_HideAll(); }
    });    //-------------------------------------------------
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
    $('#idObject_NavBarRight').show();
});
</script>
<?php } ?>
