<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return response()->json($stores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        $store = Store::create($request->all());

        return response()->json($store, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return response()->json($store);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, Store $store)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'active' => 'required|boolean',
        ]);

        $store->update($request->all());

        return response()->json($store, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json(null, 204);
    }
}
