@extends('template.page')

@section('title', 'Atualização de Produto')

@section('js')
    <script>
        $("input[data-type='currency']").on({
            keyup: function() {
            formatCurrency($(this));
            },
            blur: function() { 
            formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }


        function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        
        // get input value
        var input_val = input.val();
        
        // don't validate empty input
        if (input_val === "") { return; }
        
        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");
            
        // check for decimal
        if (input_val.indexOf(",") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(",");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);
            
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
            right_side += "00";
            }
            
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by ,
            input_val = "R$ " + left_side + "," + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "R$ " + input_val;
            
            // final formatting
            if (blur === "blur") {
            input_val += ",00";
            }
        }
        
        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
        }

    </script>
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
                <form action="{{ route('product.update') }}" method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="header-card-body">
                            <h4 class="card-title no-border col-md-9">Atualização de Produto</h4>
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
                                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Valor do Produto</label>
                                <input type="text" class="form-control" name="value" value="{{ old('value', $product->value) }}" 
                                    pattern="^\$\d{1,3}(.\d{3})*(\,\d+)?$" data-type="currency" placeholder="R$ 1.000,00" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Categoria do Produto</label>
                                <select class="form-control" name="categorie_id" required>
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
                        <button class="btn btn-success col-md-3" type="submit">Atualizar</button>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                </form>
            </div>
        </div>
    </div>
@stop
