@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> --}}
        <div class="col-md-6 col-md-offset-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                         <h5>
                            File Upload
                           </h5>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('file') }}" class="btn btn-primary float-end">All Files</a>
                        </div>
                    </div>
                   </div>
                <div class="card-body">
                    <form action="{{ url('file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Upload file</label>
                            <input class="form-control input-md" type="file" name="file" />
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="{{ url('file/index') }}" class="btn btn-success">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br />
        <div class="col-md-6 col-md-offset-4">
            <div class="card">
               <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                     <h5>
                         Multiple Files Upload
                       </h5>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('multiple') }}" class="btn btn-primary float-end">All Files</a>
                    </div>
                </div>
               </div>
                <div class="card-body">
                    <form action="{{ url('multiple') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Upload files</label>
                            <input class="form-control input-md" type="file" name="file[]" multiple/>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="{{ url('file/index') }}" class="btn btn-success">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
