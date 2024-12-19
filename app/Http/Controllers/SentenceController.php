<?php

namespace App\Http\Controllers;

use App\Models\sentence;
use App\Http\Requests\StoresentenceRequest;
use App\Http\Requests\UpdatesentenceRequest;

class SentenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresentenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sentence $sentence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesentenceRequest $request, sentence $sentence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sentence $sentence)
    {
        //
    }
}
