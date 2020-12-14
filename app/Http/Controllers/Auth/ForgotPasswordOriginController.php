<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\OriginController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordOriginController extends OriginController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset OriginController
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
}
