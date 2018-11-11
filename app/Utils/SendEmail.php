<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 11/11/2018
 * Time: 18:12
 */

namespace App\Utils;


use App\User;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    protected $mail_from = '';
    protected $mail_admin = '';
    protected $TYPE = 'CONVIDA';
    const TPL_USER_CREATE = 'Emails.Auth.create_user';

    function __construct()
    {
        $this->mail_from = env('MAIL_FROM');
        $this->mail_admin = env('MAIL_ADMIN');
        $TYPE = env('TYPE');
    }

    public function sendUserPass($to, User $user)
    {
        $data = array(
            'type' => $this->TYPE,
            'user' => $user,
            'title' => 'Seja Bem vindo'
        );

        Mail::send(self::TPL_USER_CREATE, $data, function ($message) use ($to, $user) {
            $message->to($to, $user->email)->subject('Bem vindo - Dados de Acesso');

            $message->from($this->mail_from,
                $this->TYPE == 'CONVIDA' ? 'Convida' : 'Clube de Vantagens'
            );
        });

    }
}
