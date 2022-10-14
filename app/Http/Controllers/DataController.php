<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Data::where('nama_data', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Data::paginate(5);
        }

        return view('data', compact('data'));
    }

    public function add()
    {
        $data = Data::all();
        return view('add-data', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_data' => 'required|unique:data',
            'data_code' => 'required|unique:data',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx',
        ]);

        $data = Data::create($request->all());
        if ($request->hasFile('file')) {
            $request->file('file')->move('file-data/', $request->file('file')->getClientOriginalName());
            $data->file = $request->file('file')->getClientOriginalName();
            $data->save();
        }
        return redirect('data')->with('success', 'Data Berhasil Di Tambahkan!');
    }

    public function edit($id)
    {

        $data = Data::find($id);
        return view('edit-data', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Data::find($id);
        $data->update($request->all());
        return redirect('data')->with('success', 'Data Berhasil Di Update!');
    }

    public function delete($id)
    {
        $data = Data::find($id);
        $data->delete();
        return redirect('data')->with('success', 'Data Berhasil Di Hapus!');
    }
}
