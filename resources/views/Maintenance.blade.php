<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Maintenance</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1000px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.c{background:#fff;border-radius:12px;padding:16px;margin:16px 0;box-shadow:0 1px 4px #0002}
table{width:100%;border-collapse:collapse;font-size:14px}th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left;vertical-align:middle}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}.nav a{margin-right:14px;color:#2563eb}
.ok{color:#166534}.er{color:#b91c1c}
input,button{font:inherit;padding:7px;border-radius:8px;border:1px solid #cbd5e1}
button{background:#2563eb;color:#fff;border:0;cursor:pointer}
.b{padding:2px 10px;border-radius:99px;font-size:12px;white-space:nowrap}
.b.r{background:#fee2e2;color:#991b1b}.b.y{background:#fef3c7;color:#92400e}.b.g{background:#dcfce7;color:#166534}
</style>
</head>
<body><div class="w">
<h1>AssetCare</h1>
<div class="nav">
<a href="{{ route('dashboard') }}">Dashboard</a>
<a href="{{ route('admin.home') }}">Assets ও Tickets</a>
<a href="{{ route('warranty.index') }}">Warranty</a>
<a href="{{ route('maintenance.index') }}">Maintenance</a>
<a href="{{ route('technicians.index') }}">Technicians</a>
</div>

@if (session('ok'))<p class="ok">{{ session('ok') }}</p>@endif
@if ($errors->any())<p class="er">{{ $errors->first() }}</p>@endif

<div class="c"><b>Maintenance Schedule</b>
<p class="s">প্রতিটি Asset-এর Service Interval (যেমন AC = 90 দিন) ও পরের Due Date সেট করো। Due Date পার হলে প্রতিদিন সকাল ৭টায় সিস্টেম নিজে Ticket তৈরি করে। Ticket "Resolved" করলে পরের Due Date নিজে আপডেট হয়।</p>
<form method="POST" action="{{ route('maintenance.run') }}">@csrf<button>এখনই Maintenance check চালান</button></form>
<br>
<div class="t"><table>
<tr><th>Code</th><th>Asset</th><th>Interval (দিন)</th><th>শেষ Service</th><th>পরের Due</th><th>অবস্থা</th><th></th></tr>
@forelse ($assets as $a)
@php($d = $a->serviceDaysLeft())
<tr>
<td>{{ $a->code }}</td>
<td>{{ $a->name }}</td>
<td><input type="number" name="service_interval_days" min="1" max="3650" value="{{ $a->service_interval_days }}" form="f{{ $a->id }}" style="width:90px"></td>
<td>{{ $a->last_service_date?->format('d M Y') ?? '—' }}</td>
<td><input type="date" name="next_service_date" value="{{ $a->next_service_date?->format('Y-m-d') }}" form="f{{ $a->id }}"></td>
<td>
@if ($d === null)<span class="s">Schedule নেই</span>
@elseif ($d < 0)<span class="b r">Overdue</span>
@elseif ($d <= 7)<span class="b y">{{ $d }} দিনে Due</span>
@else<span class="b g">{{ $d }} দিন পরে</span>@endif
</td>
<td><form id="f{{ $a->id }}" method="POST" action="{{ route('maintenance.update', $a->code) }}">@csrf @method('PATCH')<button>Save</button></form></td>
</tr>
@empty
<tr><td colspan="7"> No Asset found </td></tr>
@endforelse
</table></div></div>
</div></body></html>