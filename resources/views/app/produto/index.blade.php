@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')
    <div class="conteudo-pagina">
        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>

        <div class="menu" style="margin-top: 10px;">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Nome do Fornecedor</th>
                            <th>Site do Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->fornecedor->site }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>

                                {{-- o produtoDetalhe nas 3 últimas tags acima é um método --}}

                                <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">
                                        Visualizar
                                    </a>
                                </td>
                                <td>
                                    <form id="form_{{ $produto->id }}" method="post" action="{{ route('produto.destroy',
                                                                        ['produto' => $produto->id]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        {{-- <button type="submit">Excluir</button> --}}
                                        <a href="#" onclick="document.getElementById('form_{{ $produto->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12">
                                    <p>Pedidos</p>
                                    @foreach($produto->pedidos as $pedido)
                                        <a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id]) }}">
                                            Pedido: {{ $pedido->id }},
                                        </a>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $produtos->appends($request)->links() }}

                <br />
                {{ $produtos->count() }} - Total de registros por página
                <br />
                {{ $produtos->total() }} - Total de itens de todas as páginas
                <br />
                {{ $produtos->firstItem() }} - número do primeiro item da página
                <br />
                {{ $produtos->lastItem() }} - número do último item da página --}}

                {{--
                <br />
                {{ $fornecedores->count() }} - Total de registros por página
                <br />
                {{ $fornecedores->total() }} - Total de itens de todas as páginas
                <br />
                {{ $fornecedores->firstItem() }} - número do primeiro item da página
                <br />
                {{ $fornecedores->lastItem() }} - número do último item da página
                --}}

                <br />

                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} ({{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})
            </div>
        </div>
    </div>
@endsection
