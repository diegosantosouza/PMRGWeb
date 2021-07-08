<?php

namespace App\Http\Controllers;

use App\Telematica_classificacao;
use App\Telematica_suporte;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Telematica_suporte as SuporteRequest;

class Telematica_suporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function teste()
    {
        return view('admin.pdf.telematicatestepdf');
    }

    public function historico()
    {
        $suportes = Telematica_suporte::with(['modalidade'])->latest()->take(50)->get();

        return view('admin.telematica.historico', ['suportes' => $suportes]);
    }

    public function busca(Request $request)
    {
        $request->validate([
            'data_inicio'=>'required'
        ]);

        if (empty($request->data_termino)){
            $request->data_termino= date('Y/m/d');
        }

        $suportes = Telematica_suporte::where('created_at', '>=', $this->convertStringToDate($request->data_inicio))->whereDate('created_at', '<=', $this->convertStringToDate($request->data_termino))->orderBy('created_at', 'asc')->get();
        return view('admin.telematica.historico', ['suportes' => $suportes]);
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    public function index()
    {
        $suportes = Telematica_suporte::where('finalizado', null)->with(['modalidade'])->get();
        $suportesHoje = Telematica_suporte::whereDate('created_at', '=', date('Y-m-d'))->count();
        $suporteAno = Telematica_suporte::whereYear('created_at', '=', date('Y'))->count();
        $user = Auth::user();
        $ip = request()->ip();
        return view('admin.telematica.index', ['suportes' => $suportes, 'suportesHoje'=>$suportesHoje, 'suporteAno'=>$suporteAno, 'user' => $user, 'ip' => $ip]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuporteRequest $request)
    {
        $suporte = Telematica_suporte::create($request->all());
        $suporte->save();
        return redirect()->back()->with(['color' => 'green', 'message' => 'Cadastrado com sucesso.']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suporte = Telematica_suporte::where('id', $id)->with(['modalidade'])->first();

        return view('admin.telematica.show', ['suporte' => $suporte]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->admin == 1) {
            $suporte = Telematica_suporte::where('id', $id)->with(['modalidade'])->first();
            $modalidade = Telematica_classificacao::all();
            $user = Auth::user();

            return view('admin.telematica.edit', ['suporte' => $suporte, 'modalidade'=>$modalidade, 'user' => $user]);
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
        if (Auth::user()->admin == 1) {
            $suporte = Telematica_suporte::where('id', $id)->first();
            $suporte->fill($request->all());
            $suporte->save();

            return redirect()->route('telematica.edit',['telematica'=>$suporte->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
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
        //
    }
}
