<?php

// require_once("../php/_mysql.php");



function get_emails($form_name)
{
	$email_addresses = array(
		"ben" => "bserrett@iu.edu",
		"stephanie" => "smcgavin@iu.edu",
		"iuni" => "iuni@indiana.edu"
	);

	$all_forms = array(
		"general_contact" => array("ben", "stephanie"),
    );
    
	if(!isset($all_forms[$form_name]))
		return false;

	$users = $all_forms[$form_name];
	$users[] = "ben";
	$emails = array();
	foreach($users as $user)
	{
		$emails[] = $email_addresses[$user];
	}

	return implode(", ", $emails);
}



$indiana_domains = array(
	"indiana.edu",
	"iub.edu",
	"iupui.edu",
	"iun.edu",
	"iue.edu",
	"ius.edu",
	"iu.edu",
	"iusb.edu",
	"iuk.edu",
	"iupuc.edu"
);


$internal_forms = array();

$public_but_cas = array();

$wos_forms = array();


$db_forms = array();

$all_forms = array(
	"general_contact" => "Contact Us",
	"newsletter" => "Newsletter Subscription",
);

$visible_forms = array(
	"general_contact",
	"newsletter"
);

$captcha_forms = array(
	// "general_contact",
	"hcp"
);



if(isset($_SESSION["user"]))
{
	$username = $_SESSION["user"];
}

$this_form = "home";
if(isset($_POST["form_name"]))
{
	$this_form = $_POST["form_name"];
}
else
{
	die("Unable to process form.  Your session may have timed out.  Please go back and try to submit again.");
}
$form_title = $all_forms[$this_form];





//for captcha form
if(in_array($this_form, $captcha_forms) )
{

    if(!isset($_POST["g-recaptcha-response"]))
    {
        die("There was a problem.  You may be a bot.  Please go back and try again.");
    }

    $ch = curl_init();
    $captcha = $_POST["g-recaptcha-response"];
    $opts = "secret=6LdmbkYUAAAAAMbGCig6Ldzgm5aCrmtHcAIjQX9a&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'];
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                $opts);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);

    $obj = json_decode($server_output);

    if($obj->success == true)
    {
        //passes test
    }
    else
    {
		header("HTTP/1.1 308 Permanent Redirect");
		header('Location: http://cadre.iu.edu', TRUE, 308);
		
    	die("There was a problem.  You may be a bot.  Please go back and try again.");
    }
}
























