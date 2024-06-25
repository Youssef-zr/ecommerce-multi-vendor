<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\adress\StoreUserAdressRequest;
use App\Http\Requests\Backend\adress\UpdateUserAdressRequest;
use App\Models\Backend\UserAdress;
use Illuminate\Http\Request;

class UserAdressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAdresses = UserAdress::where("user_id", auth()->user()->id)->get();
        return view('frontend.dashboard.adress.index', compact('userAdresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.adress.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAdressRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        UserAdress::create($data);

        toastr('Adress Created Successfully!', 'success', 'Success');
        return to_route('user.adress.index');
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
        $userAdress = UserAdress::where("user_id", auth()->user()->id)->findOrFail($id);
        return view('frontend.dashboard.adress.update', compact('userAdress'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAdressRequest $request, string $id)
    {
        $userAdress = UserAdress::where("user_id", auth()->user()->id)->findOrFail($id);
        $userAdress->update($request->validated());

        toastr('Adress Updated Successfully!', 'success', 'Success');
        return to_route('user.adress.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userAdress = UserAdress::where("user_id", auth()->user()->id)->findOrFail($id);
        $userAdress->delete();

        toastr('Adress Deleted Successfully!', 'success', 'Success');
        return response()->json(['success'=>'ok'],200);
    }
}
