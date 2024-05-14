<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Index', [
            'users' => User::all(),
        ]);

    }

    public function create(): Response
    {
        return Inertia::render('Admin/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:Sales,Purchasing,Route,Warehouse',
        ]);

        $user = User::create($validated);
        return redirect()->route('admin.index');
    }



}
