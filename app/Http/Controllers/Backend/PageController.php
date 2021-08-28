<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.Pages.index');
        $pages = Page::latest('id')->get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.Pages.create');
        return view('backend.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.Pages.create');
        // validation Page
        $this->validate($request,[
           'title'            => 'required|string|unique:pages',
           'excerpt'          => 'required|string|unique:pages',
           'body'             => 'required|string',
           'meta_description' => 'required',
           'meta_keywords'    => 'required',
           'image'            => 'required|image',

        ]);

        // Pages Basic Info
        $page = Page::create([
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'excerpt'          => $request->excerpt,
            'body'             => $request->body ,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'status'           => $request->filled('status'),
        ]);

        //upload page image
        if ($request->hasFile('image')){
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success("Page Added Successful","Success");
        return redirect()->route('app.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        Gate::authorize('app.Pages.edit');
        return view('backend.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        Gate::authorize('app.Pages.edit');
        //Pages Basic Info Validation.
        $this->validate($request,[
            'title'            => 'required|string|unique:pages,title,'.$page->id,
            'excerpt'          => 'required|string|unique:pages,excerpt,'.$page->id,
            'body'             => 'required|string',
            'meta_description' => 'required',
            'meta_keywords'    => 'required',
            'image'            => 'nullable|image',
        ]);
        // Page Basic Info Update
        $page->update([
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'excerpt'          => $request->excerpt,
            'body'             => $request->body ,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'status'           => $request->filled('status'),
        ]);

        //upload page image Update
        if ($request->hasFile('image')){
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        notify()->success("Page Updated Successful","Success");
        return redirect()->route('app.pages.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        Gate::authorize('app.Pages.destroy');
        $page->delete();
        notify()->success("Page Delete Successful","Success");
        return back();
    }
}
