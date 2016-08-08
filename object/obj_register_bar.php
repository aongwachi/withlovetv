<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<?php if($step=="" || $step==1) { ?>
<!-------------------------------------------------------------------->
<div class="hidden-xs hidden-sm width-100">
<div class="div_table width-100">
<div class="div_td bar1-a" style=" width:20px; "></div>
<div class="div_td bar1-a-bg" style=" min-width:195px; ">
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-a-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-a-txt.png" width="160" height="76" class="padding-0 pull-left"></a>
</div> 
<div class="div_td bar1-b" style=" width:30px; "></div>
<div class="div_td bar1-b-bg" style=" width:20px; "></div> 
<div class="div_td bar1-b-bg" style=" min-width:190px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-txt.png" width="130" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-txt.png" width="130" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar1-c" style=" width:30px; "></div>
<div class="div_td bar1-c-bg" style=" width:20px; "></div> 
<div class="div_td bar1-c-bg" style=" min-width:230px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-txt.png" width="185" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-txt.png" width="185" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar1-d" style=" width:30px; "></div>
<div class="div_td bar1-d-bg" style=" width:20px; "></div> 
<div class="div_td bar1-d-bg" style=" min-width:160px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-txt.png" width="120" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-txt.png" width="120" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar1-e" style=" width:20px; "></div>
</div> 
</div> 
<!-------------------------------------------------------------------->
<div class="visible-sm width-100">
<div class="div_table width-100">
<div class="div_td bar1-a" style=" width:20px; "></div>
<div class="div_td bar1-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-a-txt.png" width="160" height="76" class="padding-0"></a></div> 
<div class="div_td bar1-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-txt.png" width="130" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-txt.png" width="130" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-txt.png" width="185" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-txt.png" width="185" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-txt.png" width="120" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-txt.png" width="120" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<div class="visible-xs width-100">
<div class="div_table width-100">
<div class="div_td bar1-a" style=" width:20px; "></div>
<div class="div_td bar1-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-a-no.png" width="30" height="76" class="padding-0"></a></div> 
<div class="div_td bar1-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-b-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-c-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar1-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar1-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar1-d-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar1-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<?php } if($step==2) { ?>
<!-------------------------------------------------------------------->
<div class="hidden-xs hidden-sm width-100">
<div class="div_table width-100">
<div class="div_td bar2-a" style=" width:20px; "></div>
<div class="div_td bar2-a-bg" style=" min-width:195px; ">
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-a-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-a-txt.png" width="160" height="76" class="padding-0 pull-left"></a>
</div> 
<div class="div_td bar2-b" style=" width:30px; "></div>
<div class="div_td bar2-b-bg" style=" width:20px; "></div> 
<div class="div_td bar2-b-bg" style=" min-width:190px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-txt.png" width="130" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-txt.png" width="130" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar2-c" style=" width:30px; "></div>
<div class="div_td bar2-c-bg" style=" width:20px; "></div> 
<div class="div_td bar2-c-bg" style=" min-width:230px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-txt.png" width="185" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-txt.png" width="185" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar2-d" style=" width:30px; "></div>
<div class="div_td bar2-d-bg" style=" width:20px; "></div> 
<div class="div_td bar2-d-bg" style=" min-width:160px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-txt.png" width="120" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-txt.png" width="120" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar2-e" style=" width:20px; "></div>
</div> 
</div> 
<!-------------------------------------------------------------------->
<div class="visible-sm width-100">
<div class="div_table width-100">
<div class="div_td bar2-a" style=" width:20px; "></div>
<div class="div_td bar2-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-a-txt.png" width="160" height="76" class="padding-0"></a></div> 
<div class="div_td bar2-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-txt.png" width="130" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-txt.png" width="130" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-txt.png" width="185" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-txt.png" width="185" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-txt.png" width="120" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-txt.png" width="120" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<div class="visible-xs width-100">
<div class="div_table width-100">
<div class="div_td bar2-a" style=" width:20px; "></div>
<div class="div_td bar2-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-a-no.png" width="30" height="76" class="padding-0"></a></div> 
<div class="div_td bar2-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-b-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-c-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar2-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar2-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar2-d-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar2-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<?php } if($step==3) { ?>
<!-------------------------------------------------------------------->
<div class="hidden-xs hidden-sm width-100">
<div class="div_table width-100">
<div class="div_td bar3-a" style=" width:20px; "></div>
<div class="div_td bar3-a-bg" style=" min-width:195px; ">
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-a-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-a-txt.png" width="160" height="76" class="padding-0 pull-left"></a>
</div> 
<div class="div_td bar3-b" style=" width:30px; "></div>
<div class="div_td bar3-b-bg" style=" width:20px; "></div> 
<div class="div_td bar3-b-bg" style=" min-width:190px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-txt.png" width="130" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-txt.png" width="130" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar3-c" style=" width:30px; "></div>
<div class="div_td bar3-c-bg" style=" width:20px; "></div> 
<div class="div_td bar3-c-bg" style=" min-width:230px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-txt.png" width="185" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-txt.png" width="185" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar3-d" style=" width:30px; "></div>
<div class="div_td bar3-d-bg" style=" width:20px; "></div> 
<div class="div_td bar3-d-bg" style=" min-width:160px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-txt.png" width="120" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-txt.png" width="120" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar3-e" style=" width:20px; "></div>
</div> 
</div> 
<!-------------------------------------------------------------------->
<div class="visible-sm width-100">
<div class="div_table width-100">
<div class="div_td bar3-a" style=" width:20px; "></div>
<div class="div_td bar3-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-a-txt.png" width="160" height="76" class="padding-0"></a></div> 
<div class="div_td bar3-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-txt.png" width="130" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-txt.png" width="130" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-txt.png" width="185" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-txt.png" width="185" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-txt.png" width="120" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-txt.png" width="120" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<div class="visible-xs width-100">
<div class="div_table width-100">
<div class="div_td bar3-a" style=" width:20px; "></div>
<div class="div_td bar3-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-a-no.png" width="30" height="76" class="padding-0"></a></div> 
<div class="div_td bar3-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-b-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-c-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar3-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar3-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar3-d-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar3-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<?php } if($step==4) { ?>
<!-------------------------------------------------------------------->
<div class="hidden-xs hidden-sm width-100">
<div class="div_table width-100">
<div class="div_td bar4-a" style=" width:20px; "></div>
<div class="div_td bar4-a-bg" style=" min-width:195px; ">
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-a-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-a-txt.png" width="160" height="76" class="padding-0 pull-left"></a>
</div> 
<div class="div_td bar4-b" style=" width:30px; "></div>
<div class="div_td bar4-b-bg" style=" width:20px; "></div> 
<div class="div_td bar4-b-bg" style=" min-width:190px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-txt.png" width="130" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-txt.png" width="130" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar4-c" style=" width:30px; "></div>
<div class="div_td bar4-c-bg" style=" width:20px; "></div> 
<div class="div_td bar4-c-bg" style=" min-width:230px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-txt.png" width="185" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-txt.png" width="185" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar4-d" style=" width:30px; "></div>
<div class="div_td bar4-d-bg" style=" width:20px; "></div> 
<div class="div_td bar4-d-bg" style=" min-width:160px; ">
        <?php if($SystemSession_Member_ID>0) { ?>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-no.png" width="30" height="76" class="padding-0 pull-left"></a>
	<a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-txt.png" width="120" height="76" class="padding-0 pull-left"></a>
        <?php } else { ?>
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-no.png" width="30" height="76" class="padding-0 pull-left">
	<img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-txt.png" width="120" height="76" class="padding-0 pull-left">
        <?php } ?>
</div> 
<div class="div_td bar4-e" style=" width:20px; "></div>
</div> 
</div> 
<!-------------------------------------------------------------------->
<div class="visible-sm width-100">
<div class="div_table width-100">
<div class="div_td bar4-a" style=" width:20px; "></div>
<div class="div_td bar4-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-a-txt.png" width="160" height="76" class="padding-0"></a></div> 
<div class="div_td bar4-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-txt.png" width="130" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-txt.png" width="130" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-txt.png" width="185" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-txt.png" width="185" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-txt.png" width="120" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-txt.png" width="120" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<div class="visible-xs width-100">
<div class="div_table width-100">
<div class="div_td bar4-a" style=" width:20px; "></div>
<div class="div_td bar4-a-bg text-left"><a href="register.php?step=1"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-a-no.png" width="30" height="76" class="padding-0"></a></div> 
<div class="div_td bar4-b" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-b-bg text-center"><a href="register.php?step=2"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-b-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-b-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-c" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-c-bg text-center"><a href="register.php?step=3"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-c-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-c-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-d" style=" width:30px; "></div>
<?php if($SystemSession_Member_ID>0) { ?>
<div class="div_td bar4-d-bg text-center"><a href="register.php?step=4"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-no.png" width="30" height="76" class="padding-0"></a></div> 
<?php } else { ?>
<div class="div_td bar4-d-bg text-center"><img src="<?=SYSTEM_WEBPATH_TEMPLATES?>/img/bar4-d-no.png" width="30" height="76" class="padding-0"></div> 
<?php } ?>
<div class="div_td bar4-e" style=" width:20px; "></div>
</div> 
</div>
<!-------------------------------------------------------------------->
<?php } ?>
<?php if($SystemSession_Member_ID>0) { ?>
<div style=" padding:0px; padding-top: 10px; padding-bottom: 10px;" class="hidden-xs">
<div class="width-100 border-radius-5 padding-10" style=" height: 40px; padding-left: 20px; padding-right: 20px; background-color: #669900; color: #FFFFFF; ">
<div class="pull-left" style=" height: 40px; ">&nbsp;Welcome <b><?=$SystemSession_Member_Name?></b></div>
<div class="pull-right" style=" height: 40px; ">&nbsp;<a href="logout.php" class="MemberLink">Logout</a>&nbsp;</div>
<div class="pull-right" style=" height: 40px; ">
    <?php if($step==3) { ?>
    &nbsp;<a href="register.php?step=3" class="MemberLink"><font color="#FFFF00">Hotel Reservation</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=3" class="MemberLink">Hotel Reservation</a>&nbsp;
    <?php } ?>
</div>
<div class="pull-right" style=" height: 40px; ">
    <?php if($step==2) { ?>
    &nbsp;<a href="register.php?step=2" class="MemberLink"><font color="#FFFF00">Abstract</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=2" class="MemberLink">Abstract</a>&nbsp;
    <?php } ?>
</div>
<div class="pull-right" style=" height: 40px; ">
    <?php if($step==1) { ?>
    &nbsp;<a href="register.php?step=1" class="MemberLink"><font color="#FFFF00">Profile</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=1" class="MemberLink">Profile</a>&nbsp;
    <?php } ?>
</div>
</div></div>

<div style=" padding:0px; padding-top: 10px; padding-bottom: 10px;" class="visible-xs">
<div class="width-100 border-radius-5 padding-10" style=" height: 70px; padding-left: 20px; padding-right: 20px; background-color: #669900; color: #FFFFFF; ">
<div class="text-center" style=" height: 25px; font-size: 16px; ">&nbsp;Welcome <b><?=$SystemSession_Member_Name?></b></div>
<div class="text-center" style=" height: 25px; ">
    <?php if($step==1) { ?>
    &nbsp;<a href="register.php?step=1" class="MemberLink2"><font color="#FFFF00">Profile</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=1" class="MemberLink2">Profile</a>&nbsp;
    <?php } ?>
    <?php if($step==2) { ?>
    &nbsp;<a href="register.php?step=2" class="MemberLink2"><font color="#FFFF00">Abstract</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=2" class="MemberLink2">Abstract</a>&nbsp;
    <?php } ?>
    <?php if($step==3) { ?>
    &nbsp;<a href="register.php?step=3" class="MemberLink2"><font color="#FFFF00">Hotel Reservation</font></a>&nbsp;
    <?php } else { ?>
    &nbsp;<a href="register.php?step=3" class="MemberLink2">Hotel Reservation</a>&nbsp;
    <?php } ?>
    &nbsp;<a href="logout.php" class="MemberLink2">Logout</a>&nbsp;
</div>
</div></div>
<?php } else { ?>
<div style=" padding:0px; padding-top: 10px; padding-bottom: 10px;" class="hidden-xs">
<div class="width-100 border-radius-5 padding-20 bg-white text-center" style=" color: #999999; ">
If you already registered, Please <a href="member.php"><b>Login</b></a> or <a href="member.php"><b>Forgot your password?</b></a>
</div></div>
<?php  } ?>