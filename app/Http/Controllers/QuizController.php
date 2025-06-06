<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function __construct(
        private QuizService $service
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = $this->service->getAllQuizzes();
        return response()->json($quizzes);
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
    public function store(CreateQuizRequest $request)
    {
        $quiz = $this->service->createQuiz($request->validated());

        
        return response()->json([
            'message' => 'Quiz creado exitosamente',
            'quiz_id' => $quiz->id,
        ], 201);
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