if(!empty($_POST))
{

    
    //honey pot
	if(isset($_POST["username"]) && ($_POST["username"] != ""))
	{
		header("HTTP/1.1 308 Permanent Redirect");
		header('Location: http://cadre.iu.edu', TRUE, 308);
		die("");
		// header("HTTP/1.1 418 I'm a teapot");
		// die("<img src='https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Utah_teapot_simple_2.png/1200px-Utah_teapot_simple_2.png' alt='teapot' />");
	}

	if(isset($_POST["username"]))
	{
		unset($_POST["username"]);
	}

	//
	// ######
	// #     #   ##   #####   ##   #####    ##    ####  ######
	// #     #  #  #    #    #  #  #    #  #  #  #      #
	// #     # #    #   #   #    # #####  #    #  ####  #####
	// #     # ######   #   ###### #    # ######      # #
	// #     # #    #   #   #    # #    # #    # #    # #
	// ######  #    #   #   #    # #####  #    #  ####  ######

	if(in_array($this_form, $db_forms) )
	{

	}

	// ######                            #######
	// #     # #    # # #      #####     #       #    #   ##   # #
	// #     # #    # # #      #    #    #       ##  ##  #  #  # #
	// ######  #    # # #      #    #    #####   # ## # #    # # #
	// #     # #    # # #      #    #    #       #    # ###### # #
	// #     # #    # # #      #    #    #       #    # #    # # #
	// ######   ####  # ###### #####     ####### #    # #    # # ######

	$to = "iuniform@iu.edu";
	if(!in_array($this_form, $visible_forms)){
		$to = "bserrett@iu.edu";
	}
	if(in_array($this_form, $wos_forms))
	{
		$to = "iuniwosd@indiana.edu";
	}


	$subject = $form_title . " Submission"  . " " . date("r");
	$random_hash = md5(date('r', time()));
	$headers = "From: CADRE Forms <iuniform+" . $this_form . "@iu.edu>";
	$headers .= "\r\nContent-Type: multipart/mixed; boundary=PHP-mixed-".$random_hash."";

	$body_text = "";
	$body_text .= "*" . $form_title . "* \n\n";

	foreach($_POST as $name => $value)
	{
		if($name == "form_name" || $name == "g-recaptcha-response")
		{
			continue;
		}
		if(!is_array($value))
		{
			$body_text .= "\n  " . str_replace("_", " ", $name) . ":\n";
			$body_text .= $value . "\n";
		}
		else
		{
			$body_text .= "\n" . str_replace("_", " ", $name) . ":\n";
			foreach($value as $name2 => $value2)
			{
				$body_text .= "    " . str_replace("_", " ", $name2) . ":  ";
				if(!is_array($value2))
				{
					$body_text .= $value2 . "\n";
				}
				else
				{
					foreach($value2 as $name3 => $value3)
					{
						$body_text .= "\n      " . str_replace("_", " ", $name3) . ":  ";
						$body_text .= $value3 . "";
					}
					$body_text .= "\n";
				}
			}
		}
	}

	if(count($_FILES))
	{

		$body_text .="\n\n Attachments:\n";
		foreach($_FILES as $k => $v)
		{
			if($v["name"] == "")
			{
				continue;
			}
			$pinfo = pathinfo($v["name"]);
			$ext = strtolower($pinfo['extension']);
			if($v["error"] || !($ext == "pdf" || $ext == "doc" || $ext == "docx" || $ext == "png" || $ext == "jpg" || $ext == "jpeg"))
			{
				$body_text .= "INVALID: ";
			}

			$body_text .= $v["name"] . "\n";
		}
	}

	$body_text = str_replace("<", "&lt;", $body_text);

	//ob_start();
	$message = "";
	$message .= "--PHP-mixed-".$random_hash."\r\n";
	$message .= "Content-Type: multipart/alternative; boundary=PHP-alt-". $random_hash ."\r\n";
	$message .= "\r\n";
	$message .= "--PHP-alt-".$random_hash."\r\n";
	$message .= "Content-Type: text/plain; charset=utf-8\r\n";
	$message .= "Content-Transfer-Encoding: 7bit\r\n";
	$message .= "\r\n";
	$message .= "".$body_text."\r\n";
	$message .= "\r\n";
	$message .= "--PHP-alt-". $random_hash."\r\n";
	$message .= "Content-Type: text/html; charset=utf-8\r\n";
	$message .= "Content-Transfer-Encoding: 7bit\r\n";
	$message .= "\r\n";
	$message .=  str_replace("  ", "&nbsp;&nbsp;&nbsp;", nl2br($body_text)) ."\r\n";
	$message .= "\r\n";
	$message .= "--PHP-alt-". $random_hash."--\r\n";

	foreach($_FILES as $k => $v)
	{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		if(empty($v["tmp_name"]) || $v["error"])
		{
			continue;
		}
		$type = finfo_file($finfo, $v["tmp_name"] );

		finfo_close($finfo);
		$pinfo = pathinfo($v["name"]);
		$ext = strtolower($pinfo['extension']);
		if(!($ext == "pdf" || $ext == "doc" || $ext == "docx" || $ext == "png" || $ext == "jpg" || $ext == "jpeg"))
		{
			continue;
		}


		$message .= "\r\n";
		$message .= "--PHP-mixed-". $random_hash . "\r\n";
		$message .= "Content-Type: ". $type . "\r\n";
		$message .= "Content-Transfer-Encoding: base64\r\n";
		$message .= "Content-Disposition: attachment; filename=" . $v["name"] . "\r\n";
		$message .= "\r\n";
		$message .= chunk_split(base64_encode(file_get_contents($v["tmp_name"]))) . "\r\n";

	}

	$message .= "\r\n";
	$message .= "--PHP-mixed-". $random_hash."--\r\n";
	$message .= "\r\n";



	//   #####                          #######
	//  #     # ###### #    # #####     #       #    #   ##   # #       ####
	//  #       #      ##   # #    #    #       ##  ##  #  #  # #      #
	//   #####  #####  # #  # #    #    #####   # ## # #    # # #       ####
	// 	      # #      #  # # #    #    #       #    # ###### # #           #
	//  #     # #      #   ## #    #    #       #    # #    # # #      #    #
	//   #####  ###### #    # #####     ####### #    # #    # # ######  ####


	$mail_sent = @mail($to, $subject, $message, $headers);
	$alternate_emails = get_emails($this_form);
	if($alternate_emails)
	{
		$alt_mail_sent = @mail($alternate_emails, $subject, $message, $headers);
	}

	//Also, send to requestors:
	if(isset($_POST["Requestor_Email"]))
	{
		$email_parts = explode('@', $_POST["Requestor_Email"]);

		if(in_array($this_form, $internal_forms) && !empty($_POST["Requestor_Email"]))
		{
			$requestor_mail = @mail($_POST["Requestor_Email"], "CADRE Form Confirmation: " . $subject, $message, $headers);
		}
		else if( in_array( strtolower(array_pop($email_parts)), $indiana_domains )  && !empty($_POST["Requestor_Email"]))
		{
			$requestor_mail = @mail($_POST["Requestor_Email"], "CADRE Form Confirmation: " . $subject, $message, $headers);
		}
		else if( !in_array( strtolower(array_pop($email_parts)), $indiana_domains )  && !empty($_POST["Requestor_Email"]))
		{
			$requestor_mail = @mail($_POST["Requestor_Email"], "CADRE Form Confirmation: " . $subject,
			"A submission from this email address has been made to a form on the CADRE website (https://cadre.iu.edu).  \n\nYour request will be reviewed by The Indiana University Network Science Institute and you will be contacted regarding your submission shortly.\n \n Sincerely, \n \n The CADRE Staff.", "From: CADRE Staff <iuniform+" . $this_form . "@iu.edu>"
			);
		}
	}


    $output = ""; 

	if($mail_sent)
	{
		// require("./success.php");
		$output .= '
<div class="alert alert-success">
    <div class="card-block"><div class="card-text">
        <i class="fa fa-check" aria-hidden="true"></i>
        Submission Successful
    </div></div>
</div>
		';


		setcookie("iuniform", "", time() - 3600);
	}
	else
	{
		$output .= '
<div class="alert alert-danger">
    <div class="card-block"><div class="card-text">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        Submission Failed
    </div></div>
</div>
		';
		// var_dump($mail_sent);
		// die();
		// require("./failure.php");
		// require("./form_layout.php");
	}

	$output .= '
<br />
    ' . nl2br($body_text) . '';
    
    return $output;

}
else
{
	die("Unable to process form.  Your session may have timed out.  Please go back and try to submit again.");
}

?>
