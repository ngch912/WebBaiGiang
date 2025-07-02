<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class SubjectController extends Controller
{
    public function index()
{
    $departments = Department::withCount('subjects')->get();
    return view('admin.departments.index', compact('departments'));
}

public function store(Request $request)
{
    $request->validate(['name' => 'required|string|max:255']);
    Department::create($request->only('name'));
    return back()->with('success', 'Thêm khoa thành công!');
}

}
