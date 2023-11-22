<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function allSectors()
    {
        $sectors = Sector::all();
        return response($sectors);
    }


}
