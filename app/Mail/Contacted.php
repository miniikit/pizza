<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

class Contacted extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * フォームで入力された値を取得
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * クロージャの部分
     */
    public function build()
    {
        return $this->view('mail.contact')
                    ->subject('お問い合わせ')
                    ->with([
                        'contact_name' => $this->request->name,
                        'contact_message' => $this->request->message
                    ]);
    }
}
