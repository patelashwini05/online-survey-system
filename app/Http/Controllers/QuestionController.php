<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionController extends Controller
{
    public function add(Request $request){
        $question = new Question();
        $question->survey_id = $request->survey_id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->question_type = $request->question_type;
        $question->status = $request->status;
        $question->save();

        if($question){
            foreach($request->question_options as $key=>$value){
               foreach($request->question_options[$key] as $key=>$value){
                    $questionOption = new QuestionOption();
                    $questionOption->question_id = $question->id;
                    $questionOption->option_value = $value;
                    $questionOption->save();
               }
            }
        }

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Question added successfully.',
        ],Config('constants.validResponse.statusCode'));

    }

    public function list(){
        $questionlist = Question::with('questionOptions')->get();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got question list successfully.',
            'data'      => $questionlist
        ],Config('constants.validResponse.statusCode'));
    }

    public function edit(Request $request){
        $questiondetails = Question::with('questionOptions')->where('questions.id',$request->id)->first();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got question details successfully',
            'data'      => $questiondetails
        ],Config('constants.validResponse.statusCode'));

    }

    public function update(Request $request){
        $id = $request->id;
        $question = Question::find($id);
        $question->survey_id = $request->survey_id;
        $question->title = $request->title;
        $question->description = $request->description;
        $question->question_type = $request->question_type;
        $question->status = $request->status;
        $question->save();

        if($question){
            foreach($request->question_options as $key=>$value){
               foreach($request->question_options[$key] as $key=>$value){
                    $questionOption = new QuestionOption();
                    $questionOption->question_id = $question->id;
                    $questionOption->option_value = $value;
                    $questionOption->save();
               }
            }
        }

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Question updated successfully.',
        ],Config('constants.validResponse.statusCode'));
    }

    public function delete(Request $request){
        $question = Question::where('id',$request->id)->delete();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Question deleted successfully',
        ],Config('constants.validResponse.statusCode'));

    }

    public function fetchQuestion(Request $request){
        $question = Question::with('questionOptions')->where('survey_id',$request->survey_id)->get();
        // dd($question);

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got question successfully',
            'data'      => $question
        ],Config('constants.validResponse.statusCode'));

    }
}
