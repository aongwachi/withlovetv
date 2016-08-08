<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

#####################
function SendMailNewOrder() {
#####################
	global $SystemSession_Member_ID,$SystemSession_Member_Name,$SystemSession_Member_Email;
	global $myOrderID,$myMailDetailInstock,$myMailDetailPreOrder,$myMailDetailAll;
	if($SystemSession_Member_Email<>"") {
		include(SYSTEM_DOC_ROOT."lib/function_sendmail.php");
		$mailContent = "สวัสดีค่ะ มนได้รับ Order แล้วนะคะ โอนเงินแล้วรบกวนเมล์ หรือเข้าไปแจ้งที่<br>
http://new.allfashionthai.com/mypayment.php<br>
ให้ด้วยนะค่ะ<br>
<br>
รหัสสั่งซื้อ : <b><font color=#AA0000>".sprintf("%04d",$myOrderID)."</font></b><br>"; 
if($myMailDetailInstock<>"") {  $mailContent.="<br><h3>สินค้าพร้อมส่ง ( ส่งให้ได้ทันทีค่ะ รอรับสินค้าใน 1-3 วัน )</h3>".$myMailDetailInstock." ค่าส่งไปรษณีย์ EMS สำหรับ พร้อมส่ง ตัวแรก 50 บาท (ตัวต่อไปฟรี) <br><br>"; }
if($myMailDetailPreOrder<>"") { $mailContent.="<br><h3>สินค้าพรีออร์เดอร์ ( รอสั่งนำเข้า และรับสินค้าใน 15-20 วัน ค่ะ )</h3>".$myMailDetailPreOrder." ค่าส่งไปรษณีย์ EMS สำหรับ พรีออร์เดอร์ ตัวแรก 50 บาท (ตัวต่อไปฟรี) <br><br>"; }
$mailContent.=$myMailDetailAll."
##########################<br>
ข้อมูลบัญชีธนาคาร<br>
##########################<br>
ธนาคารกสิกรไทย | KBANK น.ส.มลทิรา บุญโยง กรุงเทพฯ (สาขาย่อยลาดพร้าว 92) ออมทรัพย์ 633-2-03698-8<br>
ธนาคารไทยพาณิชย์ | SCB น.ส.มลทิรา บุญโยง กรุงเทพฯ (สาขาเทสโก้โลตัสทาวน์อินทาวน์) ออมทรัพย์ 401-637377-0<br>
ธนาคารไทยพาณิชย์ | SCB น.ส.มลทิรา บุญโยง ขอนแก่น (สาขาเซ็นทรัลพลาซ่าขอนแก่น) ออมทรัพย์ 402-717498-1<br>
ธนาคารกรุงไทย | KTB น.ส.มลทิรา บุญโยง ขอนแก่น (สาขาเซ็นทรัลพลาซ่าขอนแก่น) ออมทรัพย์ 981-0-30430-7<br>
ธนาคารกรุงเทพ | BBL น.ส.มลทิรา บุญโยง ขอนแก่น (สาขาเซ็นทรัลพลาซ่าขอนแก่น) ออมทรัพย์ 546-7-10225-6<br>
ธนาคารกรุงศรีอยุธยา | BAY น.ส.มลทิรา บุญโยง ขอนแก่น (สาขาเซ็นทรัลพลาซ่าขอนแก่น) ออมทรัพย์ 642-1-08122-2<br>
------------------------------------------------------------------------<br>
<br>
เพื่อความสะดวกรวดเร็ว ในการตรวจ สอบ กรุณาโอนเงินให้มี เศษสตางค์เป็นจุดทศนิยม<br>
และอย่าลืมพิมพ์สลิปไว้ดูด้วย เพื่อที่จะได้แจ้ง วันที่ และเวลา ยอดเงิน ที่ถูกต้องแม่นยำ มาให้เรา<br>
เช่น ยอดโอน 300 บ. ก็ให้โอน 300.21 เป็นต้นค่ะ<br>
<br>
หลังจากโอนเงินเรียบร้อยแล้ว กรุณาแจ้งทางอีเมล์นี้ หรือโทรศัพท์มาแจ้ง หรือล็อกอินเข้าไปแจ้งโอนเงินได้ที่หน้า<br>
http://new.allfashionthai.com/mypayment.php<br>
<br>
หากมีคำถาม หรือข้อสงสัยใดๆ สอบถามได้ที่อีเมล์<br>
สอบถามในเว็บไซต์ หรือเฟสบุ๊ค ได้ทันทีเลยค่ะ<br>
<br>
ขอบพระคุณที่สนใจใช้บริการเราค่ะ<br>
------------------------------------------------------------<br>
คุณมลทิรา บุญโยง (มน)<br>
เวลาทำการ จันทร์-เสาร์ 09.00-17.00 น.<br>
ติดต่อ คุณมน / น้องเอ <br>
------------------------------------------------------------<br>
พบปัญหา มีคำแนะนำติชม ติดต่อได้ที่<br>
มือถือ : 087-228-6363<br>
Line : allfashionthaicom , WhatsApp : 0872286363<br>
อีเมล์ : allfashioninth@gmail.com<br>
เว็บไซต์ : http://new.allfashionthai.com<br>
";
		$mailSubject = "New Order #".sprintf("%04d",$myOrderID)." at AllFashionThai.com";
		$mailBody = $mailContent;
		$m = new Mail;
		$m->From("allfashioninth@gmail.com");
		$m->To($SystemSession_Member_Email);
		$m->Bcc("allfashioninth@gmail.com");
		$m->Subject($mailSubject);
		$m->Body($mailBody);
		$m->Send();
	}
}
#####################
function SendMailNewPayment() {
#####################
	global $SystemSession_Member_ID,$SystemSession_Member_Name,$SystemSession_Member_Email;
	global $inputPrice,$idOrderSelect,$idBank,$inputDate;
	include(SYSTEM_DOC_ROOT."lib/function_sendmail.php");
	$mailContent = "สมาชิกแจ้งโอนเงิน<br>
------------------------------------------------------------<br>
คุณ : ".$SystemSession_Member_Name."<br>
อีเมล์ : ".$SystemSession_Member_Email."<br><br>
รหัสสั่งซื้อ : ".$idOrderSelect."<br>
ธนาคาร : ".$idBank."<br>
วัน เวลา : ".$inputDate." ".$inputTime."<br><br>
แจ้งยอดโอน : ".addslashes($inputPrice)."<br>
------------------------------------------------------------<br>";
	$mailSubject = "New Payment ".addslashes($inputPrice)." baht";
	$mailBody = $mailContent;
	$m = new Mail;
	$m->From("allfashioninth@gmail.com");
	$m->To("allfashioninth@gmail.com");
	$m->Subject($mailSubject);
	$m->Body($mailBody);
	$m->Send();
}
#####################
function SendMailNewMemberFaceBook($myEmail) {
#####################
	global $SystemSession_Member_ID,$SystemSession_Member_Name;
	if($myEmail<>"") {
		include(SYSTEM_DOC_ROOT."lib/function_sendmail.php");
		$mailContent = "ยินดีต้อนรับสมาชิกใหม่ค่ะ<br>
คุณได้ผ่านการสมัครเป็นสมาชิกของเว็บไซต์ AllFashionThai.com เรียบร้อยแล้วค่ะ<br>
<br>
ข้อมูลการเข้าสู่ระบบของคุณ โดยใช้เฟสบุ๊ค<br>
ชื่อ : ".$SystemSession_Member_Name."<br>
<br>
รหัสสมาชิกของคุณ คือ <b><font color=#AA0000>".sprintf("%04d",$SystemSession_Member_ID)."</font></b> นะคะ <br>
เวลาโทรติดต่อกับทีมงาน สามารถใช้อ้างอิง <br>
เพื่อให้ทีมงานสามารถค้นหาข้อมูลสมาชิกได้รวดเร็วยิ่งขึ้นค่ะ <br>
<br>
หากมีคำถาม หรือข้อสงสัยใดๆ สอบถามได้ที่อีเมล์ allfashioninth@gmail.com<br>
หรือ สอบถามในเว็บไซต์ได้ทันทีเลยค่ะ<br>
<br>
ขอขอบพระคุณที่ใช้บริการเรา<br>
AllFashionThai.com 
";
		$mailSubject = "Welcome to AllFashionThai.com";
		$mailBody = $mailContent;
		$m = new Mail;
		$m->From("allfashioninth@gmail.com");
		$m->To($myEmail);
		$m->Bcc("allfashioninth@gmail.com");
		$m->Subject($mailSubject);
		$m->Body($mailBody);
		$m->Send();
	}
}
#####################
function SendMailNewMemberWeb($myEmail) {
#####################
	global $SystemSession_Member_ID,$SystemSession_Member_Name,$inputPassword;
	if($myEmail<>"") {
		include(SYSTEM_DOC_ROOT."lib/function_sendmail.php");
		$mailContent = "ยินดีต้อนรับสมาชิกใหม่ค่ะ<br>
คุณได้ผ่านการสมัครเป็นสมาชิกของเว็บไซต์ AllFashionThai.com เรียบร้อยแล้วค่ะ<br>
<br>
ข้อมูลการเข้าสู่ระบบของคุณคือ<br>
E-mail : ".$myEmail."<br>
Password : ".$inputPassword."<br>
<br>
รหัสสมาชิกของคุณ คือ <b><font color=#AA0000>".sprintf("%04d",$SystemSession_Member_ID)."</font></b> นะคะ <br>
เวลาโทรติดต่อกับทีมงาน สามารถใช้อ้างอิง <br>
เพื่อให้ทีมงานสามารถค้นหาข้อมูลสมาชิกได้รวดเร็วยิ่งขึ้นค่ะ <br>
<br>
หากมีคำถาม หรือข้อสงสัยใดๆ สอบถามได้ที่อีเมล์ allfashioninth@gmail.com<br>
หรือ สอบถามในเว็บไซต์ได้ทันทีเลยค่ะ<br>
<br>
ขอขอบพระคุณที่ใช้บริการเรา<br>
AllFashionThai.com
";
		$mailSubject = "Welcome to AllFashionThai.com 2";
		$mailBody = $mailContent;
		$m = new Mail;
		$m->From("allfashioninth@gmail.com");
		$m->To($myEmail);
		$m->Bcc("allfashioninth@gmail.com");
		$m->Subject($mailSubject);
		$m->Body($mailBody);
		$m->Send();
	}
}
?>