<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Capturer;
use App\Model\ToiletInfo;
use Illuminate\Http\Request;
use Session;

class RequestController extends Controller
{
    private $url = 'admin.request.';
    public function index()
    {
        $data = [
            'allRequests' => Capturer::where('status','0')->get(),
            'allActives' => Capturer::where('status','1')->get(),
            'allDeactives' => Capturer::where('status','-1')->get()
        ];
        $data = (object) $data;     //convert array into obj 

        return view($this->url.'index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $status = $id;
        $owners = Capturer::where('status','=',$id)->get();

        return view($this->url.'show',compact('owners','status'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $edit = Capturer::find($id);
        if($request->btn=='1'){
            $edit->status = '1';
            $msg = 'Owner '.$edit->email.' has been successfully approved';
        }
        if($request->btn=='-1'){
            $edit->status = '-1';
            $remove = ToiletInfo::where('owner_id',$id)->get();
            $remove->each->delete();
            $msg = 'Owner '.$edit->email.' has been successfully denied';
        }
        $edit->save();
        return back()->with('a.toast',$msg);
    }

    public function destroy($id)
    {
        $delete = Capturer::find($id);
        $msg = 'Owner '.$delete->email.' has been successfully denied';
        $delete->delete();
        return back()->with('a.toast',$msg);
    }
}
