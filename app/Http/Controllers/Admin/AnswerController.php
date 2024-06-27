<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Product;
use App\Models\Question;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::get();
        return view('admin.answers.index', compact('answers'));
    }

    public function create($question_id = null)
    {
        $products = Product::get();
        $questions = Question::pluck('name', 'id');
        $questionSelected = $question_id ? Question::where('id', $question_id)->first() : null;

        return view('admin.answers.create', compact('products','questions', 'questionSelected'));
    }

    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->validated());

        if (isset($request->products)) {
            foreach ($request->products as $product) {
                $answer->productExclusions()->create(['product_id' => $product]);
            }
        }

        return redirect()->route('admin.questions.edit', $answer->question_id)
            ->with('success', 'Answer created successfully.');
    }

    public function edit(Answer $answer)
    {
        $products = Product::get();
        $questions = Question::pluck('name', 'id');

        return view('admin.answers.edit', compact('products','answer', 'questions'));
    }

    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update(['name' => $request->name]);
        $answer->productExclusions()->delete();

        if (isset($request->products)) {
            foreach ($request->products as $product) {
                $answer->productExclusions()->create(['product_id' => $product]);
            }
        }

        return redirect()->route('admin.answers.index')->with('success', 'Answer updated successfully.');
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
        return redirect()->route('admin.answers.index')->with('success', 'Answer deleted successfully.');
    }
}
