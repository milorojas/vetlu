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
            'email' => 'required|email',
            'image' => 'nullable|image|max:1024',
        ]);

        $imageUrl = $request->image ? $request->image->store('public/branches') : null;

        // Remove public from the image URL
        if ($imageUrl !== null) {
            $imageUrl = str_replace('public/', '', $imageUrl);
        }

        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $imageUrl,
        ]);

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
            'branch' => [
                'id' => $branch->id,
                'name' => $branch->name,
                'address' => $branch->address,
                'email' => $branch->email,
                'imageUrl' => $branch->image ? $branch->image : null,
            ],
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
            'email' => 'required|email',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->imageUrl === null) {
            $branch->image = null;
        }

        $imageUrl = $request->image ? $request->image->store('public/branches') : $branch->image;

        if ($imageUrl !== null) {
            // Remove public from the image URL
            $imageUrl = str_replace('public/', '', $imageUrl);
        }

        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'image' => $imageUrl,
        ]);

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


    /*
    * Change the status of the branch
    */
    public function changeStatus(Branch $branch, Request $request)
    {
        $branch->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('toast', [
            'message' => __('Branch status changed successfully.'),
            'type' => 'success',
        ]);
    }
}
