<?php

namespace App\Http\Controllers;

use App\Artigos;
use App\Estado;
use App\Interno;
use App\Processos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Processos as ProcessosRequest;
use Illuminate\Support\Facades\Auth;


class ProcessosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processos = Processos::with('interno')->get();
        return view('admin.penal.processos.index', ['processos'=>$processos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($interno)
    {
        if (Auth::user()->penal == 1 ) {
            $interno = Interno::where('id', $interno)->first();
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            return view('admin.penal.processos.create', ['interno' => $interno, 'estados' => $estados]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessosRequest  $request)
    {
        if (Auth::user()->penal == 1 ) {
            $processo = new Processos();
            $processo->fill($request->all());
            $processo->save();
            if (!$processo->save()) {
                return redirect()->back()->withInput()->withErrors();
            }
            return redirect()->route('processos.edit',['processo'=>$processo->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
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
        $processo= Processos::where('id', $id)->first();
        return view('admin.penal.processos.show', ['processo'=>$processo]);
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
            $processo = Processos::where('id', $id)->first();
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            return view('admin.penal.processos.edit', ['processo' => $processo, 'estados' => $estados]);
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
    public function update(ProcessosRequest $request, $id)
    {
        if (Auth::user()->penal == 1 ) {
            $processo = Processos::where('id', $id)->first();
            $processo->fill($request->all());
            $processo->save();
            if (!$processo->save()) {
                return redirect()->back()->withInput()->withErrors();
            }
            return redirect()->route('processos.edit', ['processo' => $processo->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
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

            var_dump($id);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
