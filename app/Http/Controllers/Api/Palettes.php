<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Palette;
use App\PaletteLikes;
use Illuminate\Http\Request;

class Palettes extends Controller
{
    public function index()
    {
        $palettes = Palette::orderBy('palette_likes', 'desc')->paginate(40);

        return response()->json($palettes, 200);
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $colors = implode(',', $request->input('palette_colors'));

        try {
            $palette = Palette::create([
                'user_id' => 1,
                'palette_name' => $request->input('palette_name'),
                'palette_colors' => $colors,
                'palette_likes' => 0,
            ]);

            return response()->json($palette, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(Palette $palette)
    {
        return response()->json($palette, 200);
    }

    public function likePalette(Request $request, Palette $palette)
    {
        $likeExist = PaletteLikes::where('palette_id', $palette->id)->where('client_ip', $request->ip())->first();

        if ($likeExist) {
            return response()->json(['increase' => 0, 'palette' => $palette], 200);
        } else {
            PaletteLikes::create(['palette_id' => $palette->id, 'client_ip' => $request->ip()]);
            $palette->palette_likes = $palette->palette_likes + 1;
            $palette->save();
            return response()->json(['increase' => 1, 'palette' => $palette], 200);
        }
    }
}
