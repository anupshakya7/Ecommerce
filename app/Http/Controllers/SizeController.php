<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $list['data'] = Size::all();
        return view('admin.size.index', $list);
    }

    public function manage_size(Request $request, $id = '')
    {
        if($id > 0) {
            $arr = Size::find($id);
            $result['size'] = $arr->size;
            $result['status'] = $arr->status;
            $result['id'] = $arr->id;
        } else {
            $result['size'] = '';
            $result['status'] = '';
            $result['id'] = '';
        }

        return view('admin.size.manage_size', compact('result'));
    }

    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required|unique:sizes,size',
        ]);

        if($request->post('id') > 0) {
            $model = Size::find($request->post('id'));
            $msg = "Size Updated";
        } else {
            $model = new Size();
            $msg = "Size Inserted";
        }
        $model->size = $request->post('size');
        $model->status = 1;
        if($model->save()) {
            $request->session()->flash('message', $msg);
            return redirect('admin/size');
        } else {
            $request->session()->flash('message', 'Error!!!');
            return redirect('admin/manage_size');
        }

    }

    public function delete($id)
    {
        $model = Size::find($id);
        if($model->delete()) {
            session()->flash('message', 'Size Delete');
            return redirect('admin/size');
        } else {
            session()->flash('message', 'Error!!!');
            return redirect('admin/size');
        }

    }

    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Size Status Updated');
        return redirect('admin/size');
    }
}
