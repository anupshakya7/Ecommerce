@extends('admin.layout')
@section('page_title','Category')
@section('category_select','active')
@section('content')
@if(session()->has('message'))
<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
    {{session('message')}}
    <span class="badge badge-pill badge-success mx-3">Success</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<div class="row">
    <h2>Category</h2>
    <a href="{{route('admin.manage_category')}}" type="button" class="btn btn-success mx-3">Add Category</a>
    <div class="table-responsive m-b-40 my-3">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $list)
                <tr>
                    <td>{{$list->id}}</td>
                    <td>{{$list->category_name}}</td>
                    <td>{{$list->category_slug}}</td>
                    <td>
                        <a href="{{route('admin.manage_category.update',$list->id)}}"
                            class="btn btn-sm btn-primary mx-1">Update</a>
                        @if($list->status==1)
                        <a href="{{route('admin.category.status',[0,$list->id])}}"
                            class="btn btn-sm btn-success mx-1">Active</a>
                        @elseif($list->status ==0)
                        <a href="{{route('admin.category.status',[1,$list->id])}}"
                            class="btn btn-sm btn-secondary mx-1">Deactive</a>
                        @endif
                        <a href="{{route('admin.category.delete',$list->id)}}"
                            class="btn btn-sm btn-danger mx-1">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection