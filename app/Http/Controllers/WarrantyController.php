<?php

namespace App\Http\Controllers;

use App\Models\Asset;

class WarrantyController extends Controller
{
    public function index()
    {
        return view('warranty', [
            'assets' => Asset::whereNotNull('warranty_end')->orderBy('warranty_end')->get(),
            'noWarranty' => Asset::whereNull('warranty_end')->orderBy('code')->get(),
        ]);
    }
}