<?php

namespace App\Http\Controllers;

use App\Advogados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvogadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advogados = Advogados::all();
        return view('admin.penal.advogados.index',['advogados'=>$advogados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($interno)
    {
        if (Auth::user()->penal == 1 ) {
            return view('admin.penal.advogados.create', ['interno' => $interno]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->penal == 1 ) {
            $advogado = Advogados::create($request->all());
            $advogado->save();

            return redirect()->route('advogados.edit', ['advogado' => $advogado->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);

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
        if (Auth::user()->penal == 1 ) {
            $advogado = Advogados::where('id', $id)->first();
            return view('admin.penal.advogados.edit', ['advogado' => $advogado]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->penal == 1 ) {
            $advogado = Advogados::where('id', $id)->first();
            $advogado->fill($request->all());
            $advogado->save();

            return redirect()->route('advogados.edit', ['advogado' => $advogado])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->penal == 1 ) {
            Advogados::where('id', $id)->delete();
            return redirect()->route('advogados.index')->with(['color' => 'green', 'message' => 'Interno deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
