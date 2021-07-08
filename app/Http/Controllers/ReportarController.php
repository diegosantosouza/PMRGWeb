<?php

namespace App\Http\Controllers;

use App\Reportar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportes = Reportar::orderBy('created_at', 'desc')->get();

        return view('admin.reportar.index', ['reportes'=>$reportes]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'erro' => 'required|max:60',
            'descricao' => 'required'
        ]);
        $reportado = new Reportar();
        $reportado->fill($request->all());
        $reportado->user_nome= Auth::user()->name;
        $reportado->user_email= Auth::user()->email;
        $reportado->status= 'pendente';
        $reportado->save();

        return redirect()->back()->with(['color' => 'green', 'message' => 'Reportado com sucesso!']);
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
        $reportado = Reportar::where('id', $id)->first();
        $reportado->fill($request->all());
        $reportado->user_dev= Auth::user()->name;
        $reportado->user_dev_email= Auth::user()->email;
        $reportado->save();

        return redirect()->back()->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
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
