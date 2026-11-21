<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Technicians</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1000px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.nav a{margin-right:14px;color:#2563eb}
.c{background:#fff;border-radius:12px;padding:16px;margin:16px 0;box-shadow:0 1px 4px #0002}
table{width:100%;border-collapse:collapse;font-size:14px}th,td{padding:8px 6px;border-bottom:1px solid #e2e8f0;text-align:left}th{color:#64748b}
.t{overflow-x:auto}.s{color:#64748b;font-size:13px}.ok{color:#166534}.er{color:#b91c1c}
input,button{font:inherit;padding:8px;border-radius:8px;border:1px solid #cbd5e1}
button{background:#2563eb;color:#fff;border:0;cursor:pointer}button.d{background:#dc2626}
.row{display:flex;gap:8px;flex-wrap:wrap}
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

<div class="c"><b>নতুন Technician</b><br><br>
<form method="POST" action="{{ route('technicians.store') }}" class="row">
@csrf
<input name="name" placeholder="নাম" maxlength="60" required value="{{ old('name') }}">
<input name="phone" placeholder="ফোন (ঐচ্ছিক)" maxlength="30" value="{{ old('phone') }}">
<input type="email" name="email" placeholder="Email (ঐচ্ছিক)" maxlength="100" value="{{ old('email') }}">
<button>Add Technician</button>
</form></div>

<div class="c"><b>Technician তালিকা</b><br><br><div class="t"><table>
<tr><th>নাম</th><th>ফোন</th><th>Email</th><th>চলমান Ticket</th><th></th></tr>
@forelse ($technicians as $t)
<tr>
<td>{{ $t->name }}</td><td>{{ $t->phone ?? '—' }}</td><td>{{ $t->email ?? '—' }}</td><td>{{ $t->open_count }}</td>
<td><form method="POST" action="{{ route('technicians.destroy', $t->id) }}" onsubmit="return confirm('{{ $t->name }}-কে মুছে ফেলবেন? তার Ticket-গুলো Unassigned হয়ে যাবে।')">@csrf @method('DELETE')<button class="d">Delete</button></form></td>
</tr>
@empty
<tr><td colspan="5">এখনো কোনো Technician নেই</td></tr>
@endforelse
</table></div></div>
</div></body></html>