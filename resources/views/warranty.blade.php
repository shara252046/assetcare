<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Warranty</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1000px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.c{background:#fff;border-radius:12px;padding:16px;margin:16px 0;box-shadow:0 1px 4px #0002}
table{width:100%;border-collapse:collapse;font-size:14px}th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}.nav a{margin-right:14px;color:#2563eb}
.b{padding:2px 10px;border-radius:99px;font-size:12px}
.b.r{background:#fee2e2;color:#991b1b}.b.y{background:#fef3c7;color:#92400e}.b.g{background:#dcfce7;color:#166534}
</style>
</head>
<body><div class="w">
<h1>AssetCare</h1>
<div class="nav np">
<a href="{{ route('dashboard') }}">Dashboard</a>
<a href="{{ route('admin.home') }}">Assets ও Tickets</a>
<a href="{{ route('warranty.index') }}">Warranty</a>
<a href="{{ route('maintenance.index') }}">Maintenance</a>
<a href="{{ route('technicians.index') }}">Technicians</a>
</div>

<div class="c"><b>Warranty Tracker</b>
<p class="s">৩০ দিনের মধ্যে শেষ হবে এমন Asset "Expiring soon" দেখায়। প্রতিদিন সকাল ৮টায় Email Alert যায়।</p>
<div class="t"><table>
<tr><th>Code</th><th>Asset</th><th>Warranty শেষ</th><th>বাকি</th><th>অবস্থা</th></tr>
@forelse ($assets as $a)
@php($d = $a->daysLeft())
<tr>
<td>{{ $a->code }}</td><td>{{ $a->name }}</td><td>{{ $a->warranty_end->format('d M Y') }}</td>
<td>{{ $d < 0 ? '—' : $d . ' দিন' }}</td>
<td>
@if ($d < 0)<span class="b r">Expired</span>
@elseif ($d <= 30)<span class="b y">Expiring soon</span>
@else<span class="b g">OK</span>@endif
</td>
</tr>
@empty
<tr><td colspan="5">Warranty তারিখ দেওয়া কোনো Asset নেই</td></tr>
@endforelse
</table></div></div>

@if ($noWarranty->count())
<div class="c"><b>Warranty তারিখ নেই</b>
<p class="s">{{ $noWarranty->pluck('code')->implode(', ') }}</p></div>
@endif
</div></body></html>