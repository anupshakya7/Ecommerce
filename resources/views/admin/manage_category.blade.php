@extends('admin.layout')
@section('content')
<h2>Manage Category</h2>
<a href="{{route('admin.category')}}" type="button" class="btn btn-success my-3">Back</a>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.category.process')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$result['id']}}">
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category</label>
                        <input id="category_name" name="category_name" value="{{$result['category_name']}}" type="text" class="form-control" placeholder="Category Name" required>
                        @error('category_name')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" name="category_slug" type="text" value="{{$result['category_slug']}}" class="form-control" placeholder="Category Slug" required>
                        @error('category_slug')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div>
                        <button id="category-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection