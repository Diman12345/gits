<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResourceCollection;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Author::orderBy('created_at', 'DESC')->paginate(10);

        if($data) {

            $res = AuthorResourceCollection::collection($data);

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
            $book = Author::create($input);

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
        $author = Author::find($id);

        if ($author) {
            $author->delete();

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
