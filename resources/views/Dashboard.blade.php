<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Dashboard</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1050px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.nav a{margin-right:14px;color:#2563eb}
.c{background:#fff;border-radius:12px;padding:16px;margin:0;box-shadow:0 1px 4px #0002}
.c h3{margin:0 0 10px;font-size:16px}
.cards{display:grid;gap:14px;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));margin:16px 0}
.card{background:#fff;border-radius:12px;padding:16px;box-shadow:0 1px 4px #0002;text-decoration:none;color:inherit;display:block;border-top:4px solid #2563eb}
.card.hot{border-top-color:#dc2626}.card.warn{border-top-color:#d97706}
.big{font-size:36px;font-weight:700;line-height:1.2}
.g2{display:grid;gap:14px;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));margin:14px 0}
table{width:100%;border-collapse:collapse;font-size:14px}
th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left}th{color:#64748b}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}.ok{color:#166534}
.qa{display:flex;gap:8px;flex-wrap:wrap;margin:6px 0 16px}
button,a.btn{background:#2563eb;color:#fff;border:0;cursor:pointer;text-decoration:none;display:inline-block;padding:8px 14px;border-radius:8px;font:inherit}
a.btn.o,button.o{background:#fff;color:#2563eb;border:1px solid #2563eb}
.b{padding:2px 10px;border-radius:99px;font-size:12px;white-space:nowrap;background:#e2e8f0}
.b.r{background:#fee2e2;color:#991b1b}.b.y{background:#fef3c7;color:#92400e}.b.g{background:#dcfce7;color:#166534}
.row2{display:flex;justify-content:space-between;font-size:14px}
.bar{height:8px;background:#e2e8f0;border-radius:9px;margin:3px 0 10px}.bar i{display:block;height:100%;border-radius:9px}
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

<h2 style="margin:16px 0 2px">Welcome Back, Admin!</h2>
<p class="s" style="margin:0">{{ now()->format('d M Y') }} · Here’s an overview of your asset management system.</p>

<div class="cards">
<a class="card" href="{{ route('admin.home') }}"><div class="s">01 · Total Assets</div><div class="big">{{ $stats['total'] }}</div><div class="s">System-এ থাকা সব Asset</div></a>
<a class="card {{ $stats['open'] > 0 ? 'warn' : '' }}" href="{{ route('admin.home') }}"><div class="s">02 · Open Tickets</div><div class="big">{{ $stats['open'] }}</div><div class="s">এখনো সমাধান হয়নি এমন Ticket</div></a>
<a class="card {{ $stats['overdue'] > 0 ? 'hot' : '' }}" href="{{ route('maintenance.index') }}"><div class="s">03 · Overdue Maintenance</div><div class="big">{{ $stats['overdue'] }}</div><div class="s">Service Due Date পার হয়েছে</div></a>
<a class="card {{ $stats['warranty'] > 0 ? 'warn' : '' }}" href="{{ route('warranty.index') }}"><div class="s">04 · Warranty Expiring Soon</div><div class="big">{{ $stats['warranty'] }}</div><div class="s">পরবর্তী ৩০ দিনে Warranty শেষ</div></a>
</div>

<div class="qa">
<a class="btn" href="{{ route('admin.home') }}">+ Add New Asset</a>
<a class="btn o" href="{{ route('maintenance.index') }}">Schedule Maintenance</a>
<form method="POST" action="{{ route('maintenance.run') }}">@csrf<button class="o">Maintenance check চালান</button></form>
</div>

<div class="g2">
<div class="c"><h3>Asset Overview</h3>
@php($totalAssets = max($stats['total'], 1))
@forelse ($byCategory as $cat => $n)
<div class="row2"><span>{{ $cat }}</span><b>{{ $n }}</b></div>
<progress class="pb" value="{{ $n }}" max="{{ $totalAssets }}"></progress>
@empty
<p class="s">কোনো Asset নেই</p>
@endforelse
</div>

<div class="c"><h3>Ticket Overview</h3>
@php($totalTickets = max($ticketCounts->sum(), 1))
@foreach (['Open' => 'r', 'In Progress' => 'y', 'Resolved' => 'g'] as $st => $cls)
@php($n = $ticketCounts->get($st, 0))
<div class="row2"><span>{{ $st }}</span><b>{{ $n }}</b></div>
<progress class="pb {{ $cls }}" value="{{ $n }}" max="{{ $totalTickets }}"></progress>
@endforeach
</div>
</div>

<div class="g2">
<div class="c"><h3>Upcoming Maintenance</h3><div class="t"><table>
<tr><th>Asset</th><th>Due</th><th>অবস্থা</th></tr>
@forelse ($upcoming as $a)
@php($d = $a->serviceDaysLeft())
<tr>
<td>{{ $a->name }}</td><td>{{ $a->next_service_date->format('d M Y') }}</td>
<td>@if ($d < 0)<span class="b r">Overdue</span>@elseif ($d <= 7)<span class="b y">{{ $d }} দিনে Due</span>@else<span class="b g">{{ $d }} দিন পরে</span>@endif</td>
</tr>
@empty
<tr><td colspan="3">কোনো Schedule নেই</td></tr>
@endforelse
</table></div>
<p><a class="btn o" href="{{ route('maintenance.index') }}">View All</a></p></div>

<div class="c"><h3>Warranty Alert (৩০ দিন)</h3><div class="t"><table>
<tr><th>Asset</th><th>শেষ</th><th>বাকি</th></tr>
@forelse ($expiring as $a)
<tr><td>{{ $a->name }}</td><td>{{ $a->warranty_end->format('d M Y') }}</td><td>{{ $a->daysLeft() }} দিন</td></tr>
@empty
<tr><td colspan="3">কোনো Alert নেই</td></tr>
@endforelse
</table></div>
<p><a class="btn o" href="{{ route('warranty.index') }}">View Warranty</a></p></div>
</div>

<div class="c"><h3>Recent Tickets</h3><div class="t"><table>
<tr><th>ID</th><th>Asset</th><th>Issue</th><th>Priority</th><th>Status</th><th>তারিখ</th></tr>
@forelse ($recent as $t)
<tr>
<td>{{ $t->ticket_no }}</td><td>{{ $t->asset->name }}</td><td>{{ $t->issue }}</td>
<td>{{ $t->priority }}</td>
<td><span class="b {{ ['Open' => 'r', 'In Progress' => 'y', 'Resolved' => 'g'][$t->status] ?? '' }}">{{ $t->status }}</span></td>
<td>{{ $t->created_at->format('d M Y') }}</td>
</tr>
@empty
<tr><td colspan="6">এখনো কোনো Ticket নেই</td></tr>
@endforelse
</table></div></div>
</div></body></html>