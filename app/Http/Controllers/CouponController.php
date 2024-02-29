<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $list['data'] = Coupon::all();
        return view('admin.coupon.index', $list);
    }

    public function manage_coupon(Request $request, $id = '')
    {
        if($id > 0) {
            $arr = Coupon::find($id);
            $result['title'] = $arr->title;
            $result['code'] = $arr->code;
            $result['value'] = $arr->value;
            $result['id'] = $arr->id;
        } else {
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['id'] = '';
        }

        return view('admin.coupon.manage_coupon', compact('result'));
    }

    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('id'),
            'value' => 'required',
        ]);

        if($request->post('id') > 0) {
            $model = Coupon::find($request->post('id'));
            $msg = "Coupon Updated";
        } else {
            $model = new Coupon();
            $msg = "Coupon Inserted";
        }
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->status = 1;
        if($model->save()) {
            $request->session()->flash('message', $msg);
            return redirect('admin/coupon');
        } else {
            $request->session()->flash('message', 'Error!!!');
            return redirect('admin/manage_coupon');
        }

    }

    public function delete($id)
    {
        $model = Coupon::find($id);
        if($model->delete()) {
            session()->flash('message', 'Category Delete');
            return redirect('admin/coupon');
        } else {
            session()->flash('message', 'Error!!!');
            return redirect('admin/coupon');
        }

    }

    public function status(Request $request, $status, $id)
    {
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Coupon Status Updated');
        return redirect('admin/coupon');
    }
}
