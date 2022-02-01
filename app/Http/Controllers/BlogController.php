<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Blog::all();
        foreach ($data as $blog) {
            $blog->created_at =  $blog->created_at->format('d-m-Y');
            $blog->creation = $blog->created_at->format('d-m-Y');
        }
        // dd($data);

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<div class="d-flex align-items-center justify-content-center">
                    <a href="/show/' . $row->id . '" class="edit btn btn-outline-success btn-sm mx-1">
                    <i class="far fa-eye"></i>
                    </a>
                    <a href="/update/' . $row->id . '" class="edit btn btn-outline-primary btn-sm mx-1">
                    <i class="fas fa-pen"></i>
                    </a>
                    <a href="/delete/' . $row->id . '" class="edit btn btn-outline-danger btn-sm mx-1">
                    <i class="far fa-trash-alt"></i>
                    </a>
                    </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('blog.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $this->validate($request, [
            'author' => 'required',
            'title' => 'required',
            'image' => 'required',
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalname = microtime() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/images', $originalname);
        }


        $blog = Blog::create([
            'author' => $request->author,
            'title' => $request->title,
            'image' => $originalname,
            'body' => $request->body,
        ]);

        // dd('data stored', $blog);
        // $imageLink = url("/images/{$blog->image}");

        // array_push($blog,$imageLink);
        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog = null, $id = null)
    {
        // dd($blog, $id);
        // dd($id);
        if ($blog == null && $id != null) {

            $blog = Blog::find($id);
            // dd($blog);
        }

        return view('blog.detail', ['blog' => $blog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blog.update', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if ($request->id != null) {
            
            $blog = Blog::find($request->id);
            $blog->author = $request->author;
            $blog->title = $request->title;
            $blog->body = $request->body;

            // dd($blog);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalname = microtime() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/images', $originalname);
                $blog->image  = $originalname;
            }

            $blog->save();

            return redirect('/');
        }


        // dd("here");
        // dd($request->image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect('/');
    }
}
