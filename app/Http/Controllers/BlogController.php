<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades;

use App\Blog;
use Storage;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale = null)
    {
        $blogs = Blog::paginate(2);

        return view('blog.index',['blogs'=>$blogs]);
    }

    public function all_views()
    {
        //
        $blogs = Blog::all();
        return view('blog.all-views',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog;

        //Image 1 storage
        $path = Storage::disk('uploads')->putfile('img',$request->file('image'));
        $blog->image= $path;

        //Image2 Storage
        if ($request->image2) {
            $path = Storage::disk('uploads')->putfile('img',$request->file('image2'));
        }

        foreach (config('app.available_locales') as $locale) 
        {
            $blog 
            ->setTranslation('title', $locale, $request->{$locale.'_title'})
            ->setTranslation('content', $locale, $request->{$locale.'_content'})
            ->setTranslation('notes', $locale, $request->{$locale.'_notes'})
            ->setTranslation('image_notes', $locale, $request->{$locale.'_image_notes'})
            ->setTranslation('image2_notes', $locale, $request->{$locale.'_image2_notes'});
        }
        
        $blog->save();
            
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale = null,$id)
    {
        $blog = Blog::find($id);

        $path = url()->current();
        
        return view('blog.show',['blog'=>$blog,'path'=>$path]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.edit',['blog' => $blog]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        //Image 1 Storage
        $path = Storage::disk('uploads')->putfile('img',$request->file('image'));
        $blog->image= $path;

        //Image 2 Storage
         if ($request->image2) {
            $path = Storage::disk('uploads')->putfile('img',$request->file('image2'));
        }
        
        foreach (config('app.available_locales') as $locale) 
        {
            $blog 
            ->setTranslation('title', $locale, $request->{$locale.'_title'})
            ->setTranslation('content', $locale, $request->{$locale.'_content'})
            ->setTranslation('notes', $locale, $request->{$locale.'_notes'})
            ->setTranslation('image_notes', $locale, $request->{$locale.'_image_notes'})
            ->setTranslation('image2_notes', $locale, $request->{$locale.'_image2_notes'});
        }
        
        $blog->update();

        return redirect()->route('admin');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->route('admin');
    }

}
