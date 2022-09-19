<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use Validator;

class SurveyController extends Controller
{
    public function list(){
        $survey = Survey::get();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got survey list successfully.',
            'data'      => $survey
        ],Config('constants.validResponse.statusCode'));
    }

    public function add(Request $request){
        $validator = validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],401);
        }

        Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Survey added successfully.',
        ],Config('constants.validResponse.statusCode'));

    }

    public function edit(Request $request){
        $surveydetails = Survey::where('id',$request->id)->first();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Got survey details successfully.',
            'data'      => $surveydetails
        ],Config('constants.validResponse.statusCode'));

    }

    public function update(Request $request){
        $validator = validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ],401);
        }

        Survey::where('id',$request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Survey updated successfully.',
        ],Config('constants.validResponse.statusCode'));
    }

    public function delete(Request $request){
        $survey = Survey::where('id',$request->id)->delete();

        return response()->json([
            'success'   => Config('constants.validResponse.success'),
            'message'   => 'Survey deleted successfully.',
        ],Config('constants.validResponse.statusCode'));
    }
}
