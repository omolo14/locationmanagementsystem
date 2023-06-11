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
                                    <li class="breadcrumb-item active">Index</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <a class="btn btn-primary mb-3" href="{{ route('locations.create') }}">Add Location</a>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Parent Location</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($locations as $index => $location)
                                            <tr>
                                                <td>{{ $index +=1}}</td>
                                                <td>{{ $location->name }}</td>
                                                <td>{{ ucfirst($location->status) }}</td>
                                                <td>{{ $location->parent ? $location->parent->name : 'N/A' }}</td>
                                                <td>
                                                    <a class="btn btn-primary upcube-btn" href="{{ route('locations.show', $location->id) }}">View</a>
                                                    <a class="btn btn-secondary upcube-btn" href="{{ route('locations.edit', $location->id) }}">Edit</a>
                                                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger upcube-btn">Delete</button>
                                                    </form>
                                                </td>
                                            </tr> 
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection