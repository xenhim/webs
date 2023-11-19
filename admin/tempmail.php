<?php
	/**
	 * Credit : https://temp-mail.io/en
	 */
	class TempMail {
		public function __construct() {
			$this->Handle();
		}

		public function Handle() {
			$this->id = [];
			$email = $this->GenMail();
			$this->Logo($email['email']);
			while (true) {
				$o = $this->GetMail($email['email']);
				foreach ($o as $n) {
					if (!in_array($n['id'], $this->id)) {
						$this->PrintMail($n);
						$this->id[] = $n['id'];
					}
				}
				sleep(2);
			}
		}

		public function Logo($email) {
			$o = $email;
			$add = intval((50 - strlen($o)) / 2);
			$o = str_repeat(' ', $add) . $o . str_repeat(' ', $add);
			$logo = "\t\t\t╔════════════════════════════════════════════════════╗\n\t\t\t║" . str_pad($o, 50, " ", STR_PAD_BOTH) . "║\n\t\t\t╚════════════════════════════════════════════════════╝\n\n";
			echo $logo;
		}

		public function GenMail() {
			$url = 'https://api.internal.temp-mail.io/api/v2/email/new';
			$data = ["min_name_length" => 8, "max_name_length" => 24];
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			$r = curl_exec($ch);
			curl_close($ch);
			return json_decode($r, true);
		}

		public function GetMail($email) {
			$url = "https://api.internal.temp-mail.io/api/v2/email/$email/messages";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$r = curl_exec($ch);
			curl_close($ch);
			return json_decode($r, true);
		}

		public function PrintMail($mail) {
			echo "From: {$mail['from']}\nCC: {$mail['cc']}\nSubject: {$mail['subject']}\nDate: {$mail['created_at']}\nBody: {$mail['body_text']}\n";
			echo "-----------------END-----------------\n";
		}
	}

	new TempMail();