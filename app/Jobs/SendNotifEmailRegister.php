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

class SendNotifEmailRegister implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	private $email;
	public function __construct($email)
	{
		$this->email = $email;
		// $this->nama_siswa = $nama_siswa;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// $email = $this->email;
		// $nama_siswa = $this->nama_siswa;

		// dd($this->email);

		$message = view('ppdb.email_daftar')->render();
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

		// return 'dds';
	}
}
