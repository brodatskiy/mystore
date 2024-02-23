<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sticker\StoreRequest;
use App\Http\Requests\Sticker\UpdateRequest;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StickerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stickers = Sticker::all();

        return Inertia::render('Admin/Stickers/Index', [
            'stickers' => $stickers,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Stickers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Sticker::firstOrCreate($data);

        return to_route('stickers.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sticker $sticker)
    {
        return Inertia::render('Admin/Stickers/Edit', [
            'sticker' => $sticker
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Sticker $sticker)
    {
        $data = $request->validated();
        $sticker->update($data);

        return to_route('stickers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sticker $sticker)
    {
        $sticker->delete();

        return to_route('stickers.index');
    }
}
