<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecommendationRequest;
use App\Models\Product;
use App\Models\ProductExclusion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionnaireController extends Controller
{
    public function questionnaire()
    {
        $questions = Question::with('answers')->get();
        return response()->json($questions);
    }

    public function recommendation(RecommendationRequest $request)
    {
        $productExclusions = ProductExclusion::whereIn('answer_id', $request->validated()['answers'])
            ->pluck('product_id');
        return response()->json(Product::whereNotIn('id', $productExclusions)->get());
    }
}
