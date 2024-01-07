<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessionId = session()->getId();
        return response()->view('categories.create',compact('sessionId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $data = array();
        $data['name']=$request->categoryname;
        $data['slug']=$request->slug;
        // insert only requests that already validated in the StoreRequest
        $create = Category::create($data);
       
        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Category created successfully!');
            return redirect()->route('categories.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->view('categories.show', [
            'category' => Category::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->view('categories.edit', [
            'category' => Category::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $data = array();
        $data['name']=$request->categoryname;
        $data['slug']=$request->slug;
        $data['user_id'] =auth()->id();
        $update = $category->update($data);

        if($update) {
            session()->flash('notif.success', 'Category updated successfully!');
            return redirect()->route('categories.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $delete = $category->delete($id);

        if($delete) {
            session()->flash('notif.success', 'Category deleted successfully!');
            return redirect()->route('categories.index');
        }

        return abort(500);
    }
}
