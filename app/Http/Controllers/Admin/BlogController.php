<?php

namespace App\Http\Controllers\Admin;

use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BlogController extends Controller
{
    use SaveImageTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->except('_token');
        if ($request->hasFile('images')){
            $names = [];
            foreach($request->file('images') as $image)
            {
                $image_path = $this->uploadImage($image, 'blog');
                array_push($names, $image_path);          
            }
            $data['images'] = json_encode($names);
        }

        if(isset($request->blog_id)){
            $blog = Blog::find($request->blog_id); 
            $blog->update($data);
        }else{
            Blog::create($data);
        }
        return back();
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
 
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy(Request $request, $id)
    {
        $blog = Blog::find($request->blog_id);
        $blog->delete();
        return back();
    }
}
