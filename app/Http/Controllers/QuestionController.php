<?php

namespace App\Http\Controllers;

use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct(
        private QuestionService $questionService
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index(int $quizId)
    {
        $questions = $this->questionService->getAllByQuiz($quizId);

        return response()->json($questions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
