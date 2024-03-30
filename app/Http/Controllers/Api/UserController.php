<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all('name');
        return response()->json([
            'data' => $data,
        ]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            User::create([
                "name" => $request['name'],
                // "region_id" => $request['region_id'],
            ]);
            return response() -> json([
                "Status" => "200",
                "message" => "Save Complete"
            ]);

        }catch(\Exception $e) {
            return response() -> json([
                "Status" => "500",
                "Message" => $e,
            ]);
        };
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            User::where('id',$id) -> update([
                'name' => $request['name'],
                //'region_id' => $request['region_id']
            ]);
            return response() -> json([
                "Status" => "200",
                "message" => "Update Complete"
            ]);

        }catch(\Exception $e) {
            return response() -> json([
                "Status" => "500",
                "Message" => $e,
            ]);
        };
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            User::where('id',$id) -> delete();
            return response() -> json([
                "Status" => "200",
                "message" => "Delete Complete"
            ]);

        }catch(\Exception $e) {
            return response() -> json([
                "Status" => "500",
                "Message" => $e,
            ]);
        };
        //
    }
}
