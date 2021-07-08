<?php

namespace App\Http\Controllers;

use App\Estudo;
use App\Http\Requests\Admin\Estudo as EstudoRequest;
use App\Interno;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Internos as InternosRequest;
use Illuminate\Support\Facades\Auth;

class EstudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $estudos = Estudo::with(['internos'])->withCount(['internos'])->get();
        return view('admin.juridica.estudo.index', ['estudos' => $estudos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->juridica == 1) {
            return view('admin.juridica.estudo.create');
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudoRequest $request)
    {
        if (Auth::user()->juridica == 1) {
            $estudos = Estudo::create($request->all());
            $estudos->save();
            return redirect()->route('estudos.edit', ['estudo' => $estudos->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Estudo $estudo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudo = Estudo::where('id', $id)->select('instituicao_ensino')->first();
        $internos = Interno::where('estudo', $id)->get();

        return view('admin.juridica.estudo.show', ['internos' => $internos, 'estudo' => $estudo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Estudo $estudo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->juridica == 1) {
            $estudos = Estudo::where('id', $id)->with(['internos'])->first();
            return view('admin.juridica.estudo.edit', ['estudo' => $estudos]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Estudo $estudo
     * @return \Illuminate\Http\Response
     */
    public function update(EstudoRequest $request, $id)
    {
        if (Auth::user()->juridica == 1) {
            $estudos = Estudo::where('id', $id)->first();
            $estudos->fill($request->all());
            $estudos->save();

            return redirect()->route('estudos.edit', ['estudo' => $estudos->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Estudo $estudo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudo $estudo)
    {
        if (Auth::user()->juridica == 1) {
            $internos = Interno::where('estudo', $estudo->id)->get();
            foreach ($internos as $interno) {
                $interno->estudo = null;
                $interno->save();
            }

            Estudo::where('id', $estudo->id)->delete();
            return redirect()->route('estudos.index')->with(['color' => 'green', 'message' => 'Instituição deletada!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function internoEstudo(Interno $interno)
    {
        if (Auth::user()->juridica == 1) {
            $estudo = Interno::where('id', $interno->id)->first();
            $estudo->estudo = null;
            $estudo->save();

            return redirect()->back()->with(['color' => 'green', 'message' => 'Interno deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function internoAdic(Request $request, $estudo)
    {
        if (Auth::user()->juridica == 1) {
            $request->validate([
                'estudo' => 'numeric',
            ]);
            $interno = Interno::where('n', $request->estudo)->first();

            if (empty($interno)) {
                return redirect()->back()->with(['color' => 'orange', 'message' => 'Interno não encontrado!']);
            }

            if ($interno->estudo == $estudo) {
                return redirect()->back()->with(['color' => 'orange', 'message' => 'Interno já consta na lista.']);
            }
            $interno->estudo = $estudo;
            $interno->save();

            return redirect()->back()->with(['color' => 'green', 'message' => 'Interno adicionado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function editarEstudo($id)
    {
        if (Auth::user()->juridica == 1) {
            $estudo = Estudo::where('id', $id)->first();
            return view('admin.juridica.estudo.estudoEdit', ['estudo' => $estudo]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
