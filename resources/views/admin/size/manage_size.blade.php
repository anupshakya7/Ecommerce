@extends('admin.layout')
@section('page_title','Manage Size')
@section('size_select','active')
@section('content')
<h2>Manage Size</h2>
<a href="{{route('admin.size')}}" type="button" class="btn btn-success my-3">Back</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.size.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$result['id']}}">
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <input id="size" name="size" value="{{$result['size']}}" type="text" class="form-control"
                            placeholder="Size" required>
                        @error('size')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button id="coupon-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection