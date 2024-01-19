@extends('layouts.app')

@section('title', 'Aarons\'s Dept - Upload CSV')

@section('content')
<div class="row">
    <div class="col">
        <form action="{{route('uploads.csv')}}" method="POST" class="mt-5" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-5">
                <label for="csv">Import CSV File</label>
                <br>
                <input type="file" name="csv" accept=".csv" id="csv">
                @error('upload_csv')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-5">Import CSV</button>
        </form>
    </div>
</div>
@endsection