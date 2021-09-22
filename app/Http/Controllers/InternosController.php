<?php

namespace App\Http\Controllers;

use App\Advogados;
use App\Alojamentos;
use App\Artigos;
use App\Comportamento;
use App\ComportamentoArquivos;
use App\Estado;
use App\Interno;
use App\InternoArquivos;
use App\MovCarcerario;
use App\Municipio;
use App\Processos;
use App\Support\Cropper;
use App\User;
use App\Visitas;
use App\VisitasArquivos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Internos as InternosRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InternosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function EstadoMunicipios(Request $request)
//    {
//        $uf = Estado::where('Nome', $request->value)->first();
//        $dependent = $request->get('dependent');
//        $data = Municipio::where('Uf', $uf->Uf)->get();
//        $output = '<option value="">Selecione o ' . ucfirst($dependent) . '</option>';
//        foreach ($data as $row) {
//            $output .= '<option value="' . $row->Nome . '">' . $row->Nome . '</option>';
//        }
//        echo $output;
//    }
    public function numerosVagos()
    {
        //** Número interno vazios */
        $internos = Interno::pluck('n');
        $max = Interno::select('n')->max('n');
        $numeros = array();

        for ($i = 1; $i <= $max+100; $i++) {
            if (!$internos->contains($i)) {
                array_unshift($numeros, $i);
            }
        }
        sort($numeros);
        return $numeros;
    }

    public function internoBusca(Request $request)
    {
        $search = $request->cidade;
        $autocomplates = Interno::orderby('n', 'asc')->select(['n', 'nome_guerra'])->where('n', 'like', $search . '%')->limit(5)->get();
        $response = array();
        foreach ($autocomplates as $autocomplate) {
            $response[] = array("value" => $autocomplate->n, "label" => $autocomplate->n . '-' . $autocomplate->nome_guerra);
        }
        echo json_encode($response);
    }

    public function cidadeBusca(Request $request)
    {
        $search = $request->cidade;
        $autocomplates = Municipio::orderby('Nome', 'asc')->select('Nome')->where('Nome', 'like', $search . '%')->limit(5)->get();
        $response = array();
        foreach ($autocomplates as $autocomplate) {
            $response[] = array("value" => $autocomplate->Nome, "label" => $autocomplate->Nome);
        }
        echo json_encode($response);
    }

    public function index()
    {
        $internos = Interno::all();
        return view('admin.internos.index', ['internos' => $internos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->penal == 1) {
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            $alojamentos = Alojamentos::where('vagas', '>', 0)->select('cela')->get();
            $numeros = $this->numerosVagos();
            return view('admin.internos.create', ['estados' => $estados, 'numeros' => $numeros, 'alojamentos' => $alojamentos]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternosRequest $request)
    {
        if (Auth::user()->penal == 1) {
            $interno = Interno::create($request->all());
            $interno->comportamento_status = 'Bom';
            $date = new \DateTime();
            $date->add(new \DateInterval('P365D'));
            $interno->comportamento_data = $date;

            if (!empty($request->file('foto'))) {
                $interno->foto = $request->file('foto')->storeAs('interno/' . $interno->re, $request->file('foto')->getClientOriginalName());
                $interno->save();
            }

            if (!$interno->save()) {
                return redirect()->back()->withInput()->withErrors();
            }

            if ($request->allFiles()) {
                foreach ($request->allFiles()['arquivos'] as $arquivos) {
                    $request->validate([
                        'arquivos' => 'mimes:jpeg,png,jpg,doc,docx,pdf',
                    ]);
                    $arquivosInterno = new InternoArquivos();
                    $arquivosInterno->interno_id = $interno->id;
                    $arquivosInterno->path = $arquivos->storeAs('interno/' . $interno->re . '/' . 'documentos', $arquivos->getClientOriginalName());
                    $arquivosInterno->save();
                    unset($arquivosInterno);
                }
            }
            return redirect()->route('internos.edit', ['interno' => $interno->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interno = Interno::where('id', $id)->with(['trabalho', 'ensino', 'processos', 'arquivos', 'visitas', 'advogados', 'comportamento', 'movcarcerario', 'legislacao'])->withCount(['processos', 'arquivos', 'visitas', 'advogados', 'comportamento'])->first();
        /* calcular idade*/
        $hoje = new \DateTime();
        $nascimento = new \DateTime($interno->nascimento);
        $idade = $nascimento->diff($hoje);

        return view('admin.internos.show', ['interno' => $interno, 'idade' => $idade]);
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
            $interno = Interno::where('id', $id)->with(['processos', 'arquivos', 'visitas', 'advogados', 'movcarcerario', 'legislacao'])->withCount(['processos', 'arquivos', 'visitas', 'advogados'])->first();
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            $alojamentos = Alojamentos::where('vagas', '>', 0)->select('cela')->get();
            $numeros = $this->numerosVagos();
            return view('admin.internos.edit', ['interno' => $interno, 'estados' => $estados, 'numeros' => $numeros, 'alojamentos' => $alojamentos]);
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
    public function update(InternosRequest $request, $id)
    {
        if (Auth::user()->penal == 1) {
            $interno = Interno::where('id', $id)->first();

            if (!empty($request->file('foto'))) {
                Storage::delete($interno->foto);
                Cropper::flush($interno->foto);
                $interno->foto = '';
            }
            if (($request->alojamento != $interno->alojamento) || ($request->estagio != $interno->estagio)) {
                $movcarcerario = new MovCarcerario();
                $movcarcerario->id_interno = $request->id;
                $movcarcerario->celaanterior = $interno->alojamento;
                $movcarcerario->estagioanterior = $interno->estagio;
                $movcarcerario->celaatual = $request->alojamento;
                $movcarcerario->estagioatual = $request->estagio;
                $movcarcerario->save();

            }

            $interno->fill($request->all());

            if (!empty($request->file('foto'))) {
                Storage::delete($interno->foto);

                $interno->foto = $request->file('foto')->storeAs('interno/' . $interno->re, $request->file('foto')->getClientOriginalName());
            }
            $interno->save();

            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->file()['arquivos'] as $arquivos) {
                    $arquivosInterno = new InternoArquivos();
                    $arquivosInterno->interno_id = $interno->id;
                    $arquivosInterno->path = $arquivos->storeAs('interno/' . $interno->re . '/' . 'documentos', $arquivos->getClientOriginalName());
                    $arquivosInterno->save();
                    unset($arquivosInterno);
                }
            }

            if (!$interno->save()) {
                return redirect()->back()->withInput()->withErrors();
            }

            return redirect()->route('internos.edit', ['interno' => $interno->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($interno)
    {
        if (Auth::user()->penal == 1) {
            $interno = Interno::where('id', $interno)->first();
            $interno->n = null;
            $interno->save();
            $interno->delete();
            return redirect()->route('internos.index')->with(['color' => 'green', 'message' => 'Interno deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function arquivoDelete($arquivo)
    {
        if (Auth::user()->penal == 1) {
            $delete = InternoArquivos::where('id', $arquivo)->first();
            Storage::delete($delete->path);
            $delete->delete();

            return back()->with(['color' => 'green', 'message' => 'Arquivo deletado!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function excluidos()
    {
        $internos = Interno::onlyTrashed()->get();
        return view('admin.internos.excluidos', ['internos' => $internos]);
    }

    public function excluidosShow($id)
    {
        $interno = Interno::onlyTrashed()->where('id', $id)->with(['trabalho', 'ensino', 'processos', 'arquivos', 'visitas', 'advogados', 'comportamento', 'movcarcerario'])->withCount(['processos', 'arquivos', 'visitas', 'advogados', 'comportamento'])->first();
        /* calcular idade*/
        $hoje = new \DateTime();
        $nascimento = new \DateTime($interno->nascimento);
        $idade = $nascimento->diff($hoje);

        return view('admin.internos.excluidoshow', ['interno' => $interno, 'idade' => $idade]);
    }

    public function excluidosEdit($id)
    {
        if (Auth::user()->penal == 1) {

            $interno = Interno::onlyTrashed()->where('id', $id)->with(['processos', 'arquivos', 'visitas', 'advogados', 'movcarcerario'])->withCount(['processos', 'arquivos', 'visitas', 'advogados'])->first();
            $estados = Estado::select('Nome', 'Uf')->orderBy('Nome', 'asc')->get();
            $alojamentos = Alojamentos::where('vagas', '>', 0)->select('cela')->get();

            $numeros = $this->numerosVagos();
            return view('admin.internos.excluidosedit', ['interno' => $interno, 'estados' => $estados, 'numeros' => $numeros, 'alojamentos' => $alojamentos]);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function excluidosUpdate(InternosRequest $request, $id)
    {
        if (Auth::user()->penal == 1) {
            $interno = Interno::onlyTrashed()->where('id', $id)->first();

            if (!empty($request->file('foto'))) {
                Storage::delete($interno->foto);
                Cropper::flush($interno->foto);
                $interno->foto = '';
            }

            $interno->fill($request->all());

            if (!empty($request->file('foto'))) {
                Storage::delete($interno->foto);

                $interno->foto = $request->file('foto')->storeAs('interno/' . $interno->re, $request->file('foto')->getClientOriginalName());
            }
            $interno->save();
            if ($interno->trashed()) {
                $interno->restore();
            }
            if (!empty($request->allFiles()['arquivos'])) {
                foreach ($request->file()['arquivos'] as $arquivos) {
                    $arquivosInterno = new InternoArquivos();
                    $arquivosInterno->interno_id = $interno->id;
                    $arquivosInterno->path = $arquivos->storeAs('interno/' . $interno->re . '/' . 'documentos', $arquivos->getClientOriginalName());
                    $arquivosInterno->save();
                    unset($arquivosInterno);
                }
            }

            if (!$interno->save()) {
                return redirect()->back()->withInput()->withErrors();
            }

            return redirect()->route('internos.edit', ['interno' => $interno->id])->with(['color' => 'green', 'message' => 'Restaurado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

    public function deletarInterno($id)
    {
        if (Auth::user()->admin == 1) {
            $deleteVisitas = Visitas::where('id_interno', $id)->get();
            foreach ($deleteVisitas as $visita) {
                Storage::delete($visita->foto);
                $visitaArquivos = VisitasArquivos::where('visita_id', $visita->id)->get();
                foreach ($visitaArquivos as $arquivo) {
                    Storage::delete($arquivo->path);
                    $arquivo->delete();
                }
                $visita->delete();
            }
            $deleteAdvogados = Advogados::where('id_interno', $id)->get();
            foreach ($deleteAdvogados as $advogado) {
                $advogado->delete();
            }
            $deleteProcessos = Processos::where('id_interno', $id)->get();
            foreach ($deleteProcessos as $processo) {
                $processo->delete();
            }
            $deleteComportamentos = Comportamento::where('id_interno', $id)->get();
            foreach ($deleteComportamentos as $comportamento) {
                $comportamentoArquivos = ComportamentoArquivos::where('comportamento_id', $comportamento->id)->get();
                foreach ($comportamentoArquivos as $arquivo) {
                    Storage::delete($arquivo->path);
                    $arquivo->delete();
                }
                $comportamento->delete();
            }
            $deleteMovCarcerario = MovCarcerario::where('id_interno', $id)->get();
            foreach ($deleteMovCarcerario as $movcarcerario) {
                $movcarcerario->delete();
            }

            $deleteArquivos = InternoArquivos::where('interno_id', $id)->get();
            foreach ($deleteArquivos as $arquivo) {
                Storage::delete($arquivo->path);
                $arquivo->delete();
            }

            $internoDelete = Interno::onlyTrashed()->where('id', $id)->first();
            Storage::deleteDirectory('interno/' . $internoDelete->re);
            Storage::delete($internoDelete->foto);
            $internoDelete->forceDelete();

            return redirect()->route('interno.excluidos')->with(['color' => 'green', 'message' => 'Deletado com sucesso!']);
        }
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Usuário não possui permissão.']);
    }

}
