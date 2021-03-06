<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Controllers\Helpers\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        // check Language
        Language::checkLang($request->lang);
        // get language
        $lang = Language::getTitleLang();

        $event = new Event();

        $datas = $event->where('lang', '=', $lang)->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.events.event', array('datas' => $datas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        /*validation image*/        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $listLang = config('app.locales');
        $id_table = Event::max('id_table')+1;

        foreach ($listLang as $key => $value) {

            $event = new Event();
            /*check has file and validation image  */
            if($request->hasFile("image")){
                if($validator->passes()){

                    $image = $request->file('image');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ));

                    $event->image = $filename;
                }else{
                    return Response()->json(['error'=>$validator->errors()->all()]);
                }
            }
            $event->id_table = $id_table;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->status = $request->status;
            $event->lang = $key;
            $event->created_by = Auth::id();
            $event->updated_by = Auth::id();
            $event->save();
        }
        
        return redirect('/event');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($event_id)
    {
        $event = Event::find($event_id);
        return Response()->Json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id)
    {
        $event = Event::find($event_id);

        /*validation image*/        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        /*check has file and validation image  */
        if($request->hasFile("image")){
            if($validator->passes()){

                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ));

                $event->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $event->title = $request->title;
        $event->description = $request->description;
        $event->status = $request->status;
        $event->updated_by = Auth::id();
        $event->save();
        return redirect('/event');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {

        $event = new Event();
        $event->where('id_table', '=', $event_id)->delete();
        return Response()->Json($event);
    }
}
