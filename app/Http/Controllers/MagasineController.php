<?php

namespace App\Http\Controllers;

use App\Models\Magasine;
use Illuminate\Http\Request;
use Spatie\LaravelIgnition\Solutions\SolutionProviders\ViewNotFoundSolutionProvider;

class MagasineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magasines=Magasine::paginate(8);
        return \view('magasine.index', \compact('magasines'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('magasine,create');
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
            'name'=>['required','string','max:50'],
            'adress'=>['required'],
            'contact'=>['required']
        ]);

        if($request->picture) $picture=\imageConvert("Logo",$request->picture);
        else $picture=NULL;

        $data['picture']=$picture;
        $data['slug']=\slug('Mag');

        Magasine::create($data);

        return \back()->with('success','Ajouté');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magasine  $magasine
     * @return \Illuminate\Http\Response
     */
    public function show(Magasine $magasine)
    {
        return \view('magasine.show', \compact('magasine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magasine  $magasine
     * @return \Illuminate\Http\Response
     */
    public function edit(Magasine $magasine)
    {
        return \view('magasin.edit',\compact('magasine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magasine  $magasine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magasine $magasine)
    {
        $data=$request->validate([
            'name'=>['required','string','max:50'],
            'adress'=>['required'],
            'contact'=>['required']
        ]);

        if($request->picture) $picture=\imageConvert("Logo",$request->picture);
        else $picture=$request->pictureOld;

        $data['picture']=$picture;

        Magasine::create($data);

        return \back()->with('success','Modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magasine  $magasine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magasine $magasine)
    {
        $magasine->delete();
        return \back()->with('success','Effacé');
    }
}
