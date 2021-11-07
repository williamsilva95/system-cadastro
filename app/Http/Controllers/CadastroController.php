<?php

namespace App\Http\Controllers;

use App\Cadastro;
use App\Exports\CadastroExport;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CadastroController extends Controller
{
    function __construct()
    {
        // obriga estar logado;
        $this->middleware('auth');
    }

    public function index()
    {
        $cadastro = Cadastro::select('cadastro.*')->orderBy('created_at','desc')->paginate(3);

        return view('cadastro.index')->with('cadastro', $cadastro);
    }

    public function create()
    {
        return view('cadastro.create-cadastro');
    }

    public function show($id)
    {
        $cadastro = Cadastro::find($id);

        if(Cache::has($id) == false)
        {
            Cache::add($id, 'contador', 0.30);
            $cadastro ->total_visualizacao+=1;
            $cadastro->save();
        }
        return view('cadastro.show-cadastro')->with('cadastro', $cadastro);
    }

    public function store(Request $request)
    {

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            // Recupera a extensão do arquivo
            $extension = $file->getClientOriginalExtension();

            if($extension != 'pdf' && $extension != 'doc' && $extension != 'docx' && $extension != 'odt' && $extension != 'txt'){
                return back()->with('erro', 'Erro: Este arquivo é invalido');
            }

        }

        $cadastro = new Cadastro();
        $cadastro->email = $request->input('email');
        $cadastro->message = $request->input('message');
        $cadastro->name = $request->input('name');
        $cadastro->telephone = $request->input('telephone');
        $cadastro->ip_address = $request->ip();
        $cadastro->file = "";

        $validator = validator($request->all(), $cadastro->rules(), $cadastro->mensages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $cadastro->save();

        if ($request->hasFile('file')) {

            $name = uniqid(date('HisYmd'));
            $nameFile = "{$name}.{$extension}";
            $cadastro->file = $request->file('file')->storeAs('',$nameFile);
            $cadastro->save();

        }

        return redirect('lista-cadastro');
    }

    public function edit($id)
    {
        $cadastro = Cadastro::find($id);

        return view('cadastro.edit-cadastro')->with('cadastro',$cadastro);
    }

    public function update(Request $request, $id)
    {
        $cadastro = Cadastro::find($id);

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            // Recupera a extensão do arquivo
            $extension = $file->getClientOriginalExtension();

            if($extension != 'pdf' && $extension != 'doc' && $extension != 'docx' && $extension != 'odt' && $extension != 'txt'){
                return back()->with('erro', 'Erro: Este arquivo é invalido');
            }

        }
        $cadastro->email = $request->input('email');
        $cadastro->message = $request->input('message');
        $cadastro->name = $request->input('name');
        $cadastro->telephone = $request->input('telephone');
        $cadastro->ip_address = $request->ip();

        $validator = validator($request->all(), $cadastro->rules(), $cadastro->mensages);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $cadastro->save();

        if ($request->hasFile('file')) {

            $name = uniqid(date('HisYmd'));
            $nameFile = "{$name}.{$extension}";
            $cadastro->file = $request->file('file')->storeAs('',$nameFile);
            $cadastro->save();

        }
        return redirect('visualizar-cadastro/'.$cadastro->id);
    }

    public function destroy($id)
    {
        $cadastro = Cadastro::find($id);
        $cadastro->delete();

        return redirect('lista-cadastro');
    }

    public function adicionarGostei($id)
    {
        $cadastro = Cadastro::find($id);

        if(Cache::has('Voto '.$id) == false)
        {
            Cache::add('Voto'. $id. 'contador', 0.30);
            $cadastro->total_gostei+=1;
            $cadastro->save();

            return back()->with('status','Muito obrigado!');
        }else{
            return back();
        }
    }

    public function adicionarNaoGostei($id)
    {
        $cadastro = Cadastro::find($id);

        if(Cache::has('Voto '.$id) == false)
        {
            Cache::add('Voto'. $id. 'contador', 0.30);
            $cadastro->total_naogostei+=1;
            $cadastro->save();

            return back()->with('status','Obrigado');
        }else{
            return back();
        }
    }
    public function pesquisar(Request $request){
        if($request->input('texto') == false){
            return redirect('/');
        }
        $cadastro = Cadastro::where('email','like','%'.$request->input('texto').'%')
            ->orWhere('message','like','%'.$request->input('texto').'%')
            ->orWhere('name','like','%'.$request->input('texto').'%')
            ->orWhere('telephone','like','%'.$request->input('texto').'%')->get();

        return view('pesquisa')->with('cadastro',$cadastro);
    }

    public function downloadFile($id){
        $download = Cadastro::find($id);

        return Storage::download($download->file);
    }

    public function exportar(Request $request)
    {
        try {
            return $this->exportarExcel($request->all());
        } catch(Exception $exception) {
            return redirect()->back()->with(['alert' => 'danger', 'message' => 'Erro ao exportar planilha']);
        }
    }

    public function exportarExcel()
    {
        // Obtem consulta
        $cadastro= $this->gerarConsultaExportacao()->get();

        // Retorna o resultado da consulta da planilha
        return Excel::download(new CadastroExport($cadastro), 'cadastro.xlsx');
    }

    public function gerarConsultaExportacao()
    {
        $query = Cadastro::query()
            ->select([
                'cadastro.id',
                'cadastro.name',
                'cadastro.message',
                'cadastro.email',
                'cadastro.file',
                'cadastro.telephone',
                'cadastro.ip_address',
                'cadastro.total_gostei',
                'cadastro.total_naogostei',
                'cadastro.total_visualizacao',
                'cadastro.created_at',
            ]);

        return $query;
    }
}
