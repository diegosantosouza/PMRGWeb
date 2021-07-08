<?php

namespace App\Http\Controllers;

use App\Empregador;
use App\Interno;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Empregador as EmpregadorRequest;
use Illuminate\Support\Facades\Auth;


class EmpregadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empregador = Empregador::with(['internos'])->withCount(['internos'])->get();
        return view('admin.juridica.empregador.index', ['empregador' => $empregador]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->juridica == 1) {
            return view('admin.juridica.empregador.create');
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpregadorRequest $request)
    {
        if (Auth::user()->juridica == 1) {
            $empregador = Empregador::create($request->all());
            $empregador->save();
            return redirect()->route('empregador.edit', ['empregador' => $empregador->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Empregador $empregador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empregador = Empregador::where('id', $id)->select('empregador')->first();
        $internos = Interno::where('empregador', $id)->get();

        return view('admin.juridica.empregador.show', ['internos' => $internos, 'empregador' => $empregador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Empregador $empregador
     * @return \Illuminate\Http\Response
     */
    public function edit(Empregador $empregador)
    {
        if (Auth::user()->juridica == 1) {
            $empregador = Empregador::where('id', $empregador->id)->with(['internos'])->first();
            return view('admin.juridica.empregador.edit', ['empregador' => $empregador]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Empregador $empregador
     * @return \Illuminate\Http\Response
     */
    public function update(EmpregadorRequest $request, $id)
    {
        if (Auth::user()->juridica == 1) {
            $empregador = Empregador::where('id', $id)->first();
            $empregador->fill($request->all());
            $empregador->save();

            return redirect()->route('empregador.edit', ['empregador' => $empregador->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Empregador $empregador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empregador $empregador)
    {
        if (Auth::user()->juridica == 1) {

            $internos = Interno::where('empregador', $empregador->id)->get();
            foreach ($internos as $interno) {
                $interno->empregador = null;
                $interno->save();
            }

            Empregador::where('id', $empregador->id)->delete();
            return redirect()->route('empregador.index')->with(['color' => 'green', 'message' => 'Trabalho deletada!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function internoTrabalho($id)
    {
        if (Auth::user()->juridica == 1) {

            $empregador = Interno::where('id', $id)->first();
            $empregador->empregador = null;
            $empregador->save();

            return redirect()->back()->with(['color' => 'green', 'message' => 'Interno deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function internoAdic(Request $request, $empregador)
    {
        if (Auth::user()->juridica == 1) {
            $request->validate([
                'empregador' => 'numeric',
            ]);
            $interno = Interno::where('n', $request->empregador)->first();

            if (empty($interno)) {
                return redirect()->back()->with(['color' => 'orange', 'message' => 'Interno não encontrado!']);
            }

            if ($interno->empregador == $empregador) {
                return redirect()->back()->with(['color' => 'orange', 'message' => 'Interno já consta na lista.']);
            }
            $interno->empregador = $empregador;
            $interno->save();

            return redirect()->back()->with(['color' => 'green', 'message' => 'Interno adicionado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function editarTrabalho($id)
    {
        if (Auth::user()->juridica == 1) {

            $empregador = Empregador::where('id', $id)->first();
            return view('admin.juridica.empregador.empregadorEdit', ['empregador' => $empregador]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
