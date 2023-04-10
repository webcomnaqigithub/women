<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use SaveImageTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('image')){
            $data['image'] = $this->uploadImage($request->image, 'slider');
        }
        if(isset($request->slider_id)){
            $slider = Slider::find($request->slider_id);
            $slider->update($data);
        }else{
            Slider::create($data);
        }
        return back();
    }

    public function destroy(Request $request, $id)
    {
        $blog = Slider::find($request->slider_id);
        $blog->delete();
        return back();
    }
}
