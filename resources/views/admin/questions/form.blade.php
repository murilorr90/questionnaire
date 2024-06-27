@extends('admin.layout')

@section('content')
    <h1>{{ isset($question) ? 'Edit Question' : 'Add New Question' }}</h1>

    <form action="{{ isset($question) ? route('admin.questions.update', $question) : route('admin.questions.store') }}" method="POST">
        @csrf
        @if(isset($question))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" name="name" id="question" class="form-control" placeholder="Question" value="{{ old('question', $question->name ?? '') }}">
        </div>
        <hr>
        @if (isset($question))
            <div class="form-group" class="">
                <label for="answers">Answers</label>
                <div id="answers" class="form-row align-items-center">
                    @foreach ($question->answers as $answer)
                        <div class="input-group mb-2">
                            <input type="text" name="answers[]" class="form-control" placeholder="Answer" value="{{ $answer->name }}" disabled>
                            <div class="input-group-append">
                                <a href="{{ route('admin.answers.edit', $answer) }}" class="btn btn btn-warning">Edit Answer</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.answers.create', $question->id) }}" class="btn btn-primary">Add New Answer</a>
            </div>
            <hr>
        @endif
        <button type="submit" class="btn btn-primary">{{ isset($question) ? 'Update Question' : 'Create Question' }}</button>
    </form>
@endsection
