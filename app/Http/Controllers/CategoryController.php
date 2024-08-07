<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidasiRequest;
use App\Jobs\DeleteNotif;
use App\Jobs\SendNotificationEmailJob;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        return view('template.index');
    }

    public function category(){
        $data['categori'] = category::all();
        $data['count'] = $data['categori']->count();
        return view('template.category-table',$data);
    }
    
    public function create(ValidasiRequest $request)
    {
        $validasi = Category::create([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);

        if ($validasi) {
            Session::flash('pesan','Data Berhasil Di Tambahkan');
        }else {
            Session::flash('pesan','Data Gagal Di Tambahkan');
        }

        SendNotificationEmailJob::dispatch($validasi);

        return redirect('/category');
    }


    public function edit(Request $request)
    {
        $data['edit'] = Category::find($request->id);
        return view('/category',$data);
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->update([
            'name' => $request->name,
            'is_publish' => $request->is_publish,
        ]);

        if ($category) {
            Session::flash('pesan','Data Berhasil Di Ubah');
        }else {
            Session::flash('pesan','Data Gagal Di Ubah');
        }
        
        return redirect('/category');
    }

    public function delete(Request $request)
    {
        $delete = Category::where('id',$request->id)->first();

        DeleteNotif::dispatch($delete);

        $delete->delete();
        
        return redirect('/category');
    }
}
