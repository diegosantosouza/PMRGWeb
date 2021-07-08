<?php

namespace App\Http\Controllers;

use App\Alojamentos;
use App\Comportamento;
use App\Interno;
use App\Support\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function inicio()
    {
        if (Auth::check() === true) {
            if (Auth::user(['ativo' => 1]) ){
                $internos = Interno::with(['comportamento'])->withCount(['comportamento'])->get();
                $ultimosInternos = Interno::latest()->take(10)->get();
                $alojamentos = Alojamentos::all();
                $comportamentos = Comportamento::all();
                return view('admin.inicio', ['internos'=>$internos, 'alojamentos'=>$alojamentos, 'comportamentos'=>$comportamentos, 'ultimosInternos'=>$ultimosInternos]);
            }
        }

    }
    public function dashboard()
    {
        if (Auth::check() === true) {
            if (Auth::user()->admin == 1 ){
            $users = User::all();
            return view('admin.dashboard',['users'=>$users]);
            }
            return redirect()->route('admin.inicio');
        }
    }

    public function showLoginForm()
    {
        $versao= env('APP_VERSION');
        $desenvolvedor= env('APP_DEVELOPER');
        return view('admin.formLogin', ['versao'=>$versao, 'desenvolvedor'=>$desenvolvedor]);
    }

    public function login(Request $request)
    {
        if (in_array('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Informe todos os dados para efetuar o login')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Informe um e-mail válido')->render();
            return response()->json($json);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1, 'admin' => 1])) {
            $json['redirect'] = route('admin');
            return response()->json($json);
        }elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1])) {
            $json['redirect'] = route('admin.inicio');
            return response()->json($json);
        }elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => null])){
            $json['message'] = $this->message->error('Usuário aguardando aprovação')->render();
            return response()->json($json);
        }else{
            $json['message'] = $this->message->error('Usuário e senha incorretos')->render();
            return response()->json($json);
        }

    }

    public function registerForm()
    {
        $versao= env('APP_VERSION');
        $desenvolvedor= env('APP_DEVELOPER');
        return view('admin.formRegister', ['versao'=>$versao, 'desenvolvedor'=>$desenvolvedor]);
    }

    public function resetPassword()
    {
        $versao= env('APP_VERSION');
        $desenvolvedor= env('APP_DEVELOPER');
        return view('admin.mail.mailReset', ['versao'=>$versao, 'desenvolvedor'=>$desenvolvedor]);
    }

    public function resetPasswordDo()
    {
        return view('admin.mail.resetPassword');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
