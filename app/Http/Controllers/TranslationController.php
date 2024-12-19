<?php

namespace App\Http\Controllers;

use App\Models\translation;
use App\Http\Requests\StoretranslationRequest;
use App\Http\Requests\UpdatetranslationRequest;

class TranslationController extends Controller
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
    public function store(StoretranslationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(translation $translation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetranslationRequest $request, translation $translation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(translation $translation)
    {
        //
    }
}
