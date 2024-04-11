@extends('admin.layout')
@section('page_title','Size')
@section('size_select','active')
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
    <h2>Size</h2>
    <a href="{{route('admin.manage_size')}}" type="button" class="btn btn-success mx-3">Add Size</a>
    <div class="table-responsive m-b-40 my-3">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $list)
                <tr>
                    <td>{{$list->id}}</td>
                    <td>{{$list->size}}</td>
                    <td>
                        <a href="{{route('admin.manage_size.update',$list->id)}}"
                            class="btn btn-sm btn-primary mx-1">Update</a>
                        @if($list->status == 1)
                        <a href="{{route('admin.manage_size.status',[0,$list->id])}}"
                            class="btn btn-sm btn-success mx-1">Active</a>
                        @else
                        <a href="{{route('admin.manage_size.status',[1,$list->id])}}"
                            class="btn btn-sm btn-secondary mx-1">Deactive</a>
                        @endif
                        <a href="{{route('admin.size.delete',$list->id)}}" class="btn btn-sm btn-danger mx-1">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection