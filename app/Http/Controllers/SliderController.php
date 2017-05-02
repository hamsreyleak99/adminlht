<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
	 *The information we send to the view
	 *@var array
	 */
	protected $data = []; 
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
   	
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $this->data['title'] = 'Slider';
        return view('pages.slider',$this->data);
    }
    /**
	 * Get a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get()
	{
		$sliders = Slider::all()->sortByDesc('id')->values()->all();

		return Response()->Json($sliders);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$slidersRequest = json_decode($request->input('slider'));

		foreach ($slidersRequest as $key => $sliderRequest) {
			try {

				$sliderObject = new Slider();

				$sliderObject->title 			= 	$sliderRequest->title;
				$sliderObject->description 		= 	$sliderRequest->description;
				$sliderObject->status          	=   $sliderRequest->status;
				$sliderObject->created_by      	=   auth::id();
				$sliderObject->updated_by      	=   auth::id();

				$sliderObject->save();

				$slidersResponse[] = $sliderObject;

			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($slidersResponse);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$slidersResponse = json_decode($request->input('slider'));

		foreach ($slidersResponse as $key => $sliderRequest) {
			try {

				$sliderObject = slider::findOrFail($sliderRequest->id);
				
				$sliderObject->title 				= 	$sliderRequest->title;
				$sliderObject->description 		= 	$sliderRequest->description;
				$sliderObject->status          	=   $sliderRequest->status;
				$sliderObject->updated_by      	=   auth::id();

				$sliderObject->save();

				$slidersResponse[] = $sliderObject;
					
			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($slidersResponse);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$slidersRequest = json_decode($request->input('slider'));

		foreach ($slidersRequest as $key => $sliderRequest) {
			try {

				$sliderObject = Slider::findOrFail($sliderRequest->id);

				$sliderObject->delete();

				$slidersResponse[] = $sliderRequest;

					
			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($slidersResponse);
	}
}
