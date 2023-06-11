@extends('layouts.admin')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Locations</h4>
                        
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Locations</a></li>
                                <li class="breadcrumb-item active">View</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <a class="btn btn-primary mb-3" href="{{ route('locations.create', ['parent_id' => $location->id]) }}">Add Child Location</a>
            <h1>Location Details</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">Name: {{ $location->name }}</p>
                    <p class="card-text">Status: {{ ucfirst($location->status) }}</p>
                    <p class="card-text">Parent Location: {{ $location->parent ? $location->parent->name : 'N/A' }}</p>
                </div>
            </div>

            <div>
                <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
