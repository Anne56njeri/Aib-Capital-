<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Query;
use App\Exports\QuerysExport;
class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $queries = \App\Query::all();
        return view('index',compact('queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        return view ('query');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //we store the data here 
        $request->validate([
            'your_name'=>'required',
            'telephone_number'=>'required',
            'email'=> 'required',
            'location'=>'required',
            'query'=>'required',
        ]);
        $query = new Query ([
            'name'=>$request->get('your_name'),
            'telephone_number'=>$request->get('telephone_number'), 
            'email'=>$request->get('email'),
            'location'=>$request->get('location'),
            'query'=>$request->get('query'),
        ]);
        $query->save();
        return redirect ('/')->with('success','Your information has been submitted ');

    } 
    public function export($type)
    {
        return Excel::download(new QuerysExport, 'queries.' . $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $query = \App\Query::find($id);
        $query->delete();
        return redirect('queries')->with('success','Information has been deleted');
    }
}
