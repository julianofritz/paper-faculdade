@extends('template.page')

@section('title', 'Atualização de Categoria')

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
                <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="header-card-body">
                            <h4 class="card-title no-border col-md-9">Atualização de Categoria</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Nome da Categoria</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn btn-danger col-md-3" href="{{ route('category.index') }}">Voltar</a>
                        <button class="btn btn-success col-md-3" type="submit">Atualizar</button>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="category_id" value="{{ $category->id }}">
                </form>
            </div>
        </div>
    </div>
@stop
