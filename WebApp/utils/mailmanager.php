<?php
/*
 @ugoabuchi - @my github repo github.com/ugoabuchi
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'composer/vendor/autoload.php';
class mailmanager
{
    private $host = null;
    private $username = null;
    private $password = null;
    private $port = null;
    
    function __construct($host, $port, $username, $password){
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
   
    }
   
    public function send_mail_no_reply(
            $reciepient,  
            $reciepient_name,
            $subject,
            $body,
            $sender_name = "Dana Group",
            $sender_domain = "danagroup.com"
            ){
        
        $mail = new PHPMailer(); //Argument true in constructor enables exceptions
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = SMTP::DEBUG_OFF;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->Username   = $this->username;
        $mail->Password   = $this->password;
        $mail->IsHTML(true);
        $mail->AddAddress($reciepient, $reciepient_name);
        $mail->setFrom($this->username, $sender_name);
        $mail->addReplyTo("no-reply@".$sender_domain, $sender_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        //$mail->addAttachment($attachment);
        try {
            $mail->send();
        } catch (Exception $e) {
        }

        
    }
    
    
    public function send_mail_with_reply(
            $reciepient,  
            $reciepient_name,
            $subject,
            $body,
            $sender_name = "Dana Group - HR",
            $attachment = "https://career.danagroup.com/WebApp/HR/career/DGC-logo.png",
            $sender_hosting_email = "vacancies@danagroup.com"
            ){
        
        $mail = new PHPMailer(); //Argument true in constructor enables exceptions
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->Username   = $this->username;
        $mail->Password   = $this->password;
        
        $mail->IsHTML(true);
        $mail->AddAddress($reciepient, $reciepient_name);
        $mail->setFrom($this->username, $sender_name);
        $mail->addReplyTo($sender_hosting_email, $sender_name);
        $mail->addEmbeddedImage("https://career.danagroup.com/WebApp/HR/career/DGC-logo.png", "logoid", "logo.png");
        $mail->Subject = $subject;
        $mail->Body = $body;
        //$mail->addAttachment($attachment);
        try {
            $mail->send();
            
        } catch (Exception $e) {
            
        }

        
    }


    public function careerJobAppliedSeeker($applicantName, $jobPosition, $subSidiary){

      return '

      <!DOCTYPE html>
      <html>
      
      <head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          
      </head>
      
      <body style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #ffffff; height: 100%; width: 100%; margin: 0; padding: 0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
              <!-- LOGO -->
              
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 0px 5px 0px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <br><img src="https://career.danagroup.com/WebApp/HR/career/DGC-logo.png" width="80" height="50" style="-ms-interpolation-mode: bicubic; height: auto; outline: none; text-decoration: none; display: block; border: 0px;">
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 5px 0px 5px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 0px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                 
      
      
      
      
      
      
      
      
      
      
      
                              <!DOCTYPE html><html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><style>
                              *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:720px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
                              </style></head><body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#2f3390;background-image:url(https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/blue-04.png);background-repeat:no-repeat;background-size:auto"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#1F3A68;color:#000;width:700px;margin:0 auto" width="700"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:10px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0"><table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#fff;line-height:1.2"><p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:30px;"><strong>Hello '.$applicantName.'</strong></span></p></div></div></td></tr></table><table 
                              class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#d8ebf8;line-height:1.5"><p 
                              style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">Thank you for applying for the '.$jobPosition.' </span>position at '.$subSidiary.'.</p><p style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">We have recieved your application and will review it thoroughly.<br>We appreciate your interest in joining our team, we will be in touch with you soon.</span></p></div></div></td></tr></table><table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" 
                              role="presentation" style="mso-table-lspace:0;mso-table-rspace:0"><tr><td class="pad" style="padding-bottom:50px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center"><div class="alignment" align="center"><!--[if mso]>
                              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://danagroup.com" style="height:48px;width:182px;v-text-anchor:middle;" arcsize="63%" stroke="false" fillcolor="#ee2326">
                              <w:anchorlock/>
                              <v:textbox inset="0px,0px,0px,0px">
                              <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                              <![endif]-->
                              <a href="https://danagroup.com" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ee2326;border-radius:30px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:8px;padding-bottom:8px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;"><strong>Explore Dana</strong></span></span></a>
                              <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --><div style="background-color:transparent;">
                                  <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
                                          <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                                          <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                              <div style="background-color: transparent; width: 100% !important;">
                                                  <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                                      <!--<![endif]-->
                              
                              
                                                     
                              
                              
                                                      <!--[if (!mso)&(!IE)]><!-->
                                                  </div><!--<![endif]-->
                                              </div>
                                          </div>
                                          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                      </div>
                                  </div>
                              </div></body></html>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
                              </td>
                          </tr>
                          
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <p style="margin: 0;">Dana Group Team | Career<br>© Copyright '.date('Y').'</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #00B7EC; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <h2 style="font-size: 20px; font-weight: 400; color: #000000; margin: 0;">Need more help?</h2>
                                  <p color="#00B7EC" style="margin: 0; color: #00B7EC;">hr@danagroup.com | career@danagroup.com</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #ffffff; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                                  <p style="margin: 0;color: #ffffff;">If you feel this email was not triggered by you, feel free to ignore.</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
      
      
      
      ';
    }
    
    






    public function careerTalentHuntSeeker($applicantName, $jobPosition){

        return '
  
        <!DOCTYPE html>
        <html>
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            
        </head>
        
        <body style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #ffffff; height: 100%; width: 100%; margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                <!-- LOGO -->
                
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 0px 5px 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                  <br><img src="https://career.danagroup.com/WebApp/HR/career/DGC-logo.png" width="80" height="50" style="-ms-interpolation-mode: bicubic; height: auto; outline: none; text-decoration: none; display: block; border: 0px;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 5px 0px 5px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 0px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                   
        
        
        
        
        
        
        
        
        
        
        
                                <!DOCTYPE html><html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><style>
                                *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:720px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
                                </style></head><body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;background-color:#2f3390;background-image:url(https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/blue-04.png);background-repeat:no-repeat;background-size:auto"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;background-color:#1F3A68;color:#000;width:700px;margin:0 auto" width="700"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:10px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0"><table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#fff;line-height:1.2"><p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:30px;"><strong>Hello '.$applicantName.'</strong></span></p></div></div></td></tr></table><table 
                                class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#d8ebf8;line-height:1.5"><p 
                                style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">Thank you for applying for the Talent Hunt position of '.$jobPosition.' </span>.</p><p style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">We have recieved your application and will review it thoroughly.<br>We appreciate your interest in joining our team, we will be in touch with you as sonn as the position is open.</span></p></div></div></td></tr></table><table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" 
                                role="presentation" style="mso-table-lspace:0;mso-table-rspace:0"><tr><td class="pad" style="padding-bottom:50px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center"><div class="alignment" align="center"><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://danagroup.com" style="height:48px;width:182px;v-text-anchor:middle;" arcsize="63%" stroke="false" fillcolor="#ee2326">
                                <w:anchorlock/>
                                <v:textbox inset="0px,0px,0px,0px">
                                <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                                <![endif]-->
                                <a href="https://danagroup.com" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ee2326;border-radius:30px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:8px;padding-bottom:8px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;"><strong>Explore Dana</strong></span></span></a>
                                <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --><div style="background-color:transparent;">
                                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
                                            <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                                            <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                                <div style="background-color: transparent; width: 100% !important;">
                                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                                        <!--<![endif]-->
                                
                                
                                                       
                                
                                
                                                        <!--[if (!mso)&(!IE)]><!-->
                                                    </div><!--<![endif]-->
                                                </div>
                                            </div>
                                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                        </div>
                                    </div>
                                </div></body></html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
                                </td>
                            </tr>
                            
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0;">Dana Group Team | Career<br>© Copyright '.date('Y').'</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #00B7EC; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <h2 style="font-size: 20px; font-weight: 400; color: #000000; margin: 0;">Need more help?</h2>
                                    <p color="#00B7EC" style="margin: 0; color: #00B7EC;">hr@danagroup.com | career@danagroup.com</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #ffffff; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                                    <p style="margin: 0;color: #ffffff;">If you feel this email was not triggered by you, feel free to ignore.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>
        
        
        
        ';
        

    }





    public function careerTalentHuntOpened($applicantName, $Position){

        return '
  
        <!DOCTYPE html>
        <html>
        
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            
        </head>
        
        <body style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #ffffff; height: 100%; width: 100%; margin: 0; padding: 0;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
                <!-- LOGO -->
                
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 0px 5px 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                  <br><img src="https://career.danagroup.com/WebApp/HR/career/DGC-logo.png" width="80" height="50" style="-ms-interpolation-mode: bicubic; height: auto; outline: none; text-decoration: none; display: block; border: 0px;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 5px 0px 5px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 0px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                   
        
        
        
        
        
        
        
        
        
        
        
                                <!DOCTYPE html><html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><style>
                                *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:720px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
                                </style></head><body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;background-color:#2f3390;background-image:url(https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/blue-04.png);background-repeat:no-repeat;background-size:auto"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;background-color:#1F3A68;color:#000;width:700px;margin:0 auto" width="700"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:10px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0"><table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                                style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#fff;line-height:1.2"><p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:30px;"><strong>Hello '.$applicantName.'</strong></span></p></div></div></td></tr></table><table 
                                class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#d8ebf8;line-height:1.5"><p 
                                style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">We are glad to inforn you that the position of '.$Position.' </span> is now open.</p><p style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">Kindly visit https://career.danagroup.com or click the button below to view this job opening.<br>We appreciate your interest in joining our team.</span></p></div></div></td></tr></table><table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" 
                                role="presentation" style="mso-table-lspace:0;mso-table-rspace:0"><tr><td class="pad" style="padding-bottom:50px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center"><div class="alignment" align="center"><!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://danagroup.com" style="height:48px;width:182px;v-text-anchor:middle;" arcsize="63%" stroke="false" fillcolor="#ee2326">
                                <w:anchorlock/>
                                <v:textbox inset="0px,0px,0px,0px">
                                <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                                <![endif]-->
                                <a href="https://career.danagroup.com" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ee2326;border-radius:30px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:8px;padding-bottom:8px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;"><strong>View Job Openings</strong></span></span></a>
                                <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --><div style="background-color:transparent;">
                                    <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                                        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
                                            <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                                            <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                                <div style="background-color: transparent; width: 100% !important;">
                                                    <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                                        <!--<![endif]-->
                                
                                
                                                       
                                
                                
                                                        <!--[if (!mso)&(!IE)]><!-->
                                                    </div><!--<![endif]-->
                                                </div>
                                            </div>
                                            <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                        </div>
                                    </div>
                                </div></body></html>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
                                </td>
                            </tr>
                            
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0;">Dana Group Team | Career<br>© Copyright '.date('Y').'</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #00B7EC; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <h2 style="font-size: 20px; font-weight: 400; color: #000000; margin: 0;">Need more help?</h2>
                                    <p color="#00B7EC" style="margin: 0; color: #00B7EC;">hr@danagroup.com | career@danagroup.com</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                            <tr>
                                <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #ffffff; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                                    <p style="margin: 0;color: #ffffff;">If you feel this email was not triggered by you, feel free to ignore.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        
        </html>
        
        
        
        ';
        

    }











    
    
        public function careerJobRejected($applicantName, $jobPosition, $subSidiary){

      return '

      <!DOCTYPE html>
      <html>
      
      <head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          
      </head>
      
      <body style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #ffffff; height: 100%; width: 100%; margin: 0; padding: 0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
              <!-- LOGO -->
              
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 0px 5px 0px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <br><img src="https://career.danagroup.com/WebApp/HR/career/DGC-logo.png" width="80" height="50" style="-ms-interpolation-mode: bicubic; height: auto; outline: none; text-decoration: none; display: block; border: 0px;">
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 5px 0px 5px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 0px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                 
      
      
      
      
      
      
      
      
      
      
      
                              <!DOCTYPE html><html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><style>
                              *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:720px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
                              </style></head><body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#2f3390;background-image:url(https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/blue-04.png);background-repeat:no-repeat;background-size:auto"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#1F3A68;color:#000;width:700px;margin:0 auto" width="700"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:10px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0"><table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#fff;line-height:1.2"><p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:30px;"><strong>Dear '.$applicantName.'</strong></span></p></div></div></td></tr></table><table 
                              class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#d8ebf8;line-height:1.5"><p 
                              style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">Thank you once again for applying for the '.$jobPosition.' </span>position at '.$subSidiary.'.</p><p style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">We have reviewed your application thoroughly and appreciate the time you took to share your details with us.<br>After careful consideration, we regret to inform you that we have decided to move forward with other candidates whose qualifications more closely match the requirements of this role.<br>We appreciate your interest in joining our team and encourage you to apply for future openings that align with your skills and experience. You can keep an eye on our career page for any upcoming opportunities.</span></p></div></div></td></tr></table><table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" 
                              role="presentation" style="mso-table-lspace:0;mso-table-rspace:0"><tr><td class="pad" style="padding-bottom:50px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center"><div class="alignment" align="center"><!--[if mso]>
                              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://danagroup.com" style="height:48px;width:182px;v-text-anchor:middle;" arcsize="63%" stroke="false" fillcolor="#ee2326">
                              <w:anchorlock/>
                              <v:textbox inset="0px,0px,0px,0px">
                              <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                              <![endif]-->
                              <a href="https://danagroup.com" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ee2326;border-radius:30px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:8px;padding-bottom:8px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;"><strong>Explore Dana</strong></span></span></a>
                              <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --><div style="background-color:transparent;">
                                  <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
                                          <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                                          <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                              <div style="background-color: transparent; width: 100% !important;">
                                                  <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                                      <!--<![endif]-->
                              
                              
                                                     
                              
                              
                                                      <!--[if (!mso)&(!IE)]><!-->
                                                  </div><!--<![endif]-->
                                              </div>
                                          </div>
                                          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                      </div>
                                  </div>
                              </div></body></html>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
                              </td>
                          </tr>
                          
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <p style="margin: 0;">Dana Group Team | Career<br>© Copyright '.date('Y').'</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #00B7EC; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <h2 style="font-size: 20px; font-weight: 400; color: #000000; margin: 0;">Need more help?</h2>
                                  <p color="#00B7EC" style="margin: 0; color: #00B7EC;">hr@danagroup.com | career@danagroup.com</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #ffffff; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                                  <p style="margin: 0;color: #ffffff;">If you feel this email was not triggered by you, feel free to ignore.</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
      
      
      
      ';
    }
    
    
    
    
    public function careerJobShortlisted($applicantName, $jobPosition, $subSidiary){

      return '

      <!DOCTYPE html>
      <html>
      
      <head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          
      </head>
      
      <body style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; background-color: #ffffff; height: 100%; width: 100%; margin: 0; padding: 0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse;">
              <!-- LOGO -->
              
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 0px 5px 0px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" valign="top" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                <br><img src="https://career.danagroup.com/WebApp/HR/career/DGC-logo.png" width="80" height="50" style="-ms-interpolation-mode: bicubic; height: auto; outline: none; text-decoration: none; display: block; border: 0px;">
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0px 5px 0px 5px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 0px; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                 
      
      
      
      
      
      
      
      
      
      
      
                              <!DOCTYPE html><html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en"><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><style>
                              *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:720px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
                              </style></head><body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none"><table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff"><tbody><tr><td><table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#2f3390;background-image:url(https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/0db9f180-d222-4b2b-9371-cf9393bf4764/0bd8b69e-4024-4f26-9010-6e2a146401fb/blue-04.png);background-repeat:no-repeat;background-size:auto"><tbody><tr><td><table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#1F3A68;color:#000;width:700px;margin:0 auto" width="700"><tbody><tr><td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-top:10px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0"><table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:14.399999999999999px;color:#fff;line-height:1.2"><p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:30px;"><strong>Dear '.$applicantName.'</strong></span></p></div></div></td></tr></table><table 
                              class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word"><tr><td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px"><div style="font-family:sans-serif"><div class style="font-size:12px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif;mso-line-height-alt:18px;color:#d8ebf8;line-height:1.5"><p 
                              style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">Thank you once again for applying for the '.$jobPosition.' </span>position at '.$subSidiary.'.</p><p style="margin:0;font-size:14px;mso-line-height-alt:24px;text-align: justify;text-justify: inter-word"><span style="font-size:16px;">We have reviewed your application and are pleased to inform you that your qualifications and experiences align with the requirements of this role.<br>A member of our team will be in touch with you soon to discuss the next steps.<br>Thank you for considering this opportunity with '.$subSidiary.'.</span></p></div></div></td></tr></table><table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" 
                              role="presentation" style="mso-table-lspace:0;mso-table-rspace:0"><tr><td class="pad" style="padding-bottom:50px;padding-left:10px;padding-right:10px;padding-top:30px;text-align:center"><div class="alignment" align="center"><!--[if mso]>
                              <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://danagroup.com" style="height:48px;width:182px;v-text-anchor:middle;" arcsize="63%" stroke="false" fillcolor="#ee2326">
                              <w:anchorlock/>
                              <v:textbox inset="0px,0px,0px,0px">
                              <center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px">
                              <![endif]-->
                              <a href="https://danagroup.com" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ee2326;border-radius:30px;width:auto;border-top:0px solid transparent;font-weight:undefined;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:8px;padding-bottom:8px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:40px;padding-right:40px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 32px;"><strong>Explore Dana</strong></span></span></a>
                              <!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div></td></tr></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table><!-- End --><div style="background-color:transparent;">
                                  <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
                                      <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="background-color:transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width: 500px;"><tr class="layout-full-width" style="background-color:transparent;"><![endif]-->
                                          <!--[if (mso)|(IE)]><td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><![endif]-->
                                          <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                                              <div style="background-color: transparent; width: 100% !important;">
                                                  <!--[if (!mso)&(!IE)]><!--><div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                                                      <!--<![endif]-->
                              
                              
                                                     
                              
                              
                                                      <!--[if (!mso)&(!IE)]><!-->
                                                  </div><!--<![endif]-->
                                              </div>
                                          </div>
                                          <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                                      </div>
                                  </div>
                              </div></body></html>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
                              </td>
                          </tr>
                          
                          <tr>
                              <td bgcolor="#ffffff" align="left" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #666666; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <p style="margin: 0;">Dana Group Team | Career<br>© Copyright '.date('Y').'</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; padding: 10px 10px 10px 0px; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#ffffff" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #00B7EC; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                  <h2 style="font-size: 20px; font-weight: 400; color: #000000; margin: 0;">Need more help?</h2>
                                  <p color="#00B7EC" style="margin: 0; color: #00B7EC;">hr@danagroup.com | career@danagroup.com</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px 10px 10px 10px;">
                      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; max-width: 600px; border-collapse: collapse;">
                          <tr>
                              <td bgcolor="#1F3A68" align="center" style="-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #ffffff; font-family: "Lato", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400;">
                                  <p style="margin: 0;color: #ffffff;">If you feel this email was not triggered by you, feel free to ignore.</p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
      
      
      
      ';
    }
    
    
}

