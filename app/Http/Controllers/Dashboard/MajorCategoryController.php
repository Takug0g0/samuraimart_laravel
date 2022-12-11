<?php

namespace App\Http\Controllers\Dashboard;

use App\MajorCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $major_categories = MajorCategory::paginate(15);
        
        return view('dashboard.major_categories.index', compact('major_categories'));
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
        $request->validate([
            'name' => 'requiredlunique:major_categories',
            'description' => 'required'
        ],
        [
            'name.required' => '親カテゴリ名は必須です。',
            'name.unique' =>'親カテゴリ名「' . $request->input('name') .'」は登録済みです。',
            'description.required' => '親カテゴリの説明は必須です。',
        ]);
            
        $major_Category = new MajorCategory();
        $major_Category->name = $request->input('name');
        $major_Category->description = $request->input('description');
        $major_Category->save();
            
        return redirect("/dashboard/major_categories");
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MajorCategory  $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MajorCategory $majorCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MajorCategory  $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MajorCategory $majorCategory)
    {
        return view('dashboard.major_categories.edit', compact('major_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MajorCategory  $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MajorCategory $majorCategory)
    {
        $request->validate([
            'name' => 'requiredlunique:major_categories',
            'description' => 'required'
        ],
        [
            'name.required' => '親カテゴリ名は必須です。',
            'name.unique' =>'親カテゴリ名「' . $request->input('name') .'」は登録済みです。',
            'description.required' => '親カテゴリの説明は必須です。',
        ]);
            
        $major_Category->name = $request->input('name');
        $major_Category->description = $request->input('description');
        $major_Category->update();
            
        return redirect("/dashboard/major_categories");   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MajorCategory  $majorCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorCategory $majorCategory)
    {
        $major_category->delete();
        
        return redirect("/dashboard/major_categories");
    }
}
