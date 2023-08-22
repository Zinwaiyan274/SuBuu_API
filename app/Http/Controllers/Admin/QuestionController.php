<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function maanQuestion()
    {
        $quizzes = Quiz::where('status', 1)->get();
        $questions = Question::with('questionCategory')
                        ->when(request('search'), function($q) {
                            $q->where('question', 'like', '%'.request('search').'%')
                            ->orWhere('option_a', 'like', '%'.request('search').'%')
                            ->orWhere('option_b', 'like', '%'.request('search').'%')
                            ->orWhere('option_c', 'like', '%'.request('search').'%')
                            ->orWhere('option_d', 'like', '%'.request('search').'%')
                            ->orWhere('answer', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('questionCategory', function($query) {
                            $query->where('name', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(10);

        return view('back-end.pages.question.question', compact('questions', 'quizzes'));
    }

    public function getQuestions()
    {
        $questions = Question::with('questionCategory')
                        ->when(request('quiz_id'), function($q) {
                            $q->where('quiz_id', 'like', '%'.request('quiz_id').'%');
                        })
                        ->latest()
                        ->paginate(10);

        return response()->json([
            'data' => view('back-end.pages.question.data', compact('questions'))->render()
        ]);
    }

    public function maanNewQuestion(Request $request)
    {
        $request->validate([
            'quiz_id'        => 'required|exists:quizzes,id',
            'question'       => 'required|string|max:100|min:2',
            'option_a'       => 'required|string|max:100|min:2',
            'option_b'       => 'required|string|max:100|min:2',
            'option_c'       => 'nullable|string|max:100',
            'option_d'       => 'nullable|string|max:100',
            'answer'         => 'required|string|max:100',
        ]);
        Question::addQuestion($request);
        return response()->json([
            'message' => __('Question created successfully.'),
            'redirect' => route('question'),
        ]);
    }

    public function maanDeleteQuestion($id)
    {
        $question = Question::find($id);
        $question->delete();
        return response()->json([
            'message' => __('Question deleted successfully.'),
            'redirect' => route('question'),
        ]);
    }

    public function maanEditQuestion($id)
    {
        return view('back-end.pages.question.edit_question', [
            'info'            => Question::find($id),
            'questions'       => Question::where('status', 1)->get(),
            'quizzes'         => Quiz::where('status', 1)->get(),
        ]);
    }

    public function maanUpdateQuestion(Request $request, $id)
    {
        $request->validate([
            'quiz_id'        => 'required|exists:quizzes,id',
            'question'       => 'required|string|max:100|min:2',
            'option_a'       => 'required|string|max:100|min:2',
            'option_b'       => 'required|string|max:100|min:2',
            'option_c'       => 'nullable|string|max:100',
            'option_d'       => 'nullable|string|max:100',
            'answer'         => 'required|string|max:100',
        ]);

        Question::updateQuestion($request, $id);
        return response()->json([
            'message' => __('Question updated successfully.'),
            'redirect' => route('question'),
        ]);
    }
}
