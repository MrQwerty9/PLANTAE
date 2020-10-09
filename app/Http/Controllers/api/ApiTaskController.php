<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class ApiTaskController extends Controller
{
	function index(Request $request)
	{
		$task = \App\Models\Task::get();
		$meta = [
			'code' => Response::HTTP_OK,
			'message' => 'Success'
		];
		return response()->json(['meta' => $meta, 'data' => $task]);
	}

	function getByName(Request $request)
	{
		$task = \App\Models\Task::where('name', $request->name)->get();
		$meta = [
			'code' => Response::HTTP_OK,
			'message' => 'Success'
		];
		return response()->json(['meta' => $meta, 'data' => $task]);
	}

	function create(Request $request)
	{
		// echo(json_encode($request->name));
		// return;	
		$file = $request->file('file');
		$destination_path = public_path('/transaction_image');
		$nameFile = 'tugas-' . $request->name . "." . $file->getClientOriginalExtension();
		$file->move($destination_path, $nameFile);
		$request['task'] = $nameFile;
		// echo(json_encode($request->task));
		// return;	
		\App\Models\Task::create($request->except(['_token']));
		$meta = [
			'code' => Response::HTTP_OK,
			'message' => 'Success'
		];
		return response()->json(['meta' => $meta]);
	}

	function delete(Request $request)
	{
		$taskName = \App\Models\Task::select('task')->where('id', $request->id)->first();
		$destination_path = public_path('\transaction_image');
		// echo(json_encode($destination_path+'/'+$taskName));
		echo $destination_path,'/',$taskName->task;
		// return;
		
		// Storage::delete(public_path('/transaction_image/tugas-shol.pdf'));
		unlink($destination_path."/".$taskName->task);
		$task = \App\Models\Task::where('id', '=', $request->id)->delete();
		$meta = [
			'code' => Response::HTTP_OK,
			'message' => 'Success'
		];
		return response()->json(['meta' => $meta]);
	}
}
