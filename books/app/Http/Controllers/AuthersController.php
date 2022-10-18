<?php

namespace App\Http\Controllers;

use App\Models\Authers;
use App\Models\Books;
use Illuminate\Http\Request;

class AuthersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $book = Books::find($id);

        // $auther = $book->auther;

        // dd($auther);


        $auther = Authers::find($id);

        $book = $auther->books;

        dd($auther->books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Authers = Authers::all();
        return view('add_books', ['Authers' => $Authers]);
        // dd($Authers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Authers  $authers
     * @return \Illuminate\Http\Response
     */
    public function show(Authers $authers)
    {
        // $auther = Authers::find(1);

        // $book = $auther->books;

        // dd($auther->books);

        $book = Books::find(1);

        $auther = $book->auther;

        dd($auther);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Authers  $authers
     * @return \Illuminate\Http\Response
     */
    public function edit(Authers $authers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Authers  $authers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authers $authers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Authers  $authers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authers $authers)
    {
        //
    }
}