<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendNotifEmailLulus implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $email;
	public function __construct($email)
	{
		$this->email = $email;
		// $this->nama_siswa = $nama_siswa;
	}

	public function handle()
	{
		$email = $this->email;
		$message = view('ppdb.email_daftar_lulus', compact('email'))->render();
		try {
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host = 'mail.anandadimmas.my.id ';
			$mail->SMTPAuth = true;
			$mail->Username = 'anandadimmasbudiarto@anandadimmas.my.id';
			$mail->Password = '~z[uV+P*2S4I';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom("anandadimmas@anandadimmas.my.id", "Surat Pemberitahuan");
			$mail->addAddress($this->email);
			$mail->isHTML(true);
			$mail->Subject = 'Surat Pemberitahuan';
			$mail->Body    = $message;
			$mail->send();
		} catch (Exception $e) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}
