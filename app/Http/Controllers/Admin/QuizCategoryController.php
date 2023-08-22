<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizCategory;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    public function maanCategory()
    {
        $categories = QuizCategory::when(request('search'), function($q) {
                            $q->where('name', 'like', '%'.request('search').'%')
                            ->orWhere('description', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(10);
        return view('back-end.pages.quiz-category.quiz_category', compact('categories'), [
            'categories' => QuizCategory::all()
        ]);
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanNewCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        QuizCategory::addCategory($request);
        return response()->json([
            'message' => __('Category created successfully.'),
            'redirect' => route('quiz-category'),
        ]);
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanDeleteCategory($id)
    {
        $category = QuizCategory::find($id);
        $category->delete();
        return response()->json([
            'message' => __('Quiz category deleted successfully.'),
            'redirect' => route('quiz-category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function maanEditCategory($id)
    {
        return view('back-end.pages.quiz-category.edit_quiz_category', [
            'info'          => QuizCategory::find($id),
            'categories'    => QuizCategory::where('status', 1)->get(),
        ]);
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanUpdateCategory(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
        ]);
        QuizCategory::updateCategory($request, $id);
        return response()->json([
            'message' => __('Category updated successfully.'),
            'redirect' => route('quiz-category'),
        ]);
    }
}
