@extends('layouts.admin')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Location</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Locations</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4>Location Details</h4>
                            <form action="{{ route('locations.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" placeholder="Location name" id="name" name="name">
                                    </div>
                                </div>
                                {{-- @if(isset($parent_id))
                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                @else --}}
                                    <div class="form-group">
                                        <label for="parent_id">Parent Location:</label>
                                        <select id="parent_id" name="parent_id" class="form-control">
                                            <option value="">Select a parent location</option>
                                            @foreach($locations as $locationId => $locationName)
                                                <option @if($locationId == $parent_id) selected="" @endif value="{{ $locationId }}">{{ $locationName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                {{-- @endif --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control" >
                                                <option value="completed">Completed</option>
                                                <option value="incomplete">Incomplete</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    {{-- <button class="btn btn-secondary" href="{{ route('locations.index') }}">Back</button> --}}
                                    <a class="btn btn-secondary" href="{{ url()->previous() }}">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection