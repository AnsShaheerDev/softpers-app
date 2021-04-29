<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\FileUploaded;
use App\Models\UserFile;
use App\Models\UserFileData;

use Auth;
use Storage;
class DataController extends Controller
{
    public function index(Request $request){
        $data['files'] = UserFile::where('user_id',Auth::id())->orderBy('updated_at','desc')->simplePaginate(10);
    	return view('upload-file')->with('data',$data);
    }

    public function store(Request $request){
    	$validated = $request->validate([
    		'file' => 'required|file|mimes:csv,xlsx',
    	]);
    	$extension = $request->file('file')->extension();
    	if($path = $request->file('file')->storeAs(Auth::id().'/files',Auth::id().'-'.time().'.'.$extension,'public')){
    		$file = new UserFile(['path' => $path]);
    		Auth::User()->files()->save($file);

            FileUploaded::dispatch($file);
    		$request->session()->flash('success', 'File upload was successful!');
    		return redirect()->back();
    	}
    }

    public function downloadFile(Request $request){
        return Storage::disk('public')->download($request->path);
    }

    public function getData(Request $request){
        $data['headers'] = UserFileData::where('user_id',Auth::id())->where('user_file_id',$request->file_id)->select('key')->distinct()->get()->pluck('key')->toArray();
        $data['values'] = UserFileData::where('user_id',Auth::id())->where('user_file_id',$request->file_id)->select('row_number','key','value')->get();

        $total_rows = UserFileData::where('user_id',Auth::id())->where('user_file_id',$request->file_id)->select('row_number')->orderBy('row_number','desc')->first();
        $data['total_rows'] = $total_rows->row_number;
        //dd($data['total_rows']);
        //dd($data['values']);
        return view('file-data')->with('data',$data);
    }
}
