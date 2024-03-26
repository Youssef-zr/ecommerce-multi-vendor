<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Backend\SubCategory\UpdateSubCategoryRequest;
use App\Models\Backend\Category;
use App\Models\Backend\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $datatable)
    {
        return $datatable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereStatus('active')
            ->pluck('name', 'id')
            ->toArray();

        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $subCategory = new SubCategory;
        $subCategory->fill($data)->save();

        toastr()->success('Sub Category Has Been Created Successflully!', 'Success');

        return to_route('admin.dashboard.sub-category.index');
    }

    public function changeStatus(Request $request)
    {
        $subCategory = SubCategory::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $subCategory->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }


    // get child categories
    public function getChildCategories(Request $request)
    {
        $subCategory = SubCategory::with(['childCategories' => function ($query) {
            return $query->whereStatus('active');
        }])->findOrFail($request->subCategoryId);

        $childCategories = $subCategory->childCategories
            ->pluck('name', "id")->toArray();

        $output = '<option value="">please select</option>';

        foreach ($childCategories as $key => $value) {
            $output .= '<option value=' . $key . '>' . $value . '</option>';
        }

        return response()->json(['data' => $output], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::whereStatus('active')
            ->pluck('name', 'id')
            ->toArray();

        $subCategory = SubCategory::with('category')->findOrFail($id);

        return view('admin.sub-category.edit', compact("subCategory", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->fill($data)->save();


        toastr()->success('Category Has Been Updated Successflully!', 'Success');

        return to_route('admin.dashboard.sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $subCategory = SubCategory::with('childCategories', 'category')->findOrFail($id);

        // $mainCategory = $subCategory->category;
        $childCategories = $subCategory->childCategories->count();

        if ($childCategories > 0) {

            return response()->json(['msg' => 'You cannot delete this category because it is linked to another child category.'], 409);
        }

        $subCategory->delete();

        return response()->json(['success' => 'ok'], 200);
    }
}
