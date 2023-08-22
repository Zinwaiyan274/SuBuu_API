<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizCategory;
use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
{
    /**
     * Display a listing of the Quiz  .
     * Create a Quiz  .
     *
     */
    public function maanQuiz()
    {
        $categories = QuizCategory::where('status', 1)->get();
        $quizzes = Quiz::with('quizCategory')
                    ->when(request('search'), function($q) {
                        $q->where('name', 'like', '%'. request('search') .'%')
                        ->orWhere('reward_point', 'like', '%'. request('search') .'%')
                        ->orWhere('retake_point', 'like', '%'. request('search') .'%');
                    })
                    ->latest()
                    ->paginate(10);

        return view('back-end.pages.quiz.quiz', compact('quizzes', 'categories'));
    }

    /**
     * Store a listing of the requested data.
     *
     */
    public function maanNewQuiz(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'category_id' => 'required|exists:quiz_categories,id',
            'reward_point' => 'required|integer|max:1000000',
            'retake_point' => 'required|integer|max:1000000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        Quiz::addQuiz($request);
        return response()->json([
            'message' => __('Quiz created successfully.'),
            'redirect' => route('quiz'),
        ]);
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanDeleteQuiz($id)
    {
        $quiz = Quiz::find($id);
        if (file_exists($quiz->image)) {
            unlink($quiz->image);
        }
        $quiz->delete();
        return response()->json([
            'message' => __('Quiz deleted successfully.'),
            'redirect' => route('quiz'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function maanEditQuiz($id)

    {
        return view('back-end.pages.quiz.edit_quiz', [
            'info'          => Quiz::find($id),
            'quizzes'       => Quiz::where('status', 1)->get(),
            'categories'    => QuizCategory::where('status', 1)->get(),
        ]);
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanUpdateQuiz(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'category_id' => 'required|exists:quiz_categories,id',
            'reward_point' => 'required|integer|max:1000000',
            'retake_point' => 'required|integer|max:1000000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        Quiz::updateQuiz($request, $id);
        return response()->json([
            'message' => __('Quiz updated successfully.'),
            'redirect' => route('quiz'),
        ]);
    }
}
