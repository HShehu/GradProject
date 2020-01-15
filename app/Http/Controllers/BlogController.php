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

        return view('blogs.index', ['blogs'=>$blogs]);
    }

    public function all_views()
    {
        //
        $blogs = Blog::all();
        return view('blog.all-views', ['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $locale)
    {

        // Validate Fields

        $request->validate([
            'title.*' => 'required|unique_translation:blogs',
            'content.*' => 'required',
            'notes.*' => 'nullable',
            'image_notes.*' => 'nullable',
            'image_notes2.*' => 'nullable',
            'image' => 'required|image',
            'image2' => 'nullable|image',
        ]);
        
        //Store Fields

        $blog = new Blog;

        //Image 1 storage
        $path = Storage::disk('uploads')->putfile('img', $request->file('image'));
        $blog->image= $path;

        //Image2 Storage
        if ($request->image2) {
            $path = Storage::disk('uploads')->putfile('img', $request->file('image2'));
            $blog->image2 = $path;
        }
     
        
        foreach (config('app.available_locales') as $locale) {
            $blog
            ->setTranslation('title', $locale, $request->title[$locale])
            ->setTranslation('content', $locale, $request->content[$locale])
            ->setTranslation('notes', $locale, $request->notes[$locale])
            ->setTranslation('image_notes', $locale, $request->image_notes[$locale])
            ->setTranslation('image2_notes', $locale, $request->image2_notes[$locale]);
        }
        
        $blog->save();
            
        return redirect()->route('admin',['locale' => app()->getLocale()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale = null, $id)
    {
        $blog = Blog::findOrFail($id);

        $path = url()->current();
        
        return view('blogs.show', ['blog'=>$blog,'path'=>$path]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($locale, $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', ['blog' => $blog]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $locale, $id)
    {
        
        $blog = Blog::findOrFail($id);

        // Validate Fields

        // dd($blog);
        $request->validate([
            'title.*' => "required|unique_translation:blogs,title,$blog->id",
            'content.*' => 'required',
            'notes.*' => 'nullable',
            'image_notes.*' => 'nullable',
            'image_notes2.*' => 'nullable',
            'image' => 'required|image',
            'image2' => 'nullable|image',
        ]);
        
        //Update Fields

        //Image 1 Storage
        $path = Storage::disk('uploads')->putfile('img', $request->file('image'));
        $blog->image= $path;

        //Image 2 Storage
        if ($request->image2) {
            $path = Storage::disk('uploads')->putfile('img', $request->file('image2'));
        }
        
        foreach (config('app.available_locales') as $locale) {
            $blog
            ->setTranslation('title', $locale, $request->title[$locale])
            ->setTranslation('content', $locale, $request->content[$locale])
            ->setTranslation('notes', $locale, $request->notes[$locale])
            ->setTranslation('image_notes', $locale, $request->image_notes[$locale])
            ->setTranslation('image2_notes', $locale, $request->image2_notes[$locale]);
        }
        
        $blog->update();

        return redirect()->route('admin',['locale' => app()->getLocale()]);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    public function destroy($locale, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin',['locale' => app()->getLocale()]);
    }
}
