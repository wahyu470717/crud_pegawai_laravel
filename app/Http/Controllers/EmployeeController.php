<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Redirect;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Session;


class EmployeeController extends Controller
{
    //index
    public function index(Request $request ){
        if($request->has('search')){
            $data = Employee::where('nama', 'LIKE', '%'.$request->search.'%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Employee::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('datapegawai', compact('data')); 
    }

    //ke halaman tambah data pegawai
    public function tambahpegawai(){
        // $data = Employee::all();     
        return view('tambahdata'); 
    }

    //insertdata
    public function insertdata(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:5|max:30',
            'notelpon' => 'required|min:11|max:12'
        ]);

        $data = Employee::create($request->except('foto'));
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Input');
    }

    //ke halaman edit data
    public function tampilkandata($id) {
        $data = Employee::find($id);
        // dd($data);
        return view('tampildata', compact('data'));
    }

    //update data
    public function updatedata(Request $request, $id) {
        $data = Employee::find($id);
        $data->update($request->except('foto'));
    
        if ($request->hasFile('foto')) {
            // Delete the old photo if a new one is uploaded
            if ($data->foto) {
                unlink(public_path('fotopegawai/' . $data->foto));
            }
    
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        if(session('halaman_url')){
            return Redirect(session('halaman_url'))->with('success', 'Data Berhasil Di Update');;
        }
    
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Update');
    }
    

       //delete data
       public function delete($id) {
        $data = Employee::find($id);
        $data->delete();
        // dd($data);
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Di Delete');
    }

    //export pdf 
    // public function exportpdf() {
    //     $data = Employee::all();

    //     // view()->share('data', $data);
    //     // $pdf = PDF::loadview('datapegawai-pdf');

    //     $pdf = Pdf::loadView('datapegawai-pdf', $data);
    //     return $pdf->download('data.pdf');
    // }
    public function exportpdf() {
        $data = Employee::all();
    
        $pdf = Pdf::loadView('datapegawai-pdf', ['data' => $data]);
        return $pdf->download('data.pdf');
    }
    
}
