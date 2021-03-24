<?php

namespace App\Http\Controllers\Capturer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\City;
use App\Model\Country;
use App\Model\State;
use App\Model\Studio;
use App\Model\Capturer;
use Auth;
use Illuminate\Http\Request;
class StudioController extends Controller
{
    private $url = 'capturer.studio.';
    public function index()
    {
        $thisOwner = Capturer::where('id',Auth::user()->id)->get();
        $studios = Studio::where('owner_id','=',Auth::user()->id)->with('owner')->get();
        $countries = Country::orderBy('country')->get();
        return view($this->url.'index',compact('studios','countries','thisOwner'));
    }

    public function show($id)
    {
        if(request()->input('country_id')) {
            $states = State::where('country_id',request()->input('country_id'))->orderBy('state')->get();
            if(count($states)>0) {
                $data='<option value="">-select governance-</option>';
                foreach ($states as $state) {
                    $data = $data.'<option value="'.$state->id.'">'.$state->state.'</option>';
                }
                return $data;
            }
            else return $data=0;
        }
        if(request()->input('state_id')) {
            $cities = City::where('state_id',request()->input('state_id'))->orderBy('city')->get();
            if(count($cities)>0) {
                $data='<option value="">-select city-</option>';
                foreach ($cities as $city) {
                    $data = $data.'<option value="'.$city->id.'">'.$city->city.'</option>';
                }
                return $data;
            }
            else return $data=0;
        }

        $toilet = Studio::where('id','=',$id)->where('owner_id','=',Auth::user()->id)->get();
        $datas = [
            'countries' => Country::orderBy('country')->get(),
            'states' => State::where('country_id',$toilet[0]['country_id'])->orderBy('state')->get(),
            'cities' => City::where('state_id',$toilet[0]['state_id'])->orderBy('city')->get(),
        ];
        $datas = (object)$datas;
        return view($this->url.'show',compact('toilet','datas'));
    }

    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'studioname'   => 'required|unique:studios,studio_name',
            'complexname' => 'required',
            'address' => 'required',
            'studioprice' => 'required|min:0',
        ],
        [
            'studioname.required' => 'Please enter a studio name',
            'studioname.unique' => 'This name is already in use, try another',
            'complexname.required' => 'Please enter complex name of your studio',
            'address.required' => 'Please enter address of your studio',
            'studioprice.required' => 'Minimum value is 0',
            'studioprice.min' => 'Minimum value is 0',
        ] );

        if($validate->fails())
        {
            return (back()->withInput($request->all())->withErrors($validate));
        }

        $studio = new Studio;
        $studio->owner_id = Auth::user()->id;
        $studio->studio_name = $request->studioname;
        // $studio->status = $request->studiostatus;
        // $studio->price = $request->studioprice;
        // $studio->type = $request->studiotype;
        // $studio->complex_name = $request->complexname;
        $studio->studio_address = $request->address;
        // $studio->country_id = $request->country;
        // $studio->type = $request->studiotype;
        // $studio->state_id = $request->state;
        // $studio->city_id = $request->city;
        $studio->studio_lat = $request->newLat;
        $studio->studio_lng = $request->newLng;
        $studio->save();
        return back()->with('toast.o','Studio '.$request->toiletname.' created');
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'toiletname'   => 'required|unique:toilet_infos,toilet_name,'.$id,
            'complexname' => 'required',
            'address' => 'required',
            'toiletprice' => 'required|min:0',
        ],
        [
            'toiletname.required' => 'Please enter a toilet name',
            'complexname.required' => 'Please enter complex name of your toilet',
            'address.required' => 'Please enter address of your toilet',
            'toiletprice.required' => 'Minimum value is 0',
            'toiletprice.min' => 'Minimum value is 0',
        ] );

        if($validate->fails())
        {
            return back()->withInput($request->all())->withErrors($validate);
        }

        $toilet = Studio::find($id);
        $toilet->toilet_name = $request->toiletname;
        $toilet->price = $request->toiletprice;
        $toilet->complex_name = $request->complexname;
        $toilet->address = $request->address;
        $toilet->country_id = $request->country;
        $toilet->state_id = $request->state;
        $toilet->city_id = $request->city;
        $toilet->toilet_lat = $request->newLat;
        $toilet->toilet_lng = $request->newLng;
        $toilet->type = $request->toilettype;
        $toilet->status = $request->toiletstatus;
        $toilet->save();
        return redirect(route('toilets.index'))->with('toast.o','Toilet '.$request->toiletname.' updated');
    }

    public function destroy($id)
    {
        $delete = Studio::find($id);
        $toilet = $delete->toilet_name;
        $delete->delete();
        return back()->with('toast.o','Toilet '.$toilet.' deleted!');
    }
}
