<?php

namespace App\Helpers;

class Mail
{
	public static function send($to, $subject, $message) {

		if (empty($to) || empty($subject) || empty($message)) return;

		$server_name = $_SERVER['SERVER_NAME'];
		$from = "info@".$server_name;

		//$subject = "=?utf-8?B?".base64_encode($subject)."?= \n";
		//$from = "=?utf-8?B??={$from}";

		$send = mail($to, $subject, $message,
			"Content-type: text/html; charset=utf-8\r\n".
			"From: {$from}\r\n"
		);

		return $send;
	}
}

?>
