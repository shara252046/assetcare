<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – QR Issue Reporting</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1000px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.c{background:#fff;border-radius:12px;padding:16px;margin:16px 0;box-shadow:0 1px 4px #0002}
.g{display:grid;gap:14px;grid-template-columns:repeat(auto-fill,minmax(210px,1fr))}
.q{border:1px solid #e2e8f0;border-radius:10px;padding:10px;text-align:center}.q img{width:100%;max-width:200px}
input,select,button{font:inherit;padding:8px;border-radius:8px;border:1px solid #cbd5e1}
button{background:#2563eb;color:#fff;border:0;cursor:pointer}button.o{background:#fff;color:#2563eb;border:1px solid #2563eb}
table{width:100%;border-collapse:collapse;font-size:14px}th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}.ok{color:#166534}.er{color:#b91c1c}
.nav a{margin-right:14px;color:#2563eb}
.al{background:#fef3c7;color:#92400e;border-radius:10px;padding:12px 16px;margin:16px 0}
@media print{.np{display:none!important}body{background:#fff}.c{box-shadow:none}}
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

@if (session('ok'))<p class="ok np">{{ session('ok') }}</p>@endif
@if ($errors->any())<p class="er np">{{ $errors->first() }}</p>@endif

@if ($expiring > 0)
<div class="al np">⚠ {{ $expiring }} টি Asset-এর Warranty আগামী ৩০ দিনের মধ্যে শেষ হবে। <a href="{{ route('warranty.index') }}">Warranty দেখুন</a></div>
@endif

<div class="c np"><b>নতুন Asset</b><br><br>
<form method="POST" action="{{ route('assets.store') }}">
@csrf
<input name="name" placeholder="Asset name" maxlength="60" required value="{{ old('name') }}">
<select name="category">
@foreach (['AC','Computer','Printer','Vehicle'] as $cat)<option>{{ $cat }}</option>@endforeach
</select>
<label class="s">Warranty শেষ: <input type="date" name="warranty_end" value="{{ old('warranty_end') }}"></label>
<button>Add Asset</button>
</form></div>

<div class="c"><b>Assets ও QR Code</b> <button class="o np" onclick="window.print()">Print QR codes</button><br><br>
<div class="g">
@foreach ($assets as $a)
<div class="q">
<img src="{{ route('assets.qr', $a->code) }}" alt="QR {{ $a->code }}">
<div>{{ $a->name }}</div><div class="s">{{ $a->code }}</div>
<form method="POST" action="{{ route('assets.update', $a->code) }}" class="np" style="margin-top:8px">
@csrf @method('PATCH')
<input name="name" value="{{ $a->name }}" maxlength="60" required style="width:100%;margin-bottom:6px;box-sizing:border-box">
<input type="date" name="warranty_end" value="{{ $a->warranty_end?->format('Y-m-d') }}" style="width:100%;margin-bottom:6px;box-sizing:border-box">
<button style="width:100%">Save</button>
</form>
<form method="POST" action="{{ route('assets.destroy', $a->code) }}" class="np" style="margin-top:6px" onsubmit="return confirm('{{ $a->code }} মুছে ফেলবেন? এর সব Ticket-ও মুছে যাবে।')">
@csrf @method('DELETE')
<button style="width:100%;background:#dc2626">Delete</button>
</form>
</div>
@endforeach
</div></div>

<div class="c np"><b>Tickets (QR দিয়ে আসা Issue)</b><br><br>
<div class="t"><table>
<tr><th>ID</th><th>Asset</th><th>Issue</th><th>Reporter</th><th>Priority</th><th>Technician</th><th>Status</th><th>Action</th></tr>
@forelse ($tickets as $t)
<tr>
<td>{{ $t->ticket_no }}</td>
<td>{{ $t->asset->name }}</td>
<td>{{ $t->issue }}</td>
<td>{{ $t->reporter }}</td>
<td>{{ $t->priority }}</td>
<td>{{ $t->technician?->name ?? 'Unassigned' }}</td>
<td>
<form method="POST" action="{{ route('tickets.update', $t->id) }}">
@csrf @method('PATCH')
<select name="status" onchange="this.form.submit()">
@foreach (['Open','In Progress','Resolved'] as $s)<option @selected($t->status === $s)>{{ $s }}</option>@endforeach
</select>
</form>
</td>
<td><a href="{{ route('tickets.show', $t->id) }}" style="color:#2563eb;">Details</a></td>
</tr>
@empty
<tr><td colspan="8">এখনো কোনো Ticket নেই</td></tr>
@endforelse
</table></div></div>
</div></body></html>