@extends('template.page')

@section('title', 'Listagem de Produtos')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success') || session()->has('error'))
                <div class="alert-animate alert-@if(session('success')) success @elseif(session('error')) danger @endif"><i class="fa fa-check-circle"></i> {{session('success') ? session('success') : session('warning')}}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row header-card-body">
                        <h4 class="card-title no-border col-md-9">Produtos Cadastrados</h4>
                        <a href="{{ route('product.create') }}" class="mb-3 btn btn-primary col-md-3 btn-rounded btn-fw"><i class="fas fa-plus"></i> Novo Produto</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Estoque</th>
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
