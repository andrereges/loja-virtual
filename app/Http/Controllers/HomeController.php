<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categoria_id = $request->get('categoria');
        $produto_nome = $request->get('produto');
        $categorias = Categoria::all();
        $inputs = [
            'categoria' => '',
            'produto' => ''
        ];

        if ($categoria_id  && $produto_nome) {
            $inputs = $request->input();

            $categoria = Categoria::find($categoria_id);
            $registros = $categoria->produtos()
            ->where('nome', 'like', '%'.$produto_nome.'%')
            ->where(['ativo' => 'S'])->get();
        } elseif (!$categoria_id  && $produto_nome) {
            $inputs = $request->input();
            $registros = Produto::where('nome', 'like', '%'.$produto_nome.'%')->where(['ativo' => 'S'])->get();


        } elseif ($categoria_id  && !$produto_nome) {
            $inputs = $request->input();
            $registros = Categoria::find($categoria_id)->produtos()->get();  

        } else {            
            $registros = Produto::where(['ativo' => 'S'])->get();
        }
        
        return view('home.index', compact('registros', 'categorias', 'inputs'));
    }

    public function produto($id = null)
    {
        if( !empty($id) ) {
            $registro = Produto::where([
                'id'    => $id,
                'ativo' => 'S'
                ])->first();

            if( !empty($registro) ) {
                return view('home.produto', compact('registro'));
            }
        }
        return redirect()->route('index');
    }
}
