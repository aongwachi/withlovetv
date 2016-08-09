<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
$System_LayoutUse="layout_manage.html";
$myMenuKey="Tv_Program";
$System_AjaxFileAction="ajax-tv-program-loaddata.php";
$System_ShowAjaxIFrame=0;

include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") {
    //----------------------------------------------------------------------------------------------------------------
    include_once(SYSTEM_DOC_ROOT."system/core-start.php");
    include_once(SYSTEM_DOC_ROOT."system/core-body.php");
    //----------------------------------------------------------------------------------------------------------------
    // Panel BG
    //----------------------------------------------------------------------------------------------------------------
    $myBGColor='#9ACD32';
    $myBGColorLighter=System_ColorLighter($myBGColor);
    $return=basename(__FILE__, '.php'); // file name for base file .php
    //----------------------------------------------------------------------------------------------------------------
    // 1/5 Setting FooTable Config
    //----------------------------------------------------------------------------------------------------------------
    $FooTableName='idTableMain'; // Key for Multitable
    $FooTableAjaxFile=$System_AjaxFileAction;
    $FooTablePageSize=CONFIG_PAGESIZE;
    $FooTableASCDESC='DESC';
    $FooTableOrderBy=TABLE_PROGRAM."_ID";
    //----------------------------------------------------------------------------------------------------------------
    ?>
    <!---###############################################################################--->
    <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
    <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
    <!---###############################################################################--->
    <div class="row-fluid width-100 padding-5">

        <div class="visible-xs" style=" padding-bottom: 5px; ">
            <button type="button" name="inputCancel" class="btn btn-success btn-block btn-flat" style="height:50px;" onclick=" showPopUpWindowAdd(); " >
                <span class="glyphicon glyphicon-plus"></span> เพิ่มผู้ใช้ใหม่</button>
        </div>

        <div class="panel panel-custom" style=" border-width:0px; ">
            <div class="panel-heading panel-custom-heading font-white" style=" background-color:<?php echo $myBGColor; ?>; color:#FFFFFF; text-align:left; height:80px; position:relative; ">
                <i class="fa fa-film pull-left padding-10" style="font-size:40px; padding-right:20px;"></i>
                <h2 class="font-white"><strong>Recommend Video</strong></h2> <span> รายการแนะนำ</span>
                <div class="pull-right" style=" color:#FFFF00; "><span class="hidden-xs">ค้นพบ</span>
                    <!--------------------------------------------------------------------------------------------->
                    <!--- 2/5 Total record will display here ------------------------------------------------------>
                    <!--------------------------------------------------------------------------------------------->
                    <span id="idFooTableTotalRecord">0</span>
                    <!---------------------------------------------------------------------------------------------->
                    รายการ
                    <div class="hidden-xs pull-right" style=" width:85px; "></div>
                </div>
                <button type="button" class="btn btn-success btn-flat pull-right hidden-xs" style=" position:absolute; top:0px; right:0px; height:80px; width:80px; "
                        onclick=" showPopUpWindowAdd(); " >
                    <span class="glyphicon glyphicon-plus"></span> เพิ่ม
                </button>
            </div>
            <div class="panel-body panel-custom-body padding-10" style="padding-top:10px; padding-bottom:10px; " id="idTableCalendar">
                <form action="?" method="post" id="<?php echo $FooTableName; ?>Form" onsubmit="FooTableLoadAjaxReloadData(); return false;" autocomplete="off">
                    <!--------------------------------------------------------------------------------------------------------->
                    <!--- 3/5 Custom your variable pass to your ajax file ----------------------------------------------------->
                    <!---- Basic variable ------------------------------------------------------------------------------------->
                    <input type="hidden" id="doaction" name="doaction" value="result" />
                    <input type="hidden" id="orderby" name="orderby" value="<?php echo $FooTableOrderBy; ?>" />
                    <input type="hidden" id="ascdesc" name="ascdesc" value="<?php echo $FooTableASCDESC; ?>" />
                        <input type="hidden" id="recordstart" name="recordstart" value="0" />
                        <input type="hidden" id="recordsize" name="recordsize" value="<?php echo $FooTablePageSize; ?>" />
                        <div class="input-group width-100 padding-5" style="padding-left:0px; padding-right:0px;">
                            <input type="text" id="search" name="search" class="form-control border-info font-18 text-center" style=" height:40px; "
                                   placeholder="ค้นหาจาก ชื่อรายการ">
			<span class="input-group-btn">
			<button type="submit" class="btn btn-info btn-flat" style=" height:40px; " name="searchpatient" type="button">ค้นหา</button>
			</span>
                    </div>
                    <!----------------------------------------------------------------------------------------------------------->
                </form>
                <table class="footable" id="<?php echo $FooTableName; ?>" data-page-size="10000">
                    <thead>
                    <tr class="footable-head">
                        <!---------------------------------------------------------------------------------------------------------------->
                        <!--- 4/5 Create your table header ------------------------------------------------------------------------------>
                        <!---------------------------------------------------------------------------------------------------------------->
                        <th data-toggle="true" style="max-width:60px;"><a href="javascript:void(0)" class="Link_FooTableActive" data-sort="<?php echo TABLE_PROGRAM."_ID"; ?>">
                                <i class="glyphicon glyphicon-chevron-up font-10 padding-4"></i>#</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_Name"; ?>"><i></i>Name</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_Detail"; ?>"><i></i>Detail</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_URL"; ?>"><i></i>URL</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_WeekDay"; ?>"><i></i>WeekDay</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_Start"; ?>"><i></i>Start</a></th>
                        <th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_PROGRAM."_End"; ?>"><i></i>End</a></th>
                        <th style=" width:60px; padding: 0px; ">&nbsp;</th>
                        <!----------------------------------------------------------------------------------------------------------------------->
                    </tr>
                    </thead>
                    <tbody>
                    <!--- // Your ajax result in ajax file ajax-loaddata.php ( Ajax data will append here ) ----------------->
                    </tbody>
                </table>
                <div class="padding-20 text-center" id="<?php echo $FooTableName; ?>DataNotFound" style="display:none;">
                    <br /><br /><img src="<?php echo SYSTEM_RELATIVEPATH_TEMPLATES; ?>/img/datanotfound.png" width="452" class="img-responsive pull-center" /><br /><br />
                </div>
                <div id="<?php echo $FooTableName; ?>Ending" class="padding-4" style=" padding-left:0px; padding-right:0px; display:none; ">
                    <button type="button" class="btn btn-block btn-default disabled" style=" height:50px; " > No more data </button>
                </div>
            </div>
        </div>
        <!---###############################################################################--->
        <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
        <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.css">
        <!---###############################################################################--->
        <style>
            .bootstrap-dialog .modal-header.bootstrap-dialog-draggable { cursor: move; }
        </style>
        <script>
            var dialogPopWindow;
            var isNeedRefresh=0;
            //----------------------------------
            function showPopUpWindowAdd() {
                //----------------------------------
                dialogPopWindow = BootstrapDialog.show({
                    title: 'เพิ่มรายการใหม่',
                    draggable: true,
                    message: $('<div></div>').load('<?php echo $System_AjaxFileAction; ?>?task=load-add',function(data){
                        //runSomeScript();
                    }),
                    onshown: function(dialogRef){
                        //runSomeScript();
                    },
                    onhidden: function(dialogRef){
                        //if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
                        $('#myRefreshForm').submit();
                    }
                });
            }
            //----------------------------------
            function showPopUpWindowEdit(myID) {
                //----------------------------------
                dialogPopWindow = BootstrapDialog.show({
                    title: 'แก้ไขรายการ',
                    draggable: true,
                    message: $('<div></div>').load('<?php echo $System_AjaxFileAction; ?>?task=load-edit&myAjaxID='+myID,function(data){
                        //runSomeScript();
                    }),
                    onshown: function(dialogRef){
                        //runSomeScript();
                    },
                    onhidden: function(dialogRef){
                        //if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
                        $('#myRefreshForm').submit();
                    }
                });
            }
            //----------------------------------
            function showPopUpWindowDelete(myID) {
                //----------------------------------
                dialogPopWindow = BootstrapDialog.show({
                    title: 'ลบรายการ',
                    draggable: true,
                    type: BootstrapDialog.TYPE_DANGER,
                    message: $('<div></div>').load('<?php echo $System_AjaxFileAction; ?>?task=load-confirm&myAjaxID='+myID,function(data){
                        //runSomeScript();
                    }),
                    onshown: function(dialogRef){
                        //runSomeScript();
                    },
                    onhidden: function(dialogRef){
                        //if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
                        $('#myRefreshForm').submit();
                    }
                });
            }
            //-------------------------------------------
            function doDelete(myID) {
                //-------------------------------------------
                $('#myAjaxAction').val('data-delete');
                $('#myAjaxID').val(myID);
                $('#myAjaxForm').submit();
                dialogPopWindow.close();
            }
            //-------------------------------------------
            function showDelete(myID) {
                //-------------------------------------------
                $('#idTableRow'+myID).css("background-color", "#ffe5e5");
                $('#idTableRow'+myID).fadeOut(2000);
            }
        </script>
        <form name="myRefreshForm" id="myRefreshForm" method="get" action="?">
        </form>
    <?php
    //----------------------------------------------------------------------------------------------------------------
    // 5/5 Load FooTable Script [End]
    //----------------------------------------------------------------------------------------------------------------
    //เรียกใช้งาน inc_footable_script เพื่อดึงข้อมูล โดยใช้ Footable Script
    include_once(SYSTEM_DOC_ROOT."object/inc_footable_script.php"); // use 1 table per page only
    include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
    //----------------------------------------------------------------------------------------------------------------
    ######################################################################
    include_once(SYSTEM_DOC_ROOT."system/core-end.php");

} else {
    $myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
    include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>