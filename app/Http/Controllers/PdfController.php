<?php

namespace App\Http\Controllers;

use App\Alojamentos;
use App\EntradaVisitantes;
use App\Interno;
use App\Processos;
use App\Telematica_suporte;
use App\User;

use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    public function internoPDF(Request $request)
    {
        if ($request->ordenacao == 'patente') {
            $internos = Interno::all();
//            $pdf = PDF::loadView('admin.pdf.internospatente', ['internos'=>$internos]);
//            $pdf->setPaper('A4', 'landscape');
//            return $pdf->stream();
            return view('admin.pdf.internospatente', ['internos'=>$internos]);
        }
        $internos = Interno::orderBy($request->ordenacao, 'asc')->get();
//        $pdf = PDF::loadView('admin.pdf.internospdf', ['internos'=>$internos]);
//        return $pdf->stream();
        return view('admin.pdf.internospdf', ['internos'=>$internos, 'ordenacao'=>$request->ordenacao]);
    }

    public function guardaPDF(Request $request)
    {
        if (empty($request->ordenacao)){
            $alojamentos = Alojamentos::all();
            $internos1 = Interno::where('estagio', 1)->orderBy('nome_guerra', 'asc')->get();
            $internos2 = Interno::where('estagio', 2)->orderBy('nome_guerra', 'asc')->get();
            $internos3 = Interno::where('estagio', 3)->orderBy('nome_guerra', 'asc')->get();
            $internos4 = Interno::where('estagio', 4)->orderBy('nome_guerra', 'asc')->get();
//            $pdf = PDF::loadView('admin.pdf.guardapdf', ['alojamentos'=>$alojamentos,'internos1'=>$internos1, 'internos2'=>$internos2, 'internos3'=>$internos3, 'internos4'=>$internos4]);
//            return $pdf->stream();
            return  view('admin.pdf.guardapdf', ['alojamentos'=>$alojamentos,'internos1'=>$internos1, 'internos2'=>$internos2, 'internos3'=>$internos3, 'internos4'=>$internos4]);
        }else{
            $alojamentos = Alojamentos::where('estagio', $request->ordenacao)->get();
            $internos = Interno::where('estagio', $request->ordenacao)->orderBy('nome_guerra', 'asc')->get();
            $estagio = $request->ordenacao;
//            $pdf = PDF::loadView('admin.pdf.guardaestagiopdf', ['alojamentos'=>$alojamentos,'internos'=>$internos, 'estagio'=>$estagio]);
//            return $pdf->stream();
            return view('admin.pdf.guardaestagiopdf', ['alojamentos'=>$alojamentos,'internos'=>$internos, 'estagio'=>$estagio]);
        }
    }

    public function recolhidosPDF(Request $request)
    {
        $request->validate([
            'data_inicio'=>'required'
        ]);

        if (empty($request->data_termino)){
            $request->data_termino= date('Y/m/d');
        }

        $internos = Interno::where('created_at', '>=', $this->convertStringToDate($request->data_inicio))->whereDate('created_at', '<=', $this->convertStringToDate($request->data_termino))->withTrashed()->orderBy('created_at', 'asc')->get();
//        $pdf = PDF::loadView('admin.pdf.internosrecolhidospdf', ['internos'=>$internos, 'data_inicio'=>$request->data_inicio, 'data_termino'=>$request->data_termino= date('d/m/Y')]);
//        return $pdf->stream();
        return view('admin.pdf.internosrecolhidospdf', ['internos'=>$internos, 'data_inicio'=>$request->data_inicio, 'data_termino'=>$request->data_termino= date('d/m/Y')]);
    }

    public function trabalhoPDF(Request $request)
    {
        if ($request->local == 'todos'){
            $internos = Interno::with('trabalho')->where('empregador', '!=', null)->orderBy('n', 'asc')->get();
            $pdf = PDF::loadView('admin.pdf.trabalhopdf', ['internos'=>$internos]);
            return $pdf->stream();
        }else{
            $internos = Interno::with('trabalho')->where('empregador', $request->local)->orderBy('n', 'asc')->get();
            $pdf = PDF::loadView('admin.pdf.trabalhopdf', ['internos'=>$internos,]);
            return $pdf->stream();
        }
    }

    public function internofichaPDF(Request $request)
    {
        $interno = Interno::where('id', $request->id)->with(['trabalho', 'ensino','processos', 'arquivos', 'visitas', 'advogados', 'comportamento'])->withCount(['processos', 'arquivos', 'visitas', 'advogados', 'comportamento'])->first();
        $primeiroprocesso= Processos::where('id_interno',$interno->id)->oldest()->take(1)->first();

        $idade = $interno->idade($interno->nascimento);

//        $pdf = PDF::loadView('admin.pdf.internosfichapdf', ['interno'=>$interno, 'idade'=>$idade,'primeiroprocesso'=>$primeiroprocesso]);
//        return $pdf->stream();
        return view('admin.pdf.internosfichapdf', ['interno'=>$interno, 'idade'=>$idade,'primeiroprocesso'=>$primeiroprocesso]);
    }

    public function entradavisitantesPDF(Request $request)
    {
        if (empty($request->data)){
            $request->data= date('Y/m/d');
        }

        $visitantes = EntradaVisitantes::with('visitas','interno')->whereDate('created_at', $this->convertStringToDate($request->data))->get();
//        $pdf = PDF::loadView('admin.pdf.visitantespdf', ['visitantes'=>$visitantes, 'data'=>$request->data]);
//        return $pdf->stream();
        return view('admin.pdf.visitantespdf', ['visitantes'=>$visitantes, 'data'=>$request->data]);
    }

    public function telematicaPDF(Request $request)
    {
        $request->validate([
            'data_inicio'=>'required'
        ]);

        if (empty($request->data_termino)){
            $request->data_termino= date('Y/m/d');
        }

        $suportes = Telematica_suporte::where('created_at', '>=', $this->convertStringToDate($request->data_inicio))->whereDate('created_at', '<=', $this->convertStringToDate($request->data_termino))->orderBy('created_at', 'asc')->get();
//        $pdf = PDF::loadView('admin.pdf.telematicatestepdf', ['suportes'=>$suportes, 'data_inicio'=>$request->data_inicio, 'data_termino'=>$request->data_termino= date('d/m/Y')]);
//        return $pdf->stream();
        return view('admin.pdf.telematicapdf', ['suportes'=>$suportes, 'data_inicio'=>$request->data_inicio, 'data_termino'=>$request->data_termino= date('d/m/Y')]);

    }
}
