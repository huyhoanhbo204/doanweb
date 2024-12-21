<?php

    namespace App\Mail;

    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Mail\Mailable;
    use Illuminate\Queue\SerializesModels;

    class ActivationMail extends Mailable
    {
        use Queueable, SerializesModels;

        public $user;

        /**
         * Create a new message instance.
         */
        public function __construct(User $user)
        {
            $this->user = $user;
        }

        /**
         * Build the message.
         */
        public function build()
        {
            return $this->subject('Kích hoạt tài khoản')
                ->view('emails.activation')
                ->with([
                    'activationUrl' => route('user.activate', ['email' => $this->user->email]),
                ]);
        }
    }
