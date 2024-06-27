@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Questions</h1>
        <a href="{{ route('admin.questions.create') }}" class="btn btn-primary">Add New Question</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answers</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->name }}</td>
                <td>{{ $question->answers->count() }}</td>
                <td>
                    <a href="{{ route('admin.questions.edit', $question) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
