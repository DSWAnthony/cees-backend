<?php
namespace App\Services;

use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\Interfaces\OptionRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\QuizRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;



class QuizService
{

    public function __construct(
        private QuizRepository $quizRepository,
        private QuestionRepository $questionRepository,
        private OptionRepository $optionRepository
    ) {}

    public function createQuiz(array $data): Quiz
    {
        return DB::transaction(function () use ($data) {
            $quizPayload = [
                'module_id'         => $data['module_id'],
                'title'             => $data['title'],
                'description'       => $data['description'],
                'open_date'         => $data['open_date'],
                'due_date'          => $data['due_date'],
                'time_limit'        => $data['time_limit'],
                'allowed_attemps'   => $data['allowed_attemps'],
                'max_score'         => $data['max_score'],
                'automatic_grading' => $data['automatic_grading'],
                'active'            => $data['active'],
            ];

            $quiz = $this->quizRepository->create($quizPayload);

            foreach ($data['questions'] as $qData) {
                $questionPayload = [
                    'quiz_id'    => $quiz->id,
                    'question'   => $qData['question'],
                    'type'       => $qData['type'],
                    'score'      => $qData['score'],
                    'order_num'  => $qData['order_num'],
                    'active'     => $qData['active'] ?? true,
                ];
                $question = $this->questionRepository->create($questionPayload);

                if (
                    in_array($qData['type'], ['multiple_choice', 'true_false']) &&
                    !empty($qData['options'])
                ) {
                    foreach ($qData['options'] as $optData) {
                        $optionPayload = [
                            'question_id' => $question->id,
                            'option'      => $optData['option'],
                            'is_correct'  => $optData['is_correct'],
                        ];
                        $this->optionRepository->create($optionPayload);
                    }
                }
            }

            return $quiz;
        });
    }
    
    public function updateQuiz(int $quizId, array $data) : Quiz {
        return DB::transaction(function () use ($quizId, $data) {
            // 1. Actualizar datos principales del quiz
            $quiz = $this->quizRepository->update($quizId, [
                'module_id'         => $data['module_id'] ?? null,
                'title'             => $data['title'] ?? null,
                'description'       => $data['description'] ?? null,
                'open_date'         => $data['open_date'] ?? null,
                'due_date'          => $data['due_date'] ?? null,
                'time_limit'        => $data['time_limit'] ?? null,
                'allowed_attemps'   => $data['allowed_attemps'] ?? null,
                'max_score'         => $data['max_score'] ?? null,
                'automatic_grading' => $data['automatic_grading'] ?? null,
                'active'            => $data['active'] ?? null,
            ]);

            // 2. Procesar preguntas solo si existen en los datos
            if (!isset($data['questions'])) {
                return $quiz;
            }

            // 3. Sincronización eficiente de preguntas
            $incomingQuestionIds = [];
            foreach ($data['questions'] as $qData) {
                // 3.1. Upsert de preguntas
                $question = $this->questionRepository->updateOrCreate(
                    ['id' => $qData['id'] ?? null],
                    [
                        'quiz_id'   => $quizId,
                        'question'  => $qData['question'],
                        'type'      => $qData['type'],
                        'score'     => $qData['score'],
                        'order_num' => $qData['order_num'],
                        'active'    => $qData['active'] ?? true,
                    ]
                );
                
                $incomingQuestionIds[] = $question->id;
                
                // 3.2. Gestión de opciones basada en tipo
                $this->processQuestionOptions($question, $qData);
            }

            // 4. Eliminar preguntas no presentes
            $this->questionRepository->deleteMissingQuestions($quizId, $incomingQuestionIds);

            return $quiz;
        });
    }

    public function getAllQuizzes() : Collection {
        return $this->quizRepository->getAll();
    }


    private function processQuestionOptions(Question $question, array $qData)
    {
        // Eliminar opciones si el tipo no las requiere
        if (!in_array($qData['type'], ['multiple_choice', 'true_false'])) {
            $this->optionRepository->deleteByQuestion($question->id);
            return;
        }

        // Procesar opciones solo si existen en los datos
        if (empty($qData['options'])) {
            return;
        }

        // Sincronización de opciones
        $incomingOptionIds = [];
        foreach ($qData['options'] as $optData) {
            $option = $this->optionRepository->updateOrCreate(
                ['id' => $optData['id'] ?? null],
                [
                    'question_id' => $question->id,
                    'option'      => $optData['option'],
                    'is_correct'  => $optData['is_correct'],
                ]
            );
            $incomingOptionIds[] = $option->id;
        }

        // Eliminar opciones faltantes
        $this->optionRepository->deleteMissingOptions($question->id, $incomingOptionIds);
    }
}