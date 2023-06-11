<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
        // $locations = Location::with('children')->whereNull('parent_id')->get();
        $locations = Location::where('record', 1)->get();
        // $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create(Request $request)
    {
        $parent_id = $request->query("parent_id");
        $locations = Location::pluck('name', 'id');

        return view('locations.create', compact('locations'))->with(['parent_id' => $parent_id ?? null]);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:completed,incomplete',
        'parent_id' => 'nullable|exists:locations,id'
    ]);
    $location = new Location();
    $location->name = $request->input('name');
    $location->status = $request->input('status');
    $location->parent_id = $request->input('parent_id');
    $location->record = 1;
    $location->createdby = "boaz";
    $location->updatedby = "boaz";
    $location->save();
    return redirect()->route('locations.index')->with('success', 'Location created successfully.');
}

    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        $locations = Location::pluck('name', 'id');

        return view('locations.edit', compact('location', 'locations'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $location->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        // $location->delete();
        // $location = Location::find($id);
        $location->record=0;
        $location->save();
        

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }

    
}
