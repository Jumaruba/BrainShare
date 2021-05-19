<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use App\Models\Answer;
use App\Models\Vote;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;

class QuestionController extends Controller
{       
    public function newRoute(Request $request){
        return response()->json(['success' => 'true']);
    }

    public function show($id)
    {
        $question = Question::find($id);
        return view('pages.question', ['question' => $question]);
    }

    public function showQuestionForm()
    {
        if (!Auth::check()) return redirect('/login');

        $courses = Course::all();
        $tags = Tag::all();
        return view('pages.add-question', ['courses' => $courses, 'tags' => $tags]);
    }

    public function showEditQuestionForm($id)
    {
        $question = Question::find($id);
        $question_owner_id = $question['question_owner_id'];
        if (!Auth::check()) return redirect('/login');
        else if (!(Auth::user()->id == $question_owner_id || Auth::user()->isModerator() || Auth::user()->isAdmin())) return redirect('/error');
        $courses = Course::all();
        $tags = Tag::all();
        return view('pages.edit-question', ['question' => $question, 'courses' => $courses, 'tags' => $tags]);
    }

    /**
     * Creates a new question.
     *
     * @return Question The question created. Redirect 302.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Question::class);

        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'courseList' => 'max:2',
            'courseList.*' => 'distinct',
            'tagList' => 'max:5',
            'tagList.*' => 'distinct',
        ]);

        $result = DB::transaction(function () use ($request) {
            $question = new Question();

            // Add Question
            $question->question_owner_id = Auth::user()->id;
            $question->title = $request->title;
            $question->content = $request->content;
            $question->save();


            // Add Courses and tags
            $tags = $request->get('tagList');
            $courses = $request->get('courseList');

            if ($tags != null) {
                foreach ($tags as $tag) {
                    $question->tags()->attach($tag);
                }
            }

            if ($courses != null) {
                foreach ($courses as $course) {
                    $question->courses()->attach($course);
                }
            }

            return $question;
        });

        // Go to the created question
        if ($result !== null) {
            return redirect()->route('show-question', ['id' => $result]);
        } else {
            return redirect()->route('question');
        }
    }

    /**
     * Updates an existing question.
     */
    public function updateQuestion(Request $request){

      $validated = $request->validate([
        'title' => 'required',
        'content' => 'required',
        'courseList' => 'max:2',
        'courseList.*' => 'distinct',
        'tagList' => 'max:5',
        'tagList.*' => 'distinct',
      ]);

      $result = DB::transaction(function() use($request) {
        $question = Question::find(intval($request->id));

        // Edit Question
        $question->title = $request->title;
        $question->content = $request->content;
        $question->save();


        // Add Courses and tags
        $tags = $request->get('tagList');
        $courses = $request->get('courseList');

        $question->tags()->detach();
        if ($tags != null) {
            foreach ($tags as $tag) {
                $question->tags()->attach($tag);
            }
        }

        $question->courses()->detach();
        if ($courses != null) {
            foreach ($courses as $course) {
                $question->courses()->attach($course);
            }
        }
        return $question;
      });

      if ($result !== null){
        return redirect()->route('show-question',  $result->id);
      } else redirect()->route('edit-question', $request->id);
    }

    // Não sei se é preciso mandar o userId, ou se é poss+ivel obter diretamente o User
    public function delete($questionId)
    {
        $question = Question::find($questionId);

        // If you are not logged in, redirect to the login page
        if (!Auth::check()) return redirect('login');

        $this->authorize('delete', $question);

        // Delete the question from the table
        $question->delete();

        // Return to the search page if the question is sucessfull deleted
        return redirect()->route('search');
    }

    public function voteQuestion(Request $request, $questionId)
    {
        if (!Auth::check()) return redirect('login');

        if ($request->vote !== "1" && $request->vote !== "-1")
            return response()->json(array('success' => false, 'score' => 'ERROR'));

        try {
            $vote = new Vote();

            $vote->user_id = Auth::id();
            $vote->question_id = $questionId;
            $vote->value_vote = $request->vote;

            try {
                $vote->save();

            } catch(\Exception $e) {
                $question = Question::find($questionId);
                $score = $question->score;

                return response()->json(array('success' => false, 'score' => $score));
            }

            $question = Question::find($questionId);
            $score = $question->score;

            return response()->json(array('success' => true, 'score' => $score));
        } catch(QueryException $e) {
            $question = Question::find($questionId);
            $score = $question->score;

            return response()->json(array('success' => false, 'score' => $score));
        }
    }

    public function voteAnswer(Request $request, $questionId, $answerId)
    {
        if (!Auth::check()) return redirect('login');

        if($request->vote !== "1" && $request->vote !== "-1") return redirect()->route('show-question', ['id' => $questionId]);

        try {
            $vote = new Vote();

            $vote->user_id = Auth::id();
            $vote->answer_id = $answerId;
            $vote->value_vote = $request->vote;

            try {
                $vote->save();

            } catch(\Exception $e) {
                $answer = Answer::find($answerId);
                $score = $answer->score;

                return response()->json(array('success' => false, 'score' => $score));
            }

            $answer = Answer::find($answerId);
            $score = $answer->score;

            return response()->json(array('success' => true, 'score' => $score));
        } catch(QueryException $e) {
            $answer = Answer::find($answerId);
            $score = $answer->score;

            return response()->json(array('success' => false, 'score' => $score));
        }
    }
}
