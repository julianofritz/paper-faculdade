@extends('template.page')

@section('title', 'Listagem de Produtos')

@section('js')
    <script>
        $(function(){
            $('table tbody tr').each(function(){
                $('td:eq(2)', this).text('R$ ' + formatPrice(parseFloat($('td:eq(2)', this).text()).toFixed(2)));
                $('td:eq(3)', this).text(formatDate($('td:eq(3)', this).text()));
            });
        });

    </script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success') || session()->has('error'))
                <div class="alert-animate alert-@if(session('success')) success @elseif(session('error')) danger @endif"><i class="fa fa-check-circle"></i> {{session('success') ? session('success') : session('warning')}}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="header-card-body d-flex">
                        <h4 class="card-title no-border col-md-9">Produtos Cadastrados</h4>
                        <a href="{{ route('product.create') }}" class="mb-3 btn btn-primary col-md-3 btn-rounded btn-fw"><i class="fas fa-plus"></i> Novo Produto</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Data Criação</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nome }}</td>
                                    <td>{{ $product->value }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->categorie_id }}</td>
                                    <td><a href="{{ route('product.update', ['id' => $product->id]) }}" class="btn btn-primary">Atualizar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Data Criação</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
