<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use SendsPasswordResetEmails;

    public function register(Request $request)
    {
        request()->validate([
            'name' => ['required'],
            'email' => ['email', 'required', 'unique:users,email'],
            'no_handphone' => ['string', 'required', 'min:6'],
            'password' => ['required', 'min:6'],
            'address' => ['required']
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'no_handphone' => request('no_handphone'),
            'password' => bcrypt(request('password')),
            'address' => request('address'),
        ]);

        return response()->json([
            'message' => 'Anda Berhasil Registrasi'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

    
        if(!$token = Auth::attempt($request->only('email', 'password'))) {
            return response(null, 401);
        }

        return response()->json([
            'token' => $token,
            'message' => 'Berhasil Login'
        ]);
    }

    public function forgotpassword(Request $request) 
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(["msg" => 'Sihlakan Cek Gmail Anda']);
     }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        $data['email'] = trans($response);
        return response()->json(["msg" => 'Reset password link sent on your email id.', $data]);

    }
}
