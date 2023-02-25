<?php

namespace App\Http\Controllers;

use App\Produto;
use \App\Item;
use \App\ProdutoDetalhe;
use \App\Unidade;
use \App\Fornecedor;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $produtos = Item::paginate(10);
        $produtos = Item::with(['itemDetalhe'])->paginate(10); // com o método with nós conseguimos
                // mudar o carregamento dos itens de modo preguiçoso para o modo ansioso,
                // recuperando assim também os registros relacionados, ao invés de somente os
                // registros da tabela

        /*
        foreach($produtos as $key => $produto) {

            $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

            if(isset($produtoDetalhe)) {
                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
            }
        }
        */

        return view('app.produto.index', compact('produtos', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.create', compact('unidades', 'fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required | min:3 | max:40',
            'descricao' => 'required | min:3 | max:2000',
            'peso' => 'required | integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido',
            'nome.min' => 'o campo nome deve ter no mínimo 3 caracteres',
            'nome.min' => 'o campo nome deve ter no máximo 2000 caracteres',
            'descricao.min' => 'o campo descricao deve ter no mínimo 3 caracteres',
            'descricao.max' => 'o campo descricao deve ter no máximo 2000 caracteres',
            'peso.integer' => 'o campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'a unidade de medida informada não existe',
            'fornecedor_id.exists' => 'o fornecedor informado não existe',
        ];

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.edit', compact('produto', 'unidades', 'fornecedores'));
        // return view('app.produto.create', compact('produto', 'unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $produto) // mudamos a tipagem de $produto para
    {                                       // Item para evitarmos problemas com propriedades da
                                            // requisição que não fazem parte da classe Produto

        $regras = [
            'nome' => 'required | min:3 | max:40',
            'descricao' => 'required | min:3 | max:2000',
            'peso' => 'required | integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'o campo :attribute deve ser preenchido',
            'nome.min' => 'o campo nome deve ter no mínimo 3 caracteres',
            'nome.min' => 'o campo nome deve ter no máximo 2000 caracteres',
            'descricao.min' => 'o campo descricao deve ter no mínimo 3 caracteres',
            'descricao.max' => 'o campo descricao deve ter no máximo 2000 caracteres',
            'peso.integer' => 'o campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'a unidade de medida informada não existe',
            'fornecedor_id.exists' => 'o fornecedor informado não existe',
        ];

        $request->validate($regras, $feedback);

        $produto->update($request->all());
        $produto = $produto->id;

        return redirect()->route('produto.show', compact('produto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
