<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::paginate(8);
        return \view('item.index',\compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        return \view('item.create',\compact('categories'));
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
            'category_id'=> 'required',
            'name'=>['required', 'string', 'max:255'],
            'minVal'=>['required', 'decimal', 'max:255'],
        ]);

        if($request->picture) $picture=\imageConvert("Item",$request->picture);
        else $picture=NULL;

        $data['slug']=\slug('it');
        $data['picture']=$picture;

        Item::create(
            $data
        );

        return back()->with('success','Ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return \view('item.show',\compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return \view('item.edit',\compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $data=$request->validate([
            'category_id'=> 'required',
            'name'=>['required', 'string', 'max:255'],
            'minVal'=>['required', 'decimal', 'max:255'],
        ]);

        if($request->picture) $picture=\imageConvert("Item",$request->picture);
        else $picture=$request->pictureOld;

        $data['picture']=$picture;

        $item->update(
            $data
        );

        return back()->with('success','Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return \back()->with('succes','Effacé');
    }
}
