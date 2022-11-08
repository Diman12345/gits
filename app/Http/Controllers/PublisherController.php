<?php

namespace App\Http\Controllers;

use App\Http\Resources\PublisherResourceCollection;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Publisher::orderBy('created_at', 'DESC')->paginate(10);

        if($data) {

            $res = PublisherResourceCollection::collection($data);

            $response = [
                "status" => true,
                "message" => "Data show...",
                "data"=>$res,
            ];
        } else {
            $response = [
                "status" => false,
                "message" => "Data empty...",
            ];
        }

        return response($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try {
            $book = Publisher::create($input);

            return responder()->success($book);
            
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $pub = Publisher::find($id);

        if ($pub) {
            $pub->delete();

            $response = [
                "status" => true,
                "message" => "Data Delete...",
            ];
        } else {
            $response = [
                "status" => false,
                "message" => "Data Not Found...",
            ];
        }

        return response($response);
    }
}
