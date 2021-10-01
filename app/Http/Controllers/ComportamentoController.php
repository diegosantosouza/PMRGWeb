<?php

namespace App\Http\Controllers;

use App\Comportamento;
use App\ComportamentoArquivos;
use App\Interno;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Comportamento as ComportamentoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ComportamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * seleciona os registros em Comportamento que possuem o relacionamento de internos
         */
        $comportamentos = Comportamento::with('interno')->where('pdi_status', '=', 'Instrução')
            ->whereHas('interno', function (Builder $query) {
                $query->where('deleted_at', '=', null);
            })->get();
        /**
         * seleciona os registros em Comportamento que possuem o relacionamento de internos que receberam alvará
         */
        $instrucaoAlvara = Comportamento::with('interno')->where('pdi_status', '=', 'Instrução')
            ->whereHas('interno', function (Builder $query) {
            $query->where('deleted_at', '!=', null);
        })->get();
        return view('admin.pjmd.index', ['comportamentos'=>$comportamentos, 'instrucaoAlvara'=>$instrucaoAlvara]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->pjmd == 1 ) {
            if (empty(Interno::where('n', $request->interno)->first())) {
                return redirect()->back()->with(['color' => 'orange', 'message' => 'Interno não encontrado!']);
            }
            $interno = Interno::where('n', $request->interno)->first();
            return view('admin.pjmd.create', ['interno' => $interno]);
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
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Comportamento::create($request->all());
            $interno = Interno::where('id', $comportamento->id_interno)->select('re')->first();
            $comportamento->save();
            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->allFiles()['arquivos'] as $arquivos) {
                    $arquivosComportamento = new ComportamentoArquivos();
                    $arquivosComportamento->comportamento_id = $comportamento->id;
                    $arquivosComportamento->path = $arquivos->storeAs('interno/' . $interno->re . '/' . 'comportamento/' . $comportamento->id . '/' . 'documentos_comportamento', $arquivos->getClientOriginalName());
                    $arquivosComportamento->save();
                    unset($arquivosComportamento);
                }
            }
            return redirect()->route('pjmd.edit', ['pjmd' => $comportamento->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
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
        $comportamento = Comportamento::where('id', $id)->with(['arquivos', 'interno'])->first();
        $documentos= $comportamento->arquivos;

        return view('admin.pjmd.show', ['comportamento'=>$comportamento, 'documentos'=>$documentos]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Comportamento::where('id', $id)->with('interno')->first();
            $documentos = $comportamento->arquivos()->get();
            return view('admin.pjmd.edit', ['comportamento' => $comportamento, 'documentos' => $documentos]);
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
    public function update(ComportamentoRequest $request, $id)
    {
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Comportamento::where('id', $id)->with('interno')->first();
            $comportamento->fill($request->all());
            $comportamento->save();
            if (!$comportamento->save()) {
                return redirect()->back()->withInput()->withErrors();
            }
            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->allFiles()['arquivos'] as $arquivos) {
                    $arquivosComportamento = new ComportamentoArquivos();
                    $arquivosComportamento->comportamento_id = $comportamento->id;
                    $arquivosComportamento->path = $arquivos->storeAs('interno/' . $comportamento->interno->re . '/' . 'comportamento/' . $comportamento->id . '/' . 'documentos_comportamento', $arquivos->getClientOriginalName());
                    $arquivosComportamento->save();
                    unset($arquivosComportamento);
                }
            }
            return redirect()->route('pjmd.edit', ['pjmd' => $comportamento->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
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
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Comportamento::where('id', $id)->with('arquivos')->first();
//            dd($comportamento);
            if (!empty($comportamento->arquivos)){
                foreach ($comportamento->arquivos as $arquivo) {
                    Storage::delete($arquivo->path);
                    $arquivo->delete();
                }
            }
            $comportamento->delete();
            return redirect()->route('pjmd.index')->with((['color' => 'green', 'message' => 'Comportamento deletado!']));
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function arquivoDelete($arquivo)
    {
        if (Auth::user()->pjmd == 1 ) {
            $delete = ComportamentoArquivos::where('id', $arquivo)->first();
            Storage::delete($delete->path);
            $delete->delete();
            return back()->with(['color' => 'green', 'message' => 'Arquivo deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function comportamentoEdit($id)
    {
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Interno::where('id', $id)->first();
            return view('admin.pjmd.comportamentoEdit', ['comportamento' => $comportamento]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function comportamentoUpdate(Request $request, $id)
    {
        if (Auth::user()->pjmd == 1 ) {
            $comportamento = Interno::where('id', $id)->first();
            $comportamento->fill($request->all());
            $comportamento->save();
            return back()->with(['color' => 'green', 'message' => 'Comportamento atualizado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
