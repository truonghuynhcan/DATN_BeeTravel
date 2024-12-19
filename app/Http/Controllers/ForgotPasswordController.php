<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
{
    return view('client.forgot-password');
}

public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

  
    $response = $this->broker()->sendResetLink(
        $this->credentials($request)
    );

    return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($request, $response)
                : $this->sendResetLinkFailedResponse($request, $response);
}
}