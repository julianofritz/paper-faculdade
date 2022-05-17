@extends('template.page')

@section('title', 'Listagem de Categorias')

@section('js')
    <script>
        $(function(){
            $('table tbody tr').each(function(){
                $('td:eq(2)', this).text(formatDate($('td:eq(2)', this).text()));
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
                    <div class="row header-card-body">
                        <h4 class="card-title no-border col-md-9">Categorias Cadastrados</h4>
                        <a href="{{ route('category.create') }}" class="mb-3 btn btn-primary col-md-3 btn-rounded btn-fw"><i class="fas fa-plus"></i> Novo Categoria</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Data Criação</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td><a href="{{ route('category.update', ['id' => $category->id]) }}" class="btn btn-primary">Atualizar</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Data Criação</th>
                            <th>Ação</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
