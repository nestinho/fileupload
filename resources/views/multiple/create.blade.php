@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-offset-md-4">
                <div class="card">
                    <h5 class="card-header">
                       Multiple Files Upload
                    </h5>
                    <div class="card-body">
                        <form action="{{ url('multiple') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Upload file</label>
                                <input class="form-control input-md" type="file" name="file[]" multiple/>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            <a href="{{ url('multiple/index') }}" class="btn btn-success">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection