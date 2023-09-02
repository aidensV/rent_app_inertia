<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function GetBarang()
    {
        $items = Items::where('status', 'available')->where("type", "other")->get();
        return response()->json([
            "data" => $items
        ]);
    }

    public function GetLab()
    {
        $items = Items::where('status', 'available')->where("type", "lab")->get();
        return response()->json([
            "data" => $items
        ]);
    }
}
