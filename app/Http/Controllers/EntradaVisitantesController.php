<?php

namespace App\Http\Controllers;

use App\EntradaVisitantes;
use App\Interno;
use App\Visitas;
use Illuminate\Http\Request;

class EntradaVisitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $visitas = Visitas::with('interno')->get();
        $contagem = EntradaVisitantes::whereDate('created_at', '=', date('Y-m-d'))->count();

        return view('admin.internos.entradavisitantes.index', ['visitas'=>$visitas, 'contagem'=>$contagem]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listasaida()
    {
        $entradas = EntradaVisitantes::whereDate('created_at', '=', date('Y-m-d'))->where('saida', null)->get();
        $contagem = EntradaVisitantes::whereDate('created_at', '=', date('Y-m-d'))->where('saida', '!=', null)->count();
        return view('admin.internos.entradavisitantes.saida', ['entradas'=>$entradas, 'contagem'=>$contagem]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entrada(Request $request)
    {
        $visita = $request->visita;
        $interno = $request->interno;
        $visitaHoje = EntradaVisitantes::with('visitas')->whereDate('created_at', '=', date('Y-m-d'))->where('visita_id', $visita)->where('saida', null)->first();
        $contagemVisitas = EntradaVisitantes::with('visitas')->whereDate('created_at', '=', date('Y-m-d'))->where('interno_id', $interno)->where('menor_12', null)->count();
        $contagemVisitasdentro = EntradaVisitantes::with('visitas')->whereDate('created_at', '=', date('Y-m-d'))->where('interno_id', $interno)->where('saida', null)->count();
        $visitante = Visitas::where('id', $visita)->with('interno')->first();
        $idade = $visitante->idade($visitante->dt_nascimento);
        $contagem = EntradaVisitantes::whereDate('created_at', '=', date('Y-m-d'))->count();

        if ($visitante->status != 'Ativo'){
            return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, visitante INATIVO ou SUSPENSO!']);
        }

        if ( $visitaHoje == true) {
            return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, visitante já consta como entrada.']);
        } elseif ($contagemVisitas >= 0) {
            if ($visitante->interno->estagio == 1 ) {
                if ($contagemVisitasdentro >= 2) {
                    return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, excedeu 3 visitantes simultâneos.']);
                }
                if ($idade->y < 12) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->menor_12 = 'sim';
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);
                }
                if ($contagemVisitas < 2) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);
                }
                return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, Interno excedeu o número de visitantes.']);
            }
            if ($visitante->interno->estagio == 2 ) {
                if ($contagemVisitasdentro >= 3) {
                    return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, excedeu 3 visitantes simultâneos.']);
                }
                if ($idade->y < 12) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->menor_12 = 'sim';
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);

                }
                if ($contagemVisitas < 4) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);

                }
                return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, Interno excedeu o número de visitantes.']);
            }
            if ($visitante->interno->estagio == 3 ) {
                if ($contagemVisitasdentro >= 4) {
                    return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, excedeu 4 visitantes simultâneos.']);
                }
                if ($idade->y < 12) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->menor_12 = 'sim';
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);

                }
                if ($contagemVisitas < 5) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);

                }
                return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, Interno excedeu o número de visitantes.']);
            }
            if ($visitante->interno->estagio == 4 ) {
                if ($contagemVisitasdentro >= 4) {
                    return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, excedeu 4 visitantes simultâneos.']);
                }
                if ($idade->y < 12) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->menor_12 = 'sim';
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);
                }
                if ($contagemVisitas < 5) {
                    $entrada = new EntradaVisitantes;
                    $entrada->visita_id = $visita;
                    $entrada->interno_id = $interno;
                    $entrada->chegada = date('Y-m-d H:i:s');
                    $entrada->save();
                    return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);
                }
                return json_encode(['color' => 'orange', 'message' => 'Entrada não efetuada, Interno excedeu o número de visitantes.']);
            }

        } else {
            $entrada = new EntradaVisitantes;
            $entrada->visita_id = $visita;
            $entrada->interno_id = $interno;
            $entrada->chegada = date('Y-m-d H:i:s');
            $entrada->save();
            return json_encode(['color' => 'green', 'message' => 'Entrada efetuada.', 'contagem'=> $contagem+1]);
        }
    }

    public function saida($visita)
    {
        $saida = EntradaVisitantes::where('id', $visita)->first();
        $saida->saida = date('Y-m-d H:i:s');
        $saida->save();
        return redirect()->back()->with(['color' => 'green', 'message' => 'Saida efetuada.']);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
