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
        $expiring = Asset::whereBetween('warranty_end', [
            today()->toDateString(),
            today()->addDays(30)->toDateString(),
        ])->count();

        return view('admin', [
            'assets' => Asset::orderBy('code')->get(),
            'tickets' => Ticket::with('asset')->latest()->get(),
            'expiring' => $expiring,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:60',
            'category' => 'required|in:AC,Computer,Printer,Vehicle',
            'warranty_end' => 'nullable|date',
        ]);

        $prefix = ['AC' => 'AC', 'Computer' => 'PC', 'Printer' => 'PR', 'Vehicle' => 'VH'][$data['category']];
        $n = 1;
        do {
            $code = $prefix . '-' . str_pad((string) $n, 2, '0', STR_PAD_LEFT);
            $n++;
        } while (Asset::where('code', $code)->exists());

        Asset::create([
            'code' => $code, 
            'name' => $data['name'], 
            'category' => $data['category'],
            'warranty_end' => $data['warranty_end'] ?? null,
        ]);

        return back()->with('ok', "Asset $code is added");
    }

    // 🚨 FIX 1: Dead code removed from qr()
    public function qr(Request $request, Asset $asset)
    {
        $base = rtrim(config('assetcare.base_url') ?: $request->getSchemeAndHttpHost(), '/');
        $url = $base . route('report.show', $asset->code, false);

        $renderer = new ImageRenderer(new RendererStyle(240, 2), new SvgImageBackEnd());
        $svg = (new Writer($renderer))->writeString($url);

        return response($svg, 200, ['Content-Type' => 'image/svg+xml']);
    }

    // 🚨 FIX 2: New update() method added
    public function update(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'name' => 'required|string|max:60',
            'warranty_end' => 'nullable|date',
        ]);

        // Warranty তারিখ বদলালে Email Alert আবার পাঠানোর যোগ্য হবে
        if (array_key_exists('warranty_end', $data) && $data['warranty_end'] != $asset->warranty_end?->format('Y-m-d')) {
            $asset->warranty_notified_at = null;
        }

        $asset->update($data);

        return back()->with('ok', "Asset {$asset->code} আপডেট হয়েছে।");
    }

    public function destroy(Asset $asset)
    {
        $code = $asset->code;
        $asset->delete(); // এই Asset-এর সব Ticket-ও মুছে যায় (cascadeOnDelete)
 
        return back()->with('ok', "Asset $code মুছে ফেলা হয়েছে।");
    }
}