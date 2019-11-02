<?php

namespace App\Http\Controllers;

use Carbon;
use App\Menu;
use Illuminate\Http\Request;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // protected $maxAttempts = 3;
    public function index()
    {
        return view('admin/Menu', ['tables'=>Menu::all()]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task = Menu::create($request->all());
        return back()->with('success', 'Menu Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($menu)
    {
        //
        return Menu::find($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $task = Menu::find($id);
        Menu::destroy($id);
        return back()->with('success', 'Menu Deleted');
    }
    public function active(Request $request)
    {
        //
        $id = $request->id;
        $task = Menu::find($id);
        $task->active = $request->binary;
        $task->save();
        return back()->with('success', 'Menu '.$request->activ);
    }
    public function feat(Request $request)
    {
        //
        $id = $request->id;
        $task = Menu::find($id);
        // dd($request);
        $task->feat = $request->binary;
        $task->save();
        return back()->with('success', 'Menu Feature Change');
    }
}
