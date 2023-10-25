<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::get();
        return \view('category.index', \compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>['required','string','max:255'],
            'description'=>['required','string','max:255']
        ]);

        if($request->picture) $picture=\imageConvert("Category",$request->picture);
        else $picture=NULL;

        $data['picture']=$picture;
        $data['slug']=\slug('Cat');

        Category::create(
            $data
        );

        return \back()->with('success','Ajouter');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return \view('category.edit','category');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return \view('category.edit','category');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data=$request->validate([
            'name'=>['required','string','max:255'],
            'description'=>['required','string','max:255']
        ]);

        if($request->picture) $picture=\imageConvert("Category",$request->picture);
        else $picture=$request->pictureOld;

        $data['picture']=$picture;

        $category->update(
            $data
        );

        return \back()->with('success','Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','supprimé');
    }
}
