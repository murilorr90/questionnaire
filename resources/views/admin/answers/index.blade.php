@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Answers</h1>
        <a href="{{ route('admin.answers.create') }}" class="btn btn-primary">Add New Answer</a>
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
            <th>Answer</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td><b>{{ $answer->question->name }}</b></td>
                <td>{{ $answer->name }}</td>
                <td class="text-nowrap">
                    <a href="{{ route('admin.answers.edit', $answer) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.answers.destroy', $answer) }}" method="POST" class="d-inline-block">
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
