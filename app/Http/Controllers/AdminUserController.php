<?php

namespace App\Http\Controllers;

use App\Mail\PmrgWeb;
use App\Support\Cropper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\User as UserRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->admin == 1 ) {
            $users = User::where('ativo', 1)->get();
            return view('admin.users.index', ['users' => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->admin == 1 ) {
            return view('admin.users.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( UserRequest $request)
    {
        if (Auth::user()->admin == 1 ) {
            $user = new User();

            $user->password = Hash::make($request['password']);
            $user->setAdminAttribute($request->admin);
            $user->setAtivoAttribute($request->ativo);
            $user->setPenalAttribute($request->penal);
            $user->setLaborAttribute($request->labor);
            $user->setJuridicaAttribute($request->juridica);
            $user->setPjmdAttribute($request->pjmd);
            $user->setEscoltaAttribute($request->escolta);
            $user->setGuardaAttribute($request->guarda);
            $user->setNapsAttribute($request->naps);
            $user->setUisAttribute($request->uis);
            $user->setUgeAttribute($request->uge);
            $user->setP1Attribute($request->p1);
            $user->setP2Attribute($request->p2);
            $user->setP4Attribute($request->p4);
            $user->setP5Attribute($request->p5);
            $user->foto = url(asset('backend/assets/images/avatar.jpg'));

            $user->fill($request->all());

            if (!empty($request->file('foto'))) {
                Storage::delete($user->foto);
                $user->foto = $request->file('foto')->store('user');
            }

            $user->save();

            Mail::send(new PmrgWeb($user));

            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->admin == 1 ) {
            $user = User::where('id', $id)->first();
            return view('admin.users.edit', ['user' => $user]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        if (Auth::user()->admin == 1 ) {
            $user = User::where('id', $id)->first();
            $user->setAdminAttribute($request->admin);
            $user->setAtivoAttribute($request->ativo);
            $user->setPenalAttribute($request->penal);
            $user->setLaborAttribute($request->labor);
            $user->setJuridicaAttribute($request->juridica);
            $user->setPjmdAttribute($request->pjmd);
            $user->setEscoltaAttribute($request->escolta);
            $user->setGuardaAttribute($request->guarda);
            $user->setNapsAttribute($request->naps);
            $user->setUisAttribute($request->uis);
            $user->setUgeAttribute($request->uge);
            $user->setP1Attribute($request->p1);
            $user->setP2Attribute($request->p2);
            $user->setP4Attribute($request->p4);
            $user->setP5Attribute($request->p5);

            if (!empty($request->file('foto'))) {
                Storage::delete($user->foto);
                Cropper::flush($user->foto);
                $user->foto = '';
            }

            $user->fill($request->all());

            if (!empty($request->file('foto'))) {
                Storage::delete($user->foto);
                $user->foto = $request->file('foto')->storeAs('user/' . $user->re, $request->file('foto')->getClientOriginalName());
            }

            $user->save();

            if (!$user->save()) {
                return redirect()->back()->withInput()->withErrors();
            }
            return redirect()->route('users.edit', ['user' => $user->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->admin == 1 ) {
            User::where('id', $id)->delete();
//        Storage::deleteDirectory('user/'. $anamnese);
            return redirect()->route('users.index')->with(['color' => 'green', 'message' => 'Usuário deletado!']);
        }
    }
}
