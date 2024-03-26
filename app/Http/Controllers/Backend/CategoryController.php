<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Backend\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $datatable)
    {
        return $datatable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $category = new Category;
        $category->fill($data)->save();

        toastr()->success('category Has Been Created Successflully!', 'Success');

        return to_route('admin.dashboard.category.index');
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $category->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, category $category)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $category->fill($data)->save();


        toastr()->success('Category Has Been Updated Successflully!', 'Success');

        return to_route('admin.dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $category = Category::with('subCategories')->findOrFail($id);
        $subCategories = $category->subCategories->count();

        if ($subCategories > 0) {

            return response()->json(['msg' => 'You cannot delete this category because it is linked to another subcategory.'], 409);
        }

        $category->delete();

        return response()->json(['success' => 'ok'], 200);
    }
}
