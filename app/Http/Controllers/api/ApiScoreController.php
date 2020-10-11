<?php

namespace App\Http\Controllers\api;

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluation = \App\Models\EvaluationScore::get();
        if ($evaluation) {
            $meta = [
                'code' => Response::HTTP_OK,
                'message' => 'Success'
            ];
        }else{
            $meta = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Filed'
            ];
        }
        return response()->json(['meta' => $meta, 'data' => $evaluation]);
    }

    function getByName(Request $request)
	{
		$evaluation = \App\Models\EvaluationScore::where('name', $request->name)->get();
		if ($evaluation) {
            $meta = [
                'code' => Response::HTTP_OK,
                'message' => 'Success'
            ];
        }else{
            $meta = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Filed'
            ];
        }
		return response()->json(['meta' => $meta, 'data' => $evaluation]);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evaluation = \App\Models\EvaluationScore::create($request->except(['_token']));

		if ($evaluation) {
            $meta = [
                'code' => Response::HTTP_OK,
                'message' => 'Success'
            ];
        }else{
            $meta = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Filed'
            ];
        }
		return response()->json(['meta' => $meta]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = \App\Models\EvaluationScore::where('id', '=', $id)->delete();
        if ($evaluation) {
            $meta = [
                'code' => Response::HTTP_OK,
                'message' => 'Success'
            ];
        }else{
            $meta = [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Filed'
            ];
        }
		return response()->json(['meta' => $meta]);
    }
}
