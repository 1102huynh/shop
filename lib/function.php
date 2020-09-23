<?php 
function mailer($from,$to,$subject,$message)
{
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$subject="=?UTF-8?B?".base64_encode($subject)."?=\n";

	require_once('class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	$mail             = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	
	//Cac thong so cua mail server
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "mailer.nhatnghe";  // GMAIL username
	$mail->Password   = "ubbillpfpqrdsscw";  // GMAIL App password
	//End of Cac thong so cua mail server
	
	$mail->SetFrom($from,$from);
	
	$mail->AddReplyTo($from,$from);
	
	$mail->Subject    = $subject;	
	$mail->MsgHTML($message);
	$mail->IsHTML(true);
	$mail->AddAddress($to, "");
	
	if(!$mail->Send()) {
	   return false;
	} else {
	   return true;
	}
}

//Hàm tạo chuỗi ngẫu nhiên
function genCode($n=6)
{
	$code='';
	$str='qwertyuiopasdfghjklzxcvbnm0123456789';
	$len=strlen($str);
	for($i=0;$i<$n;$i++)
	{
		$pos=mt_rand(0,$len-1);//sinh số ngẫu nhiên từ 0 đến $len-1
		$code.=$str[$pos];
	}
	return $code;
}
?>