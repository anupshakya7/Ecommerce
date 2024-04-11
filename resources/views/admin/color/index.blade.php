@extends('admin.layout')
@section('page_title','Color')
@section('color_select','active')
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
    <h2>Color</h2>
    <a href="{{route('admin.manage.color')}}" type="button" class="btn btn-success mx-3">Add Color</a>
    <div class="table-responsive m-b-40 my-3">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Color</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $list)
                <tr>
                    <td>{{$list->id}}</td>
                    <td>{{$list->color}}</td>
                    <td>
                        <a href="{{route('admin.manage_color.update',$list->id)}}"
                            class="btn btn-sm btn-primary mx-1">Update</a>
                        @if($list->status == 1)
                        <a href="{{route('admin.manage_color.status',[0,$list->id])}}"
                            class="btn btn-sm btn-success mx-1">Active</a>
                        @else
                        <a href="{{route('admin.manage_color.status',[1,$list->id])}}"
                            class="btn btn-sm btn-secondary mx-1">Deactive</a>
                        @endif
                        <a href="{{route('admin.color.delete',$list->id)}}"
                            class="btn btn-sm btn-danger mx-1">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection