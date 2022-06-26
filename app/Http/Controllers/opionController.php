<?php

namespace App\Http\Controllers;

use App\Helper\imageResizer;
use App\Models\opinionTopic;
use App\Models\studentOpinion;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

class opionController extends Controller
{

    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    public function create(Request $request) {


        if ($image = $request->file('file')) {
            $getImageName = imageResizer::ResizeImage($image, 'thumbnail', 'thumbnail', 500, 500);

            //store your file into directory and db


            $opiniTopic = opinionTopic::create([
                'title' => $request->title,
                'thumbnail' => $getImageName,
                'topicMaker' => $request->topicMaker,
                'totalOpinion' => 0,
                'totalPositifOpinion' => 0,
                'totalNegatifOpinion' => 0,
                'content' => $request->content,
            ]);

          
            
        }else{
            $opiniTopic = opinionTopic::create([
                'title' => $request->title,
                'thumbnail' => "dummy.png",
                'topicMaker' => $request->topicMaker,
                'totalOpinion' => 0,
                'totalPositifOpinion' => 0,
                'totalNegatifOpinion' => 0,
                'content' => $request->content,
            ]);
        }
      
        return response()->json($opiniTopic);
        
        

    }

    public function createOpinion(Request $request) {
        $validator = Validator::make($request->all(), [
            'reason' => ['required'],
            
        ]);

        $listStudentOpinion = studentOpinion::where('users_id',Auth::id())->where('opiniTopic_id', $request->opiniTopic_id)->first();
        if($listStudentOpinion !== null ) {
            return  response()->json([
                'message' => 'Anda sudah pernah mengisi pendapat',
                'success' => false,

            ], 200);
        }   

        

        $stundentOpinion = studentOpinion::create([
            'users_id' => Auth::id(),
            'opiniTopic_id' => $request->opiniTopic_id,
            'reason' => $request->reason,
            'isPositifOpini' => $request->isPositifOpini
        ]);

        $opiniTopic = opinionTopic::where('id', $request->opiniTopic_id)->first();
        $opiniTopic->totalOpinion = $opiniTopic['totalOpinion'] + 1;

        if($request->isPositifOpini == true) {
            $opiniTopic->totalPositifOpinion = $opiniTopic['totalPositifOpinion'] + 1;

        }else{
            $opiniTopic->totalNegatifOpinion = $opiniTopic['totalNegatifOpinion'] + 1;

        }
        $opiniTopic->save();

        return  response()->json([
            'message' => 'sukses',
            'success' => true,
            
        ], 200);





    }

    public function showTopic(){
         $opiniTopic = opinionTopic::all();
        return  response()->json($opiniTopic, 200);


    }

    public function detailTopic($id) {
        $opiniTopic = opinionTopic::findOrFail($id);
        return  response()->json($opiniTopic, 200);
    }

    public function getStudentOpinion($id) {

        $opiniTopic = studentOpinion::where("opiniTopic_id",$id)->with('Users')->get();

        return  response()->json($opiniTopic, 200);

    }


}
