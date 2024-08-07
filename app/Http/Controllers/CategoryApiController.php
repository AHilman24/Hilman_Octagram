<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryApiController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'unique:categories'],
            'is_publish' => 'required'
        ]);

        if ($validator->fails ()) {
            return response()->json([
                'status' => 'Invalid',
                'errors' => $validator->errors()
            ], 422);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->is_publish = $request->is_publish;
        $category->save();

        return response()->json([
            'status' => 'Success',
            'category' => $category,
            'message' => 'Category created succesfully'
        ], 200);
    }

    public function get(Request $request)
    {
        if ($request->search) {
            $data['category'] = Category::where('name','LIKE','%'.$request->search.'%')->get();
        }else{
            $data['category'] = Category::get();
        }

        $data['count'] = $data['category']->count();
        return response()->json([
            'status' => 'Success',
            'lenght' => $data['count'],
            'categories' => $data['category']
        ], 200);
    }

    public function edit(Request $request)
    {
        $data['edit'] = Category::find($request->id);
        return view('edit',$data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','unique:categories'],
            'is_publish'=> ['required', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Invalid',
                'errors' => $validator->errors()
            ], 422);
        }
        
        Category::where('id', $id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);
        $category = Category::find($id);

        return response()->json([
            'status' => 'Success',
            'category' => $category
        ], 200);
    }

    public function delete($id)
    {
        $Category = Category::where('id',$id)->delete();
        return response()->json([
            'status' => 'Success',
            'category' => $Category
        ],200);
    }
}
