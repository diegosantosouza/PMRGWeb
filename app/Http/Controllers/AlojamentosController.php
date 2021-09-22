<?php

namespace App\Http\Controllers;

use App\Alojamentos;
use App\Interno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlojamentosController extends Controller
{

    public function buscaestagio(Request $request)
    {
        $search = $request->value;
        $autocomplates = Alojamentos::where('cela', $search)->select('estagio')->first();
        echo json_encode($autocomplates->estagio);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alojamentos = Alojamentos::all();
        $vagas = Interno::select('alojamento')->get();
        return view('admin.penal.alojamentos.index', ['alojamentos' => $alojamentos, 'vagas' => $vagas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->penal == 1) {
            return view('admin.penal.alojamentos.create');
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->penal == 1) {
            $alojamento = new Alojamentos();
            $alojamento->vagas = $request->capacidade;
            $alojamento->fill($request->all());
            $alojamento->save();

            return redirect()->route('alojamentos.index')->with(['color' => 'green', 'message' => 'Criado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($cela)
    {
        $internos = Interno::where('alojamento', $cela)->get();
        return view('admin.penal.alojamentos.show', ['internos' => $internos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->penal == 1) {
            $alojamento = Alojamentos::where('id', $id)->first();
            return view('admin.penal.alojamentos.edit', ['alojamento' => $alojamento]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->penal == 1) {
            $alojamento = Alojamentos::where('id', $id)->first();
            $alojamento->fill($request->all());
            $alojamento->save();
            if (!$alojamento->save()) {
                return redirect()->back()->withInput()->withErrors();
            }
            return redirect()->route('alojamentos.edit', ['alojamento' => $alojamento->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->penal == 1) {
            Alojamentos::where('id', $id)->delete();
            return redirect()->route('alojamentos.index')->with(['color' => 'green', 'message' => 'Alojamento deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }
}
