<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – {{ $ticket->ticket_no }}</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;color:#0f172a}
.w{max-width:1000px;margin:0 auto;padding:20px}h1{color:#2563eb;margin:0 0 4px}
.nav a{margin-right:14px;color:#2563eb}
.c{background:#fff;border-radius:12px;padding:16px;margin:0;box-shadow:0 1px 4px #0002}
.g2{display:grid;gap:14px;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));margin:16px 0}
.c h3{margin:0 0 10px;font-size:16px}
.kv{display:grid;grid-template-columns:120px 1fr;gap:6px 10px;font-size:14px}.kv b{color:#64748b;font-weight:600}
label{display:block;font-size:14px;margin-top:10px}
input,select,textarea,button{font:inherit;padding:8px;border-radius:8px;border:1px solid #cbd5e1;max-width:100%}
label input,label select,label textarea{width:100%;margin-top:3px;box-sizing:border-box}
button{background:#2563eb;color:#fff;border:0;cursor:pointer}
.ok{color:#166534}.er{color:#b91c1c}.s{color:#64748b;font-size:13px}
.b{padding:2px 10px;border-radius:99px;font-size:12px;background:#e2e8f0}
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

<h2 style="margin:16px 0 0">{{ $ticket->ticket_no }}
<span class="b {{ ['Open' => 'r', 'In Progress' => 'y', 'Resolved' => 'g'][$ticket->status] ?? '' }}">{{ $ticket->status }}</span></h2>
<p><a href="{{ route('admin.home') }}">← সব Ticket</a></p>

<div class="g2">
<div class="c"><h3>Ticket তথ্য</h3><div class="kv">
<b>Asset</b><span>{{ $ticket->asset->name }} ({{ $ticket->asset->code }})</span>
<b>সমস্যা</b><span>{{ $ticket->issue }}</span>
<b>Priority</b><span>{{ $ticket->priority }}</span>
<b>Reporter</b><span>{{ $ticket->reporter }}</span>
<b>ধরন</b><span>{{ $ticket->source === 'Maintenance' ? 'Maintenance (Auto)' : 'QR Issue Report' }}</span>
<b>তৈরি</b><span>{{ $ticket->created_at->format('d M Y, h:i A') }}</span>
<b>Technician</b><span>{{ $ticket->technician?->name ?? 'Unassigned' }}</span>
@if ($ticket->resolved_at)
<b>Resolved</b><span>{{ $ticket->resolved_at->format('d M Y, h:i A') }}</span>
@endif
@if ($ticket->cost !== null)
<b>Cost</b><span>{{ number_format((float) $ticket->cost, 2) }}</span>
@endif
</div></div>

<div class="c"><h3>work update</h3>
<form method="POST" action="{{ route('tickets.update', $ticket->id) }}">
@csrf @method('PATCH')
<label>Technician Assign করুন
<select name="technician_id">
<option value="">— Unassigned —</option>
@foreach ($technicians as $tech)
<option value="{{ $tech->id }}" @selected((int) old('technician_id', $ticket->technician_id) === $tech->id)>{{ $tech->name }}</option>
@endforeach
</select></label>
<label>Status
<select name="status">
@foreach (['Open', 'In Progress', 'Resolved'] as $s)<option @selected(old('status', $ticket->status) === $s)>{{ $s }}</option>@endforeach
</select></label>
<label>কাজের Note
<textarea name="technician_note" rows="4" maxlength="1000">{{ old('technician_note', $ticket->technician_note) }}</textarea></label>
<label>Cost
<input type="number" step="0.01" min="0" name="cost" value="{{ old('cost', $ticket->cost) }}"></label>
<p><button>Save</button></p>
@if ($technicians->isEmpty())<p class="s">কোনো Technician নেই। আগে <a href="{{ route('technicians.index') }}">Technicians পেজে</a> যোগ করুন।</p>@endif
</form></div>
</div>
</div></body></html>