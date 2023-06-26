<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $username = Auth::user()->name;

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
        $location->createdby = $username;
        $location->updatedby = "";
        $location->save();
        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

  

    public function edit(Location $location)
    {
        $locations = Location::pluck('name', 'id');

        return view('locations.edit', compact('location', 'locations'));
    }

    public function update(Request $request, Location $location)
    {
        $username = Auth::user()->name;

        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $location->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            // 'updatedby' => $username,
        ]);

        $location->updatedby = $username;
        $location->save();

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

    // public function destroy(Location $location)
    // {
    //     // Check if the location has any child locations
    //     if ($location->childlocation > 0) {
    //         // return Redirect::back()->withErrors('Cannot delete this location. Child location(s) exist.');
    //         redirect()->route('locations.index')->withErrors('Cannot delete this location. Child location(s) exist.');
    //     }
    //     else{
    //         $location->record=0;
    //         $location->save();

    //     return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    //     }
    //     // Delete the location if no child locations exist
        
    // }
  
    public function show($id)
    {
        $location = Location::findOrFail($id);
        $childlocations = Location::where('parent_id', $id)->get();
        $parentlocation = $location->parent;
        $categories = Location::with('children')->where('parent_id', null)->get();
        // $parentlocations = Location::where('id', $id)->get();
        // dd( $childlocations);

        return view('locations.show', compact('location', 'childlocations', 'parentlocation', 'categories'));
    }

    
}
