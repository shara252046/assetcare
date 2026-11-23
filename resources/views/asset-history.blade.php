<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – {{ $asset->name }} History</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1050px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.nav a{margin-right:14px;color:#2563eb}
.c{background:#fff;border-radius:12px;padding:16px;margin:14px 0;box-shadow:0 1px 4px #0002}
.c h3{margin:0 0 10px;font-size:16px}
.stats{display:grid;gap:14px;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));margin:14px 0}
.st{background:#fff;border-radius:12px;padding:14px;box-shadow:0 1px 4px #0002;border-top:4px solid #2563eb}
.big{font-size:28px;font-weight:700;line-height:1.2}
.kv{display:grid;grid-template-columns:150px 1fr;gap:6px 10px;font-size:14px}.kv b{color:#64748b;font-weight:600}
table{width:100%;border-collapse:collapse;font-size:14px}
th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left;vertical-align:top}th{color:#64748b}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}
button,a.btn{background:#fff;color:#2563eb;border:1px solid #2563eb;cursor:pointer;text-decoration:none;display:inline-block;padding:7px 14px;border-radius:8px;font:inherit}
.b{padding:2px 10px;border-radius:99px;font-size:12px;white-space:nowrap;background:#e2e8f0}
.b.r{background:#fee2e2;color:#991b1b}.b.y{background:#fef3c7;color:#92400e}.b.g{background:#dcfce7;color:#166534}.b.bl{background:#dbeafe;color:#1e40af}
@media print{.np{display:none!important}body{background:#fff}.c,.st{box-shadow:none}}
</style>
</head>
<body><div class="w">
<h1 class="np">AssetCare</h1>
<div class="nav np"><a href="{{ route('dashboard') }}">Dashboard</a><a href="{{ route('admin.home') }}">Assets ও Tickets</a><a href="{{ route('warranty.index') }}">Warranty</a><a href="{{ route('maintenance.index') }}">Maintenance</a><a href="{{ route('technicians.index') }}">Technicians</a></div>

<div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;align-items:center;margin-top:14px">
<h2 style="margin:0">{{ $asset->name }} <span class="s">({{ $asset->code }}) · Service History</span></h2>
<div class="np"><button onclick="window.print()">Print</button> <a class="btn" href="{{ route('admin.home') }}">← সব Asset</a></div>
</div>

<div class="stats">
<div class="st"><div class="s">মোট শেষ হওয়া কাজ</div><div class="big">{{ $history->count() }}</div></div>
<div class="st"><div class="s">মোট খরচ</div><div class="big">{{ number_format($totalCost, 2) }}</div></div>
<div class="st"><div class="s">শেষ Service</div><div class="big" style="font-size:20px">{{ $asset->last_service_date?->format('d M Y') ?? '—' }}</div></div>
<div class="st">
<div class="s">পরের Service Due</div>
<div class="big" style="font-size:20px">{{ $asset->next_service_date?->format('d M Y') ?? '—' }}</div>
@php($sd = $asset->serviceDaysLeft())
@if ($sd !== null)
@if ($sd < 0)<span class="b r">Overdue</span>@elseif ($sd <= 7)<span class="b y">{{ $sd }} দিনে Due</span>@else<span class="b g">{{ $sd }} দিন পরে</span>@endif
@endif
</div>
</div>

<div class="c"><h3>Asset তথ্য</h3><div class="kv">
<b>Category</b><span>{{ $asset->category }}</span>
<b>Warranty শেষ</b><span>
@if ($asset->warranty_end)
{{ $asset->warranty_end->format('d M Y') }}
@php($wd = $asset->daysLeft())
@if ($wd < 0)<span class="b r">Expired</span>@elseif ($wd <= 30)<span class="b y">{{ $wd }} দিন বাকি</span>@else<span class="b g">OK</span>@endif
@else — @endif
</span>
<b>Service interval</b><span>{{ $asset->service_interval_days ? $asset->service_interval_days . ' দিন' : '—' }}</span>
</div></div>

<div class="c"><h3>চলমান Ticket</h3><div class="t"><table>
<tr><th>ID</th><th>সমস্যা</th><th>Priority</th><th>Technician</th><th>Status</th></tr>
@forelse ($open as $t)
<tr>
<td><a href="{{ route('tickets.show', $t->id) }}">{{ $t->ticket_no }}</a></td>
<td>{{ $t->issue }}</td><td>{{ $t->priority }}</td><td>{{ $t->technician?->name ?? 'Unassigned' }}</td>
<td><span class="b {{ ['Open' => 'r', 'In Progress' => 'y'][$t->status] ?? '' }}">{{ $t->status }}</span></td>
</tr>
@empty
<tr><td colspan="5">কোনো চলমান Ticket নেই</td></tr>
@endforelse
</table></div></div>

<div class="c"><h3>Service History (শেষ হওয়া কাজ)</h3><div class="t"><table>
<tr><th>তারিখ</th><th>Ticket</th><th>ধরন</th><th>কাজ</th><th>Technician</th><th>Note</th><th>Cost</th></tr>
@forelse ($history as $t)
<tr>
<td>{{ ($t->resolved_at ?? $t->updated_at)->format('d M Y') }}</td>
<td><a href="{{ route('tickets.show', $t->id) }}">{{ $t->ticket_no }}</a></td>
<td><span class="b {{ $t->source === 'Maintenance' ? 'bl' : '' }}">{{ $t->source === 'Maintenance' ? 'Maintenance' : 'Issue' }}</span></td>
<td>{{ $t->issue }}</td>
<td>{{ $t->technician?->name ?? '—' }}</td>
<td>{{ $t->technician_note ?? '—' }}</td>
<td>{{ $t->cost !== null ? number_format((float) $t->cost, 2) : '—' }}</td>
</tr>
@empty
<tr><td colspan="7">এখনো কোনো Service History নেই। Ticket "Resolved" হলে এখানে জমা হবে।</td></tr>
@endforelse
</table></div>
<p style="text-align:right;margin:10px 0 0"><b>মোট খরচ: {{ number_format($totalCost, 2) }}</b></p>
</div>
</div></body></html>