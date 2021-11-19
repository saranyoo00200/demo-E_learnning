<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = DB::table('news')
            ->where('news_status', '=', '1')
            ->orderBy('news_id', 'desc')
            ->paginate(6);

        $destinationPath = 'image/news/';

        foreach ($news as $key => $value) {
            $value->news_photo = url('/') . '/' . $destinationPath . $value->news_photo;
        }

        return response()->json($news, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news_id()
    {
        $news = DB::table('news')
            ->where('news_status', '=', '1')
            ->get();

        $destinationPath = 'image/news/';

        foreach ($news as $key => $value) {
            $value->news_photo = url('/') . '/' . $destinationPath . $value->news_photo;
        }

        return response()->json($news, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
