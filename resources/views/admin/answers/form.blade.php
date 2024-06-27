@extends('admin.layout')

@section('content')
    <h1>{{ isset($answer) ? 'Edit Answer' : 'Add New Answer' }}</h1>

    <form action="{{ isset($answer) ? route('admin.answers.update', $answer) : route('admin.answers.store') }}" method="POST">
        @csrf
        @if(isset($answer))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="answer">Question</label>
            <select class="form-control" name="question_id">
                @if(isset($questionSelected))
                    <option value="{{ $questionSelected->id }}" selected="selected">{{ $questionSelected->name }}</option>
                @else
                    <option>Select question...</option>
                    @foreach($questions as $key => $option)
                        <option value="{{ $key }}" {{ ($key == old('question_id', $answer->question_id ?? '')) ? "selected='selected'" : "" }}>{{ $option }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <input type="text" name="name" id="answer" class="form-control" placeholder="Answer" value="{{ old('name', $answer->name ?? '') }}">
        </div>
        <div class="form-group">
            <label for="answer">Redirect to Question</label>
            <select class="form-control" name="next_question_id">
                <option>Select question...</option>
                @foreach($questions as $key => $option)
                    <option value="{{ $key }}" {{ ($key == old('next_question_id', $answer->next_question_id ?? '')) ? "selected='selected'" : "" }}>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="form-group" class="">
            <label for="products">Excluded Products</label>
            <div id="products" class="form-row align-items-center">
                @if (isset($answer) && $answer->productExclusions->count())
                    @foreach ($answer->productExclusions as $exclusions)
                        <div class="input-group mb-2">
                            <select class="form-control" name="products[]">
                                <option>Select product...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($product->id == old('products', $exclusions->product_id ?? '')) ? "selected='selected'" : "" }}>{{ $product->name . ' - ' . $product->size . 'mg' }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger remove-product">Remove</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="btn btn-warning" id="add-product">Add Product</button>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary">{{ isset($answer) ? 'Update Answer' : 'Create Answer' }}</button>
    </form>

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productDiv = document.createElement('div');
            productDiv.classList.add('input-group', 'mb-2');

            productDiv.innerHTML = `
            <select class="form-control" name="products[]">
                <option>Select product...</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name . ' - ' . $product->size . 'mg' }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
            <button type="button" class="btn btn-danger remove-product">Remove</button>
            </div>
            `;
            document.getElementById('products').appendChild(productDiv);
        });

        document.getElementById('products').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
@endsection
