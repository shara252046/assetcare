<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Ticket;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {

//added for warrenty alert
    $expiring = Asset::whereBetween('warranty_end', [
            today()->toDateString(),
            today()->addDays(30)->toDateString(),
        ])->count();


//added for qr issue report
        return view('admin', [
            'assets' => Asset::orderBy('code')->get(),
            'tickets' => Ticket::with('asset')->latest()->get(),
            'expiring' => $expiring, //added for warrenty alert
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:60',
            'category' => 'required|in:AC,Computer,Printer,Vehicle',
              'warranty_end' => 'nullable|date',//added for warrenty alert
        ]);

        $prefix = ['AC' => 'AC', 'Computer' => 'PC', 'Printer' => 'PR', 'Vehicle' => 'VH'][$data['category']];
        $n = 1;
        do {
            $code = $prefix . '-' . str_pad((string) $n, 2, '0', STR_PAD_LEFT);
            $n++;
        } while (Asset::where('code', $code)->exists());

        Asset::create(['code' => $code, 'name' => $data['name'], 'category' => $data['category'],'warranty_end' => $data['warranty_end'] ?? null,]);

        return back()->with('ok', "Asset $code is added");
    }

    public function qr(Request $request, Asset $asset)
    {
        $base = rtrim(config('assetcare.base_url') ?: $request->getSchemeAndHttpHost(), '/');
        $url = $base . route('report.show', $asset->code, false);

        $renderer = new ImageRenderer(new RendererStyle(240, 2), new SvgImageBackEnd());
        $svg = (new Writer($renderer))->writeString($url);

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }
}