<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $locations = Location::count();
        $parentlocations = Location::whereNotNull('parent_id')->pluck('parent_id')->unique()->count();
        $childlocations = Location::whereNotNull('parent_id')->count();

        $data = [
            'locations' => $locations,
            'parentlocations' => $parentlocations,
            'childlocations' => $childlocations,
        ];

        return view('/auth/dashboard')->with($data);
    }
}
