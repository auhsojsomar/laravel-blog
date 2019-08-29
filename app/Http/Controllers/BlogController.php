<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use App\User;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('blogs.index', compact('blogs'));
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            $fileToStore = $fileName. '.' .time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/image', $fileToStore);
        }
        else {
            $fileToStore = 'noimage.jpg';
        }

        $blog = new Blog;
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->cover_image = $fileToStore;
        $blog->save();

        return redirect('blogs')->with('success','Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        if(auth()->user()->id != $blog->user_id){
            return redirect('/blogs')->with('error', 'Unauthorized');
        }
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            $fileToStore = $fileName. '.' .time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/image', $fileToStore);
        }

        $blog = Blog::find($id);
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        if($request->hasFile('cover_image')){
            if($blog->cover_image != 'noimage.jpg'){
                Storage::delete('public/image/'.$blog->cover_image);
            }
            $blog->cover_image = $fileToStore;
        }
        $blog->save();

        return redirect('blogs')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        if($blog->cover_image != 'noimage.jpg'){
            Storage::delete('public/image/'.$blog->cover_image);
        }

        return redirect('blogs')->with('success', 'Data Deleted');
    }
}
