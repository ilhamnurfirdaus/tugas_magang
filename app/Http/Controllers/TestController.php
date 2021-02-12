<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('test.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tests = Test::all();

        return view('test.index', compact('tests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();
        // Test::create($input);
   
        // return response()->json(['success'=>'Got Simple Ajax Request.']);

        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
        ]);
        Test::create($request->all());
        return json_encode(array(
            "statusCode"=>200
        ));

        // $tests = $request->all();

        // $nama = $tests['nama'];
        // $alamat = $tests['alamat'];

        // $data = new Test;
        // $data->nama = $nama;
        // $data->alamat = $alamat;
        // $data->save();

        // return response()->json(['success'=>'Data is successfully added']);

        // return back()->with('message', 'Data Created');
        // return response()->json(['success'=>'Berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0)
    {
        if($id==0){ 
            $employees = Test::orderby('id','asc')->select('*')->get(); 
        }else{   
            $employees = Test::select('*')->where('id', $id)->get(); 
        }
        // Fetch all records
        $userData['data'] = $employees;

        echo json_encode($userData);
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
