<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail()
    {
        request()->validate([
            'email' => ['required', 'email'],
            // 'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        $user = User::where('email', request()->email)->first();

        if ($user != null) {
            $verify_user = VerifyUser::create([
                'user_id' => $user->id,
                'token'   => \Str::random(40),
                'scope'   => VerifyUser::SCOPE_RESET_PASSWORD,
            ]);

            Mail::to($user)->send(new ResetPassword($user, $verify_user->token));
        }

        return redirect()->route('password.request')
            ->with('success', 'Des instructions viennent de t\'être envoyées par email. Si t\'as rien reçu dans 10 minutes, vérifies dans tes spams');
    }
}
