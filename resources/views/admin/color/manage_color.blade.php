@extends('admin.layout')
@section('page_title','Manage Color')
@section('color_select','active')
@section('content')
<h2>Manage Color</h2>
<a href="{{route('admin.color')}}" type="button" class="btn btn-success my-3">Back</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.color.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$result['id']}}">
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" name="color" value="{{$result['color']}}" type="text" class="form-control"
                            placeholder="Color" required>
                        @error('color')
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