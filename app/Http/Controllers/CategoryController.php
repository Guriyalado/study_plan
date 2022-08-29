<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=Category::all();
        return view('admin/category',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_category(Request $request,$id='')
    {
        if($id>0){

            $arr=Category::where(['id'=>$id])->get();
            $result['data']['category_name']=$arr['0']->category_name;
            $result['data']['category_slug']=$arr['0']->category_slug;
            $result['id']=$arr['0']->id;
        }else{
            $result['category_name']='';
            $result['category_slug']='';
            $result['id']='';
        }
        return view('admin/manage_category');
    }
     public function manage_category_process(Request $request)

    {
        // return  $request->post();
        $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required|unique:categories,category_slug,'.$request->post['id'],
         ]);


        if($request->post['id']>0){
            $model=Category::find($request->post['id']);
            $msg="category updated";
        }else{

        $model= new Category();
        $msg="category inserted";
    }

        $model->category_name=$request->post('category_name');
        $model->category_slug=$request->post('category_slug');
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/category');
    }
      public function delete(Request $request,$id){
         
         $model = Category::find($id);
         $model->delete();
          $request->session()->flash('message','category deleted successfully');
        return redirect('admin/category');

      }
    
}