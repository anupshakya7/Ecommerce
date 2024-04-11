@extends('admin.layout')
@section('page_title','Manage Coupon')
@section('coupon_select','active')
@section('content')
<h2>Manage Coupon</h2>
<a href="{{route('admin.coupon')}}" type="button" class="btn btn-success my-3">Back</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.coupon.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$result['id']}}">
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" name="title" value="{{$result['title']}}" type="text" class="form-control"
                            placeholder="Coupon Title" required>
                        @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="code" class="control-label mb-1">Code</label>
                        <input id="code" name="code" type="text" value="{{$result['code']}}" class="form-control"
                            placeholder="Coupon Code" required>
                        @error('code')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="value" class="control-label mb-1">Value</label>
                        <input id="value" name="value" type="text" value="{{$result['value']}}" class="form-control"
                            placeholder="Coupon Value" required>
                        @error('value')
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