<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\childCategory\StoreChildCategoryRequest;
use App\Http\Requests\Backend\childCategory\UpdateChildCategoryRequest;
use App\Models\Backend\Category;
use App\Models\Backend\ChildCategory;
use Illuminate\Http\Request;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $datatable)
    {
        return $datatable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereStatus('active')
            ->whereHas('subCategories')
            ->pluck('name', 'id')
            ->toArray();

        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChildCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $childCategory = new ChildCategory;
        $childCategory->fill($data)->save();

        toastr()->success('Child Category Has Been Created Successflully!', 'Success');

        return to_route('admin.dashboard.child-category.index');
    }

    public function changeStatus(Request $request)
    {
        $childCategory = ChildCategory::findOrFail($request->id);
        $status = $request->isChecked == "true" ? 'active' : 'inactive';

        $childCategory->fill(['status' => $status])->save();

        return response()->json(['status' => 'ok'], 200);
    }

    public function getSubCategories(Request $request)
    {
        $mainCategory = Category::with(['subCategories' => function ($query) {
            return $query->whereStatus('active');
        }])->findOrFail($request->mainCategoryId);


        $subCategories = $mainCategory->subCategories
            ->pluck('name', "id")->toArray();

        $output = '<option value="">please select</option>';

        foreach ($subCategories as $key => $value) {
            $output .= '<option value=' . $key . '>' . $value . '</option>';
        }

        return response()->json(['data' => $output], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::whereStatus('active')
            ->whereHas('subCategories')
            ->pluck('name', 'id')
            ->toArray();

        $childCategory = ChildCategory::with(
            [
                'mainCategory' => function ($q) {
                    return $q->whereStatus('active');
                },
                'subCategory' => function ($q) {
                    return $q->whereStatus('active');
                }
            ]
        )->findOrFail($id);


        return view('admin.child-category.edit', compact('categories', 'childCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChildCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $data['slug'] =  str()->slug($data['name']);

        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->fill($data)->save();

        toastr()->success('Child Category Has Been Updated Successflully!', 'Success');

        return to_route('admin.dashboard.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);

        if (!empty($childCategory)) {

            $childCategory->delete();

            toastr()->success('Category Has Been Deleted Successfully', "Success");

            return response()->json(['success' => 'ok'], 200);
        }
    }
}
