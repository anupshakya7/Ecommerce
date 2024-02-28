<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $list['data'] = Category::all();
        return view('admin.category', $list);
    }

    public function manage_category(Request $request,$id=''){
        if($id>0){
            $arr = Category::find($id);
            $result['category_name'] = $arr->category_name;
            $result['category_slug'] = $arr->category_slug;
            $result['id'] = $arr->id;
        }else{
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['id'] = 0;
        }

        return view('admin.manage_category',compact('result'));
    }

    public function manage_category_process(Request $request){
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
        ]);
         
        if($request->post('id')>0){
            $model = Category::find($request->post('id'));
            $msg = "Category Updated";
        }else{
            $model = new Category();
            $msg = "Category Inserted";
        }
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        if($model->save()){
            $request->session()->flash('message',$msg);
            return redirect('admin/category');
        }else{
            $request->session()->flash('message','Error!!!');
            return redirect('admin/manage_category');
        }
       
    }

    public function delete($id){
        $model = Category::find($id);
        if($model->delete()){
            session()->flash('message','Category Delete');
            return redirect('admin/category');
        }else{
            session()->flash('message','Error!!!');
            return redirect('admin/category');
        }

    }
}
