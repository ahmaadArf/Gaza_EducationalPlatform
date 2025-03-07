<?php

namespace App\Http\Controllers\Dashboard\Students\Dashboard;

use App\Models\Degree;
use App\Models\Quizze;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    public $totalCount;
    public $curatCont;
    public function index()
    {
        $quizzes = Quizze::where('grade_id', Auth::user()->grade_id)
            ->where('classroom_id', Auth::user()->classroom_id)
            ->where('section_id', Auth::user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        $student=Auth::user();
        return view('pages.Students.dashboard.exams.index', compact('quizzes','student'));
    }

    public function show($quizze_id, $question_index = 0)
{

    $questions = Quizze::find($quizze_id)->Questions;

    if ($questions->isEmpty()) {
        return redirect()->back()->with('error', 'No questions available for this quiz.');
    }

    $current_question = $questions[$question_index];

    $next_index = $question_index + 1 < count($questions) ? $question_index + 1 : null;

    return view('pages.Students.dashboard.exams.exam', compact('current_question', 'quizze_id', 'question_index', 'next_index'));
}
public function storeAnswer(Request $request, $quizze_id, $question_index)
{
    $questions = Quizze::find($quizze_id)->Questions;

    $current_question = $questions[$question_index];
    $correct_answer = $current_question->right_answer;

    $user_answer = $request->input('answer');
    $is_correct = $user_answer === $correct_answer;

    $session_key = "quiz_{$quizze_id}_answers";
    $session_data = session($session_key, []);

    $session_data[$question_index] = [
        'user_answer' => $user_answer,
        'correct_answer' => $correct_answer,
        'is_correct' => $is_correct,
        'score' => $is_correct ? $current_question->score : 0,
    ];

    session([$session_key => $session_data]);

    if ($question_index + 1 >= count($questions)) {
        return $this->calculateScore($quizze_id, $session_data);
    }

    return redirect()->route('student.dashboard.quiz.show', [
        'quizze_id' => $quizze_id,
        'question_index' => $question_index + 1,
    ]);
}

protected function calculateScore($quizze_id, $session_data)
{
    $total_score = collect($session_data)->sum('score');

    Degree::create([
        'quizze_id' => $quizze_id,
        'student_id' =>Auth::user()->id,
        'score' => $total_score,
        'date' => now(),
    ]);

    return redirect()->route('student.dashboard.student_exams.index');
}


}

