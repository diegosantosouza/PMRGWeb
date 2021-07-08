<?php

namespace App\Http\Controllers;

use App\Artigos;
use App\Estado;
use App\Interno;
use App\InternoArquivos;
use App\Municipio;
use App\Support\Cropper;
use App\Visitas;
use App\VisitasArquivos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Visitas as VisitasRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitas = Visitas::with('interno')->get();
        return view('admin.penal.visitas.index', ['visitas'=>$visitas]);
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
            $municipios = Municipio::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            return view('admin.penal.visitas.create', ['interno' => $interno, 'estados' => $estados, 'municipios' => $municipios]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitasRequest $request)
    {
        if (Auth::user()->penal == 1 ) {
            $visita = Visitas::create($request->all());
            $interno = Interno::where('id', $visita->id_interno)->select('re')->first();
            if (!empty($request->file('foto'))) {
                $visita->foto = $request->file('foto')->storeAs('interno/' . $interno->re . '/' . 'visitas/' . $visita->nome . $visita->id, $request->file('foto')->getClientOriginalName());
                $visita->save();
            }

            if (!$visita->save()) {
                return redirect()->back()->withInput()->withErrors();
            }

            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->allFiles()['arquivos'] as $arquivos) {
                    $arquivosVisita = new VisitasArquivos();
                    $arquivosVisita->visita_id = $visita->id;
                    $arquivosVisita->path = $arquivos->storeAs('interno/' . $interno->re . '/' . 'visitas/' . $visita->nome . $visita->id . '/' . 'documentos_visitas', $arquivos->getClientOriginalName());
                    $arquivosVisita->save();
                    unset($arquivosVisita);
                }
            }

            return redirect()->route('visita.edit', ['visitum' => $visita->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
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
        $visita = Visitas::where('id', $id)->first();
        $documentos= $visita->arquivos()->get();

        return view('admin.penal.visitas.show', ['visita'=>$visita, 'documentos'=>$documentos]);

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
            $visita = Visitas::where('id', $id)->first();
            $documentos = $visita->arquivos()->get();
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            $municipios = Municipio::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();

            return view('admin.penal.visitas.edit', ['visita' => $visita, 'documentos' => $documentos, 'estados' => $estados, 'municipios' => $municipios]);
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
    public function update(VisitasRequest $request, $id)
    {
        if (Auth::user()->penal == 1 ) {
            $visita = Visitas::where('id', $id)->with('interno')->first();
            $visita->setAntecedentesAttribute($request->antecedentes);
            $visita->setAutorizacao_judicialAttribute($request->autorizacao_judicial);
            $visita->setAutorizacao_menorAttribute($request->autorizacao_menor);
            $interno = $visita->interno->re;

            if (!empty($request->file('foto'))) {
                Storage::delete($visita->foto);
                Cropper::flush($visita->foto);
                $visita->foto = '';
            }

            $visita->fill($request->all());

            if (!empty($request->file('foto'))) {
                Storage::delete($visita->foto);
                $visita->foto = $request->file('foto')->storeAs('interno/' . $interno . '/' . 'visitas/' . $visita->nome . $visita->id, $request->file('foto')->getClientOriginalName());
            }
            $visita->save();

            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->allFiles()['arquivos'] as $arquivos) {
                    $arquivosVisita = new VisitasArquivos();
                    $arquivosVisita->visita_id = $visita->id;
                    $arquivosVisita->path = $arquivos->storeAs('interno/' . $interno . '/' . 'visitas/' . $visita->nome . $visita->id . '/' . 'documentos_visitas', $arquivos->getClientOriginalName());
                    $arquivosVisita->save();
                    unset($arquivosVisita);
                }
            }

            if (!$visita->save()) {
                return redirect()->back()->withInput()->withErrors();
            }

            return redirect()->route('visita.edit', ['visitum' => $visita->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
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
            $arquivos = VisitasArquivos::where('visita_id', $id)->get();
            foreach ($arquivos as $item) {
                Storage::delete($item->path);
                $item->delete();
            }
            Visitas::where('id', $id)->delete();
            return redirect()->route('visita.index')->with((['color' => 'green', 'message' => 'Visita deletado!']));
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function arquivoDelete($arquivo)
    {
        if (Auth::user()->penal == 1 ) {
            $delete = VisitasArquivos::where('id', $arquivo)->first();
            Storage::delete($delete->path);
            $delete->delete();

            return back()->with(['color' => 'green', 'message' => 'Arquivo deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
