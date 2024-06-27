<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $questions = Question::pluck('name', 'id');
        return view('admin.questions.create', compact('questions'));
    }

    public function store(StoreQuestionRequest $request)
    {
        Question::create($request->validated());
        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        $questions = Question::whereNotIn('id', [$question->id])->pluck('name', 'id');
        return view('admin.questions.edit', compact('question', 'questions'));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->validated());
        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
    }
}
