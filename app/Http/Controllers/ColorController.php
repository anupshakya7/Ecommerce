<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $list['data'] = Color::all();
        return view('admin.color.index', $list);
    }

    public function manage_color(Request $request, $id = '')
    {
        if($id > 0) {
            $arr = Color::find($id);
            $result['color'] = $arr->color;
            $result['status'] = $arr->status;
            $result['id'] = $arr->id;
        } else {
            $result['color'] = '';
            $result['status'] = '';
            $result['id'] = '';
        }

        return view('admin.color.manage_color', compact('result'));
    }

    public function manage_color_process(Request $request)
    {
        $request->validate([
            'color' => 'required|unique:colors,color',
        ]);

        if($request->post('id') > 0) {
            $model = Color::find($request->post('id'));
            $msg = "Color Updated";
        } else {
            $model = new Color();
            $msg = "Color Inserted";
        }
        $model->color = $request->post('color');
        $model->status = 1;
        if($model->save()) {
            $request->session()->flash('message', $msg);
            return redirect('admin/color');
        } else {
            $request->session()->flash('message', 'Error!!!');
            return redirect('admin/manage_color');
        }

    }

    public function delete($id)
    {
        $model = Color::find($id);
        if($model->delete()) {
            session()->flash('message', 'Color Delete');
            return redirect('admin/color');
        } else {
            session()->flash('message', 'Error!!!');
            return redirect('admin/color');
        }

    }

    public function status(Request $request, $status, $id)
    {
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Size Status Updated');
        return redirect('admin/color');
    }
}
