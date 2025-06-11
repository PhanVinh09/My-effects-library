<?php

namespace App\Http\Controllers;

use App\Models\User_Management;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User_Management::all();
        return view('admin.management_list.user', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User_Management $user_Management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User_Management $user_Management)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User_Management $user_Management)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User_Management $user_Management)
    {
        //
    }
}
