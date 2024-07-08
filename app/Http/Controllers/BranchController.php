<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();

        return Inertia::render('Branches/Index', [
            'branches' => $branches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Branches/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email'
        ]);

        Branch::create($request->all());

        return redirect()->route('branches.index')->with('toast', [
            'message' => __('Branch created successfully.'),
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return Inertia::render('Branches/Edit', [
            'branch' => $branch,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email'
        ]);

        $branch->update($request->all());

        return redirect()->route('branches.index')->with('toast', [
            'message' => __('Branch updated successfully.'),
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        if ($branch->id === auth()->user()->current_branch) {
            return redirect()->route('branches.index')->with('toast', [
                'message' => __('You cannot delete the branch you are currently using.'),
                'type' => 'error',
            ]);
        }

        $branch->delete();

        return redirect()->route('branches.index')->with('toast', [
            'message' => __('Branch deleted successfully.'),
            'type' => 'success',
        ]);
    }
}
