<?php

namespace App\Http\Controllers;

use App\Models\Access_Subject;
use Illuminate\Http\Request;

class AccessSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Access_Subject  $access_Subject
     * @return \Illuminate\Http\Response
     */
    public function show(Access_Subject $access_Subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Access_Subject  $access_Subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Access_Subject $access_Subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Access_Subject  $access_Subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Access_Subject $access_Subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access_Subject  $access_Subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Access_Subject $access_Subject)
    {
        //
    }
}
