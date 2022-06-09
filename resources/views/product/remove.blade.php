@extends('template.page')

@section('title', 'Exclusão de Produto')

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
                <form action="{{ route('product.delete') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="header-card-body">
                            <h4 class="card-title no-border col-md-9">Exclusão de Produto</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Código do Produto</label>
                                <input type="text" class="form-control" name="id" value="{{ old('id', $product->id) }}" readonly>
                            </div>
                            <div class="form-group col-md-10">
                                <label>Nome do Produto</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Valor do Produto</label>
                                <input type="text" class="form-control" name="value" value="{{ old('value', $product->value) }}" 
                                    pattern="^\$\d{1,3}(.\d{3})*(\,\d+)?$" data-type="currency" placeholder="R$ 1.000,00" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Categoria do Produto</label>
                                <select class="form-control" name="categorie_id" disabled>
                                    <option value="">(Escolha uma categoria)</option>
                                    @foreach($categorieOptions as $cat)
                                    <?php
                                        echo '<option value="' . $cat->id . '"';
                                        if( $cat->id === $product->categorie_id){
                                            echo ' selected="selected"';
                                        }
                                        echo '>' . $cat->id . " - " . $cat->name . '</option>';
                                    ?>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a class="btn btn-danger col-md-3" href="{{ route('product.index') }}">Voltar</a>
                        <button class="btn btn-success col-md-3" type="submit">Excluir</button>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                </form>
            </div>
        </div>
    </div>
@stop
