<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    //
    public function index(){
        $data = Religion::paginate(5);

        return view('datareligion', compact('data'));
    }

    /** 
     * Show the form for creating a new  resource
     * 
     * @return \Illuminate\Http\Response
    */

    public function create(){
    
        return view('tambahreligion');

    }

    /** 
     * Store a newly created resource in storage
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */

    public function store(request $request){
        $this->validate($request,[
            'nama' => 'required|min:2|max:30',
        ]);

        Religion::create($request->all());
        
        return Redirect()->route('datareligion');
    }
}
