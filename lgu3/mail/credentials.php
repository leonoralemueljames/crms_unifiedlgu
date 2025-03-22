<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPmailer/src/Exception.php';
require '../../PHPmailer/src/PHPMailer.php';
require '../../PHPmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new  PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mail.crms.unifiedlgu@gmail.com'; // Your SMTP username
    $mail->Password = 'cblflapnrppuijol'; // Your SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('mail.crms.unifiedlgu@gmail.com', 'CRMS Admin');
    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
    $mail->Subject = 'Account created for ' . htmlspecialchars($email) . ' ';
    $mail->Body    = '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
 <head>
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta charset="UTF-8">
  <meta name="x-apple-disable-message-reformatting">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="telephone=no" name="format-detection">
  <title>New email template 2024-10-21</title><!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
<noscript>
         <xml>
           <o:OfficeDocumentSettings>
           <o:AllowPNG></o:AllowPNG>
           <o:PixelsPerInch>96</o:PixelsPerInch>
           </o:OfficeDocumentSettings>
         </xml>
      </noscript>
<![endif]--><!--[if !mso]><!-- -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,400i,700,700i" rel="stylesheet"><!--<![endif]-->
  <style type="text/css">
.rollover:hover .rollover-first {
  max-height:0px!important;
  display:none!important;
}
.rollover:hover .rollover-second {
  max-height:none!important;
  display:block!important;
}
.rollover span {
  font-size:0px;
}
u + .body img ~ div div {
  display:none;
}
#outlook a {
  padding:0;
}
span.MsoHyperlink,
span.MsoHyperlinkFollowed {
  color:inherit;
  mso-style-priority:99;
}
a.es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
}
a[x-apple-data-detectors],
#MessageViewBody a {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
}
.es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
}
.es-button-border:hover {
  border-color:#42d159 #42d159 #42d159 #42d159!important;
  background:#40b8ec!important;
}
.es-button-border:hover a.es-button,
.es-button-border:hover button.es-button {
  background:#40b8ec!important;
}
td .es-button-border:hover a.es-button-1729504899035 {
  background:#aNaNaN!important;
}
td .es-button-border-1729504899053:hover {
  background:#aNaNaN!important;
}
td .es-button-border:hover a.es-button-1729507268599 {
  background:#aNaNaN!important;
}
td .es-button-border-1729507268624:hover {
  background:#aNaNaN!important;
  border-style:solid solid solid solid!important;
  border-color:#42d159 #42d159 #42d159 #42d159!important;
}
@media only screen and (max-width:600px) {.es-m-p0r { padding-right:0px!important } .es-m-p20b { padding-bottom:20px!important } .es-m-p5t { padding-top:5px!important } .es-m-p10b { padding-bottom:10px!important } .es-m-p20t { padding-top:20px!important } .es-m-p15b { padding-bottom:15px!important } .es-p-default { } *[class="gmail-fix"] { display:none!important } p, a { line-height:150%!important } h1, h1 a { line-height:120%!important } h2, h2 a { line-height:120%!important } h3, h3 a { line-height:120%!important } h4, h4 a { line-height:120%!important } h5, h5 a { line-height:120%!important } h6, h6 a { line-height:120%!important } .es-header-body p { } .es-content-body p { } .es-footer-body p { } .es-infoblock p { } h1 { font-size:30px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } h4 { font-size:24px!important; text-align:left } h5 { font-size:20px!important; text-align:left } h6 { font-size:16px!important; text-align:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:26px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-header-body h4 a, .es-content-body h4 a, .es-footer-body h4 a { font-size:24px!important } .es-header-body h5 a, .es-content-body h5 a, .es-footer-body h5 a { font-size:20px!important } .es-header-body h6 a, .es-content-body h6 a, .es-footer-body h6 a { font-size:16px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body a { font-size:16px!important } .es-content-body p, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock a { font-size:12px!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3, .es-m-txt-c h4, .es-m-txt-c h5, .es-m-txt-c h6 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3, .es-m-txt-r h4, .es-m-txt-r h5, .es-m-txt-r h6 { text-align:right!important } .es-m-txt-j, .es-m-txt-j h1, .es-m-txt-j h2, .es-m-txt-j h3, .es-m-txt-j h4, .es-m-txt-j h5, .es-m-txt-j h6 { text-align:justify!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3, .es-m-txt-l h4, .es-m-txt-l h5, .es-m-txt-l h6 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-m-txt-r .rollover:hover .rollover-second, .es-m-txt-c .rollover:hover .rollover-second, .es-m-txt-l .rollover:hover .rollover-second { display:inline!important } .es-m-txt-r .rollover span, .es-m-txt-c .rollover span, .es-m-txt-l .rollover span { line-height:0!important; font-size:0!important; display:block } .es-spacer { display:inline-table } a.es-button, button.es-button { font-size:20px!important; padding:10px 20px 10px 20px!important; line-height:120%!important } a.es-button, button.es-button, .es-button-border { display:inline-block!important } .es-m-fw, .es-m-fw.es-fw, .es-m-fw .es-button { display:block!important } .es-m-il, .es-m-il .es-button, .es-social, .es-social td, .es-menu { display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .adapt-img { width:100%!important; height:auto!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } .h-auto { height:auto!important } .es-text-8965 .es-text-mobile-size-18.es-override-size, .es-text-8965 .es-text-mobile-size-18.es-override-size * { font-size:18px!important; line-height:150%!important } .es-text-9585 .es-text-mobile-size-14.es-override-size, .es-text-9585 .es-text-mobile-size-14.es-override-size * { font-size:14px!important; line-height:150%!important } .es-text-9585 .es-text-mobile-size-16.es-override-size, .es-text-9585 .es-text-mobile-size-16.es-override-size * { font-size:16px!important; line-height:150%!important } .img-7840 { width:74px!important } .img-7802 { width:74px!important } .es-text-2548 .es-text-mobile-size-14.es-override-size, .es-text-2548 .es-text-mobile-size-14.es-override-size * { font-size:14px!important; line-height:150%!important } .es-text-2548 .es-text-mobile-size-13.es-override-size, .es-text-2548 .es-text-mobile-size-13.es-override-size * { font-size:13px!important; line-height:150%!important } }
@media screen and (max-width:384px) {.mail-message-content { width:414px!important } }
</style>
 </head>
 <body class="body" style="width:100%;height:100%;padding:0;Margin:0">
  <div dir="ltr" class="es-wrapper-color" lang="en" style="background-color:#FFFFFF"><!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#ffffff"></v:fill>
			</v:background>
		<![endif]-->
   <table width="100%" cellspacing="0" cellpadding="0" class="es-wrapper" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FFFFFF">
     <tr>
      <td valign="top" style="padding:0;Margin:0">
       <table cellpadding="0" cellspacing="0" align="center" class="es-header" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr>
          <td align="center" style="padding:0;Margin:0;background:linear-gradient(180deg, #FFFFFF 75%, #F6F6F6 75%)">
           <table align="center" cellpadding="0" cellspacing="0" class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" role="none">
             <tr>
              <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px">
               <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><h1 style="Margin:0;font-family:arial, helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:40px;font-style:normal;font-weight:bold;line-height:48px;color:#333333"><strong>Account Credentials Information</strong></h1></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">We generate the account credentials information essential for creating personalized access for users within the system.</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-bottom:20px">
               <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" valign="top" style="padding:0;Margin:0;width:600px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/guids/CABINET_a396dc3ebcde5573dae82d53c44871be/images/87511614787829880.png" alt="Business" width="430" title="Business" class="adapt-img" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellspacing="0" cellpadding="0" align="center" class="es-content" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
         <tr>
          <td align="center" style="padding:0;Margin:0">
           <table cellspacing="0" cellpadding="0" align="center" class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" role="none">
             <tr>
              <td align="left" style="Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;padding-bottom:5px">
               <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><h2 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:24px;font-style:normal;font-weight:normal;line-height:28.8px;color:#333333">Greetings, ' . htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname) . '</h2></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#1B4965;font-size:14px">You are receiving this email because an account has been created for you on our portal. Below are your account credentials:</p></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:20px;Margin:0;font-size:0">
                       <table cellspacing="0" border="0" width="100%" height="100%" cellpadding="0" class="es-spacer" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr>
                          <td style="padding:0;Margin:0;width:100%;margin:0px;border-bottom:1px solid #cccccc;background:none;height:1px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" align="center" cellspacing="0" class="es-content" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
         <tr>
          <td align="center" style="padding:0;Margin:0">
           <table align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff" class="es-content-body" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr>
              <td align="left" style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-bottom:20px;background-position:left bottom"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:194px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr>
                  <td align="center" class="es-m-p0r es-m-p20b" style="padding:0;Margin:0;width:174px">
                   <table cellpadding="0" width="100%" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:5px"><img alt="" width="80" src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/teampeoplegroup256.png" class="img-7802" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><h3 class="es-m-txt-c" style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">Your Username</h3></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><p class="es-m-txt-c" style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#666666;font-size:14px">' . htmlspecialchars($username) . '</p></td>
                     </tr>
                   </table></td>
                  <td class="es-hidden" style="padding:0;Margin:0;width:20px"></td>
                 </tr>
               </table><!--[if mso]></td><td style="width:173px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr>
                  <td align="center" class="es-m-p20b" style="padding:0;Margin:0;width:173px">
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:5px"><img src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/internet_security_padlock_lock_locked_password_secure256.png" alt="" width="80" class="img-7840" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><h3 class="es-m-txt-c" style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">Your Password</h3></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><p class="es-m-txt-c" style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#666666;font-size:14px">' . htmlspecialchars($password) . '</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td><td style="width:20px"></td><td style="width:173px" valign="top"><![endif]-->
               <table cellspacing="0" cellpadding="0" align="right" class="es-right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr>
                  <td align="center" style="padding:0;Margin:0;width:173px">
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left bottom" role="presentation">
                     <tr>
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;padding-bottom:5px;padding-top:25px"><img alt="" width="55" src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/4_login256.png" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><h3 class="es-m-txt-c" style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">Account Role</h3></td>
                     </tr>
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-bottom:10px"><p class="es-m-txt-c" style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#666666;font-size:14px">' . htmlspecialchars($_POST["role"]) . '</p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" cellspacing="0" align="center" class="es-content" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important">
         <tr>
          <td align="center" style="padding:0;Margin:0">
           <table cellpadding="0" bgcolor="#ffffff" align="center" cellspacing="0" class="es-content-body" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr>
              <td align="left" style="Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;padding-bottom:0px">
               <table cellspacing="0" align="right" cellpadding="0" class="es-right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr>
                  <td align="left" style="padding:0;Margin:0;width:560px">
                   <table cellspacing="0" width="100%" role="presentation" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="left" class="es-text-9585" style="padding:0;Margin:0">
                       <ul style="font-family:arial, "helvetica neue", helvetica, sans-serif;padding:0px 0px 0px 40px;margin-top:15px;margin-bottom:15px;list-style-type:square">
                        <li style="color:#1B4965;margin:0px 0px 15px;font-size:14px">Note: Please keep your credentials safe and do not share them with anyo​ne.</li>
                        <li style="color:#1B4965;margin:0px 0px 15px;font-size:14px">If you have any questions or need assistance, feel free to contact our support team. (mail..crms.unifiedlgu@gmail.com)</li>
                       </ul></td>
                     </tr>
                     <tr>
                      <td align="left" class="es-m-p10b es-m-p5t es-text-2548" style="padding:0;Margin:0"><p class="es-m-txt-l es-text-mobile-size-14 es-override-size" style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#1B4965;font-size:14px;margin-left:40px"><strong><em><span class="es-text-mobile-size-13 es-override-size">B</span><span class="es-text-mobile-size-13 es-override-size" style="font-family:helvetica, "helvetica neue", arial, verdana, sans-serif">est Regards, CRMS Team</span><span class="es-text-mobile-size-13 es-override-size" style="font-family:helvetica, "helvetica neue", arial, verdana, sans-serif"></span></em></strong></p></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0;font-size:0px"><img src="https://eloigio.stripocdn.email/content/guids/videoImgGuid/images/4077799.png" alt="" width="560" class="adapt-img" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:20px;Margin:0;font-size:0">
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr>
                          <td style="padding:0;Margin:0;border-bottom:1px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr>


                     
                      <td align="center" style="padding:0;Margin:0"><!--[if mso]><a href="https://crms.unifiedlgu.com/admin/sign-in" target="_blank" hidden>
	<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://crms.unifiedlgu.com/admin/sign-in" style="height:41px; v-text-anchor:middle; width:153px" arcsize="50%" stroke="f"  fillcolor="#1b4961">
		<w:anchorlock></w:anchorlock>
		<center style="color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:15px; font-weight:400; line-height:15px;  mso-text-raise:1px">Access Portal</center>
	</v:roundrect></a>
<![endif]--><!--[if !mso]><!-- --><span class="es-button-border-1729504899053 es-button-border msohide" style="border-style:solid;border-color:#2CB543;background:#1b4961;border-width:0px;display:inline-block;border-radius:30px;width:auto;mso-hide:all"><a href="https://crms.unifiedlgu.com/admin/sign-in" target="_blank" class="es-button es-button-1729504899035" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;padding:10px 20px 10px 20px;display:inline-block;background:#1b4961;border-radius:30px;font-family:arial,
    helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:21.6px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #1b4961">Access Portal</a></span><!--<![endif]--></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:20px;Margin:0;font-size:0">
                       <table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr>
                          <td style="padding:0;Margin:0;border-bottom:0px solid #cccccc;background:unset;height:1px;width:100%;margin:0px"></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" cellspacing="0" align="center" class="es-footer" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr>
          <td align="center" bgcolor="#1b4965" style="padding:0;Margin:0;background-color:#1b4965">
           <table bgcolor="#1b4965" align="center" cellpadding="0" cellspacing="0" class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#1b4965;width:600px" role="none">
             <tr>
              <td align="left" style="padding:0;Margin:0;padding-right:20px;padding-left:20px;padding-top:30px">
               <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" class="es-m-p0r" style="padding:0;Margin:0;width:560px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><h2 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:36px;font-style:normal;font-weight:normal;line-height:43.2px;color:#ffffff"><b>Account Roles for Compliance &amp; Regulatory Management System</b>&nbsp;</h2></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
             <tr>
              <td align="left" background="https://eloigio.stripocdn.email/content/guids/CABINET_a396dc3ebcde5573dae82d53c44871be/images/53501614850634859.png" style="Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;padding-bottom:30px;background-image:url(https://eloigio.stripocdn.email/content/guids/CABINET_a396dc3ebcde5573dae82d53c44871be/images/53501614850634859.png);background-repeat:no-repeat;background-position:center 25px"><!--[if mso]><table style="width:555px" cellpadding="0" cellspacing="0"><tr><td style="width:200px" valign="top"><![endif]-->
               <table cellpadding="0" cellspacing="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr>
                  <td align="center" class="es-m-p0r es-m-p20b" style="padding:0;Margin:0;width:160px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/48_admin_google_product_logo_brand256.png" alt="" width="64" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#ffffff">Admin</h3></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px">
                       <ul style="font-family:arial, "helvetica neue", helvetica, sans-serif;padding:0px 0px 0px 40px;margin-top:15px;margin-bottom:15px">
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px;mso-margin-top-alt:15px">Can create accounts for Managers (if applicable).</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Cannot delete admin/manager accounts and can block user accounts</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Has limited access compared to Super Admin.</p></li>
                       </ul></td>
                     </tr>
                   </table></td>
                  <td class="es-hidden" style="padding:0;Margin:0;width:40px"></td>
                 </tr>
               </table><!--[if mso]></td><td style="width:160px" valign="top"><![endif]-->
               <table cellpadding="0" cellspacing="0" align="left" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr>
                  <td align="center" class="es-m-p20b" style="padding:0;Margin:0;width:160px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/menu2256.png" alt="" width="64" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#ffffff">Manager</h3></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px">
                       <ul style="font-family:arial, "helvetica neue", helvetica, sans-serif;padding:0px 0px 0px 40px;margin-top:15px;margin-bottom:15px">
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px;mso-margin-top-alt:15px">Can perform specific tasks assigned to them (e.g., manage users, view reports).</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Cannot create or delete accounts.</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Has the least access among the three roles.</p></li>
                       </ul></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td><td style="width:40px"></td><td style="width:160px" valign="top"><![endif]-->
               <table cellpadding="0" cellspacing="0" align="right" class="es-right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr>
                  <td align="center" style="padding:0;Margin:0;width:160px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/users256.png" alt="" width="64" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><h3 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#ffffff">User</h3></td>
                     </tr>
                     <tr>
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-top:10px">
                       <ul style="font-family:arial, "helvetica neue", helvetica, sans-serif;padding:0px 0px 0px 40px;margin-top:15px;margin-bottom:15px">
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px;mso-margin-top-alt:15px">Can view and edit their own user profile information</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Can reset their own password</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Can view and access assigned tasks and projects</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Cannot create, edit, or delete other users profiles</p></li>
                        <li style="color:#ffffff;margin:0px 0px 15px;font-size:14px"><p class="es-m-txt-l" style="Margin:0;mso-line-height-rule:exactly;mso-margin-bottom-alt:15px;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#ffffff;font-size:14px">Cannot access or modify system settings</p></li>
                       </ul></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellspacing="0" cellpadding="0" align="center" background class="es-footer" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr>
          <td align="center" bgcolor="#efefef" background="https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/g76e9b062eb3f7c42407ba47126da0ac24dddde996a98dc3375e6ce122323c6691e6afdf40f83d767d3719ef87230eae1_640.jpeg" style="padding:0;Margin:0;background-image:url(https://eloigio.stripocdn.email/content/guids/CABINET_fb2efccc0ab9d0d07d7ec0dd8aec6db5081f784ab312a8e53ca396fb807b967b/images/g76e9b062eb3f7c42407ba47126da0ac24dddde996a98dc3375e6ce122323c6691e6afdf40f83d767d3719ef87230eae1_640.jpeg);background-repeat:no-repeat;background-position:center;background-size:62% auto">
           <table align="center" cellpadding="0" cellspacing="0" class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;border:3px solid #00000000;width:600px" role="none">
             <tr>
              <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;padding-top:20px;padding-right:20px;padding-left:20px;background-color:#ffffff"><!--[if mso]><table style="width:560px" cellpadding="0" cellspacing="0"><tr><td style="width:242px" valign="top"><![endif]-->
               <table align="left" cellpadding="0" cellspacing="0" class="es-left" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left">
                 <tr>
                  <td align="left" class="es-m-p20b" style="padding:0;Margin:0;width:242px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="left" class="es-m-txt-c" style="padding:0;Margin:0;font-size:0px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/guids/23e908f6-00c4-408b-83f6-b5f51bbf8b8f/images/unifiedlgu3removebgpreview.png" alt="" width="100" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                     </tr>
                     <tr>
                      <td align="left" valign="top" height="113" class="h-auto es-text-8965" style="padding:0;Margin:0;padding-top:15px"><h5 class="es-m-txt-c" style="Margin:0;font-family:"merriweather sans", "helvetica neue", helvetica, arial, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:19px;font-style:normal;font-weight:normal;line-height:22.8px;color:#000000"><strong> Compliance &amp; Regulatory&nbsp;&nbsp;Management System </strong></h5></td>
                     </tr>
                     <tr>
                      <td align="left" class="es-m-txt-c es-m-p0r es-m-p20t" style="padding:0;Margin:0;padding-bottom:10px;padding-right:10px"><!--[if mso]><a href="https://crms.unifiedlgu.com" target="_blank" hidden>
	<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" esdevVmlButton href="https://crms.unifiedlgu.com" style="height:41px; v-text-anchor:middle; width:232px" arcsize="12%" stroke="f"  fillcolor="#62b6cb">
		<w:anchorlock></w:anchorlock>
		<center style="color:#ffffff; font-family:arial, "helvetica neue", helvetica, sans-serif; font-size:15px; font-weight:400; line-height:15px;  mso-text-raise:1px">Visit Site</center>
	</v:roundrect></a>
<![endif]--><!--[if !mso]><!-- --><span class="es-button-border-1729507268624 es-button-border msohide" style="border-style:solid;border-color:#2cb543;background:#62b6cb;border-width:0px;display:block;border-radius:5px;width:auto;mso-hide:all"><a href="https://crms.unifiedlgu.com" target="_blank" class="es-button msohide es-button-1729507268599" style="mso-style-priority:100 !important;text-decoration:none !important;mso-line-height-rule:exactly;color:#FFFFFF;font-size:18px;padding:10px 20px 10px 20px;display:block;background:#62b6cb;border-radius:5px;font-family:arial, helvetica neue, helvetica, sans-serif;font-weight:normal;font-style:normal;line-height:21.6px;width:auto;text-align:center;letter-spacing:0;mso-padding-alt:0;mso-border-alt:10px solid #62b6cb;mso-hide:all;padding-left:5px;padding-right:5px">Visit Site</a></span><!--<![endif]--></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td><td style="width:20px"></td><td style="width:292px" valign="top"><![endif]-->
               <table cellspacing="0" align="right" cellpadding="0" class="es-right" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right">
                 <tr>
                  <td align="left" style="padding:0;Margin:0;width:292px">
                   <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="left" style="padding:0;Margin:0;padding-top:20px"><h3 style="Margin:0;font-family:arial, "helvetica neue", helvetica, sans-serif;mso-line-height-rule:exactly;letter-spacing:0;font-size:20px;font-style:normal;font-weight:bold;line-height:24px;color:#333333">Official info</h3></td>
                     </tr>
                     <tr>
                      <td style="padding:0;Margin:0">
                       <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr class="links-images-left">
                          <td id="esd-menu-id-0" align="left" valign="top" width="100%" style="Margin:0;border:0;padding-bottom:7px;padding-top:10px;padding-right:5px;padding-left:5px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:none;font-family:arial, "helvetica neue", helvetica, sans-serif;display:block;color:#666666;font-size:14px"><img width="21" src="https://eloigio.stripocdn.email/content/guids/CABINET_2bacaf58048cb1918f88ffe5b8979b28/images/39781614763048410.png" alt="30 Commercial Road Fratton, Australia" title="Novaliches, Quezon City" align="absmiddle" style="display:inline !important;font-size:14px;border:0;outline:none;text-decoration:none;vertical-align:middle;padding-right:5px">Novaliches, Quezon City</a></td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr>
                      <td style="padding:0;Margin:0">
                       <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr class="links-images-left">
                          <td id="esd-menu-id-0" align="left" valign="top" width="100%" style="Margin:0;border:0;padding-bottom:7px;padding-top:7px;padding-right:5px;padding-left:5px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:none;font-family:arial, "helvetica neue", helvetica, sans-serif;display:block;color:#666666;font-size:14px"><img title="09479370421" align="absmiddle" width="20" src="https://eloigio.stripocdn.email/content/guids/CABINET_2bacaf58048cb1918f88ffe5b8979b28/images/95711614763048218.png" alt="1-888-452-1505" style="display:inline !important;font-size:14px;border:0;outline:none;text-decoration:none;vertical-align:middle;padding-right:5px">09479370421</a></td>
                         </tr>
                       </table></td>
                     </tr>
                     <tr>
                      <td class="es-m-p15b" style="padding:0;Margin:0">
                       <table cellpadding="0" cellspacing="0" width="100%" class="es-menu" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr class="links-images-left">
                          <td align="left" valign="top" width="100%" id="esd-menu-id-0" style="Margin:0;border:0;padding-bottom:10px;padding-top:7px;padding-right:5px;padding-left:5px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:none;font-family:arial, "helvetica neue", helvetica, sans-serif;display:block;color:#666666;font-size:14px"><img alt="Mon - Sat: 8am - 5pm, Sunday: CLOSED" title="Mon - Sat: 9am - 5pm, Sunday: CLOSED" align="absmiddle" width="20" src="https://eloigio.stripocdn.email/content/guids/CABINET_2bacaf58048cb1918f88ffe5b8979b28/images/97961614763048410.png" style="display:inline !important;font-size:14px;border:0;outline:none;text-decoration:none;vertical-align:middle;padding-right:5px">Mon - Sat: 9am - 5pm, Sunday: CLOSED</a></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table><!--[if mso]></td></tr></table><![endif]--></td>
             </tr>
             <tr>
              <td align="left" style="padding:20px;Margin:0">
               <table cellspacing="0" width="100%" cellpadding="0" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" valign="top" style="padding:0;Margin:0;width:554px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0;font-size:0">
                       <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                         <tr>
                          <td align="center" valign="top" style="padding:0;Margin:0;padding-right:25px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img title="Facebook" src="https://eloigio.stripocdn.email/content/assets/img/social-icons/logo-black/facebook-logo-black.png" alt="Fb" width="32" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                          <td align="center" valign="top" style="padding:0;Margin:0;padding-right:25px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img alt="X" width="32" title="X" src="https://eloigio.stripocdn.email/content/assets/img/social-icons/logo-black/x-logo-black.png" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                          <td align="center" valign="top" style="padding:0;Margin:0;padding-right:25px"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img src="https://eloigio.stripocdn.email/content/assets/img/social-icons/logo-black/instagram-logo-black.png" alt="Inst" width="32" title="Instagram" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                          <td align="center" valign="top" style="padding:0;Margin:0"><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px"><img title="Youtube" src="https://eloigio.stripocdn.email/content/assets/img/social-icons/logo-black/youtube-logo-black.png" alt="Yt" width="32" style="display:block;font-size:14px;border:0;outline:none;text-decoration:none"></a></td>
                         </tr>
                       </table></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table>
       <table cellpadding="0" cellspacing="0" align="center" class="es-footer" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:100%;table-layout:fixed !important;background-color:transparent;background-repeat:repeat;background-position:center top">
         <tr>
          <td align="center" style="padding:0;Margin:0">
           <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" class="es-footer-body" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
             <tr>
              <td align="left" style="padding:20px;Margin:0">
               <table cellpadding="0" cellspacing="0" width="100%" role="none" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                 <tr>
                  <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                     <tr>
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;line-height:21px;letter-spacing:0;color:#333333;font-size:14px">To ensure you receive all important updates and notifications, &nbsp;<br>to your contact list and check your spam or junk folders if you do not see our messages in your inbox.<br><br><a target="_blank" href="https://viewstripo.email" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px;line-height:21px">Privacy police</a> | <a target="_blank" style="mso-line-height-rule:exactly;text-decoration:underline;color:#666666;font-size:14px;line-height:21px" href="">Unsubscribe</a></p></td>
                     </tr>
                   </table></td>
                 </tr>
               </table></td>
             </tr>
           </table></td>
         </tr>
       </table></td>
     </tr>
   </table>
  </div>
 </body>
</html>
                                                                                                             
    ';

    $mail->send();
    $email = $_POST["email"];   

    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "success",
            title: "Account Created!",
            html: "Admin account created successfully. Credentials have been emailed to <strong>' . htmlspecialchars($email) . '</strong> for secure access.",
            showConfirmButton: true,
            confirmButtonText: "OK",
            allowOutsideClick: false,  // Prevent closing by clicking outside
            allowEscapeKey: false,      // Prevent closing by pressing Escape
            willClose: () => {
                // Clear all input fields manually
                document.querySelectorAll("#registrationForm input").forEach(input => input.value = "");
                window.location.href = "../../admin/account_mgmt/admin-account.php"; 
            }
        });
    });
    </script>';


}

?>