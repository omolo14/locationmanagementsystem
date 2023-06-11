@extends('layouts.admin')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Update Location</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Locations</a></li>
                                <li class="breadcrumb-item active">Update</li>
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
                            <h4>Update Location Details</h4>
                            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-7">
                                        <input class="form-control" type="text" placeholder="Location name" id="name" name="name" value="{{ $location->name }}">
                                    </div>
                                </div>
                                @if(isset($parent_id))
                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                @else
                                    <div class="form-group">
                                        <label for="parent_id">Parent Location:</label>
                                        <select id="parent_id" name="parent_id" class="form-control">
                                            @foreach($locations as $locationId => $locationName)
                                                <option value="{{ $locationId }}" {{ $locationId == $location->parent_id ? 'selected' : '' }}>{{ $locationName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control" >
                                                <option value="completed" {{ $location->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="incomplete" {{ $location->status == 'incomplete' ? 'selected' : '' }}>Incomplete</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Update</button>
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