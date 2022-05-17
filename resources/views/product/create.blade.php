@extends('template.page')

@section('title', 'Cadastro de Produto')

@section('js')
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <i class="fa fa-check-circle"></i> {{ $error }}<br/>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="header-card-body">
                            <h4 class="card-title no-border col-md-9">Cadastro de Produto</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nome do Produto</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Valor do Produto</label>
                                <input type="text" class="form-control" name="value" value="{{ old('value') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Categoria do Produto</label>
                                <input type="text" class="form-control" name="categorie_id" value="{{ old('categorie_id') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn btn-danger col-md-3" href="{{ route('product.index') }}">Voltar</a>
                        <button class="btn btn-success col-md-3" type="submit">Cadastrar</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@stop
