<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use illuminate\support\facades\validator;
class AdminController extends Controller
{
    //
    public function admin_dashboard()
    {
        return view ('admin.index');
    }
    public function category()
    {
        $categories =category::orderBy('created_at','DESC')->paginate(5);
        return view ('admin.category');
    }

public function add_category(Request $request){
   $validator = $request->validate([
    'category_name' => 'required|unique:categories,category',].[ 'category'=>'this category already exists']);
    

    Category::create($validator);
    return redirect()->back()->with('succes','category added successfully');
}
public function deleteCategory($id)
{
    //dd($id);
    $data = Category::find($id);
    $data->delete();
    return redirect()->back()->with('success', 'category deleted succesfully');
}

}
