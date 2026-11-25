<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Assets & Tickets</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --bg-color: #f1f5f9;
    --card-bg: #ffffff;
    --card-border: #e2e8f0;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --nav-bg: rgba(255, 255, 255, 0.9);
    --table-hover: #f8fafc;
    --input-bg: #f8fafc;
    --input-border: #cbd5e1;
    --blue-glow: rgba(59, 130, 246, 0.2);
}

[data-theme="dark"] {
    --bg-color: #0b0f19;
    --card-bg: rgba(255, 255, 255, 0.03);
    --card-border: rgba(255, 255, 255, 0.08);
    --text-main: #f8fafc;
    --text-muted: #94a3b8;
    --nav-bg: rgba(11, 15, 25, 0.8);
    --table-hover: rgba(255, 255, 255, 0.02);
    --input-bg: rgba(0, 0, 0, 0.2);
    --input-border: rgba(255, 255, 255, 0.1);
    --blue-glow: rgba(59, 130, 246, 0.5);
}

* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

body {
    background-color: var(--bg-color);
    color: var(--text-main);
    min-height: 100vh;
    transition: background-color 0.3s, color 0.3s;
    background-image: radial-gradient(circle at 15% 50%, rgba(59, 130, 246, 0.05), transparent 25%),
                      radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.05), transparent 25%);
}

a { text-decoration: none; color: inherit; }
a:hover { text-decoration: none; }

/* ---------- Navbar ---------- */
.navbar {
    display: flex; justify-content: space-between; align-items: center;
    padding: 20px 40px; background: var(--nav-bg); backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--card-border); position: sticky; top: 0; z-index: 100;
}
.nav-brand { display: flex; align-items: center; gap: 12px; font-size: 22px; font-weight: 700; }
.nav-brand .logo-box { background: linear-gradient(135deg, #3b82f6, #8b5cf6); padding: 8px 10px; border-radius: 10px; font-size: 18px; color: #fff; box-shadow: 0 0 15px var(--blue-glow); }
.nav-links { display: flex; gap: 10px; align-items: center; }
.nav-links a { padding: 8px 18px; border-radius: 30px; font-size: 14px; color: var(--text-muted); border: 1px solid transparent; }
.nav-links a:hover { color: var(--text-main); background: var(--table-hover); border-color: var(--card-border); }
.nav-links a.active { background: rgba(59, 130, 246, 0.15); color: #3b82f6; border-color: rgba(59, 130, 246, 0.3); }
.theme-btn { background: var(--card-bg); border: 1px solid var(--card-border); color: var(--text-main); padding: 8px 14px; border-radius: 10px; cursor: pointer; font-size: 16px; margin-left: 15px; }

/* ---------- Main Layout ---------- */
.container { max-width: 1300px; margin: 40px auto; padding: 0 20px; }

/* ---------- Alerts ---------- */
.alert-warning { background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); color: #d97706; padding: 15px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.alert-success { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; padding: 15px; border-radius: 12px; margin-bottom: 20px; }

/* ---------- Panels ---------- */
.panel { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 20px; padding: 24px; backdrop-filter: blur(10px); margin-bottom: 25px; }
.panel-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }

/* ---------- Forms & Inputs ---------- */
.form-row { display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; }
.form-group { display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 150px; }
.form-group label { font-size: 13px; color: var(--text-muted); font-weight: 500; }
input, select { width: 100%; padding: 12px 15px; border-radius: 10px; background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main); font-family: inherit; font-size: 14px; transition: 0.2s; }
input:focus, select:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }

/* ---------- Buttons ---------- */
.btn { padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: 0.3s; }
.btn-primary { background: #3b82f6; color: white; box-shadow: 0 4px 15px var(--blue-glow); }
.btn-primary:hover { background: #2563eb; transform: translateY(-2px); }
.btn-outline { background: transparent; color: var(--text-main); border: 1px solid var(--card-border); }
.btn-outline:hover { background: var(--table-hover); }
.btn-danger { background: #ef4444; color: white; }
.btn-danger:hover { background: #dc2626; }

/* ---------- Asset Grid (QR Cards) ---------- */
.asset-grid { display: grid; gap: 20px; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); }
.asset-card { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 16px; padding: 20px; text-align: center; transition: 0.3s; position: relative; }
.asset-card:hover { transform: translateY(-5px); border-color: rgba(59, 130, 246, 0.4); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
.qr-img { width: 100%; max-width: 160px; margin: 0 auto 15px; display: block; border-radius: 8px; background: #fff; padding: 5px; }
.asset-name { font-weight: 600; font-size: 16px; margin-bottom: 4px; }
.asset-code { font-size: 13px; color: var(--text-muted); margin-bottom: 12px; }
.history-link { font-size: 13px; color: #3b82f6; display: inline-block; margin-bottom: 15px; font-weight: 500; }
.history-link:hover { text-decoration: underline; }
.asset-actions { display: flex; flex-direction: column; gap: 8px; margin-top: 10px; }
.asset-actions input { padding: 8px 10px; font-size: 13px; }

/* ---------- Tables ---------- */
.table-responsive { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; text-align: left; }
th { font-size: 12px; text-transform: uppercase; color: var(--text-muted); font-weight: 600; padding: 12px 15px; border-bottom: 1px solid var(--card-border); }
td { padding: 14px 15px; font-size: 14px; border-bottom: 1px solid var(--card-border); color: var(--text-main); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: var(--table-hover); }

/* ---------- Badges ---------- */
.badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-block; }
.bg-red { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
.bg-yellow { background: rgba(245, 158, 11, 0.15); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.3); }
.bg-green { background: rgba(16, 185, 129, 0.15); color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); }
.bg-blue { background: rgba(59, 130, 246, 0.15); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.3); }

.status-select { padding: 6px 10px; border-radius: 8px; font-size: 13px; width: auto; background: var(--input-bg); color: var(--text-main); border: 1px solid var(--input-border); cursor: pointer; }

@media print {
    .navbar, .no-print, .alert-warning, .panel:first-child, .asset-actions, .history-link { display: none !important; }
    body { background: #fff; color: #000; }
    .panel, .asset-card { border: 1px solid #ddd; box-shadow: none; }
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar no-print">
    <div class="nav-brand">
        <span class="logo-box">⚡</span> AssetCare
    </div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.home') }}" class="active">Assets & Tickets</a>
        <a href="{{ route('warranty.index') }}">Warranty</a>
        <a href="{{ route('maintenance.index') }}">Maintenance</a>
        <a href="{{ route('technicians.index') }}">Technicians</a>
        <button id="theme-toggle" class="theme-btn" title="Toggle Theme">🌙</button>
    </div>
</nav>

<div class="container">
    <!-- Alerts -->
    @if (session('ok'))
        <div class="alert-success">✅ {{ session('ok') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-warning">⚠️ {{ $errors->first() }}</div>
    @endif
    @if ($expiring > 0)
        <div class="alert-warning">
            ⚠️ {{ $expiring }} টি Asset-এর Warranty আগামী ৩০ দিনের মধ্যে শেষ হবে। 
            <a href="{{ route('warranty.index') }}" style="text-decoration: underline; margin-left: auto; font-weight: 600;">Warranty দেখুন</a>
        </div>
    @endif

    <!-- Add Asset Panel -->
    <div class="panel no-print">
        <div class="panel-title">Add New Asset</div>
        <form method="POST" action="{{ route('assets.store') }}" class="form-row">
            @csrf
            <div class="form-group" style="flex: 2;">
                <label>Asset Name</label>
                <input name="name" placeholder="e.g. Dell Laptop" maxlength="60" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    @foreach (['AC','Computer','Printer','Vehicle'] as $cat)
                        <option>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Warranty End Date</label>
                <input type="date" name="warranty_end" value="{{ old('warranty_end') }}">
            </div>
            <button class="btn btn-primary" style="height: 44px;">➕ Add Asset</button>
        </form>
    </div>

    <!-- Assets Grid -->
    <div class="panel">
        <div class="panel-title">
            Assets & QR Codes
            <button class="btn btn-outline no-print" onclick="window.print()" style="padding: 8px 16px; font-size: 13px;">🖨️ Print QR Codes</button>
        </div>
        <div class="asset-grid">
            @foreach ($assets as $a)
                <div class="asset-card">
                    <img src="{{ route('assets.qr', $a->code) }}" alt="QR {{ $a->code }}" class="qr-img">
                    <div class="asset-name">{{ $a->name }}</div>
                    <div class="asset-code">{{ $a->code }}</div>
                    <a href="{{ route('assets.history', $a->code) }}" class="history-link">📜 Service History</a>
                    
                    <div class="asset-actions no-print">
                        <form method="POST" action="{{ route('assets.update', $a->code) }}" style="display:flex; flex-direction:column; gap:8px;">
                            @csrf @method('PATCH')
                            <input name="name" value="{{ $a->name }}" maxlength="60" required placeholder="Asset Name">
                            <input type="date" name="warranty_end" value="{{ $a->warranty_end?->format('Y-m-d') }}">
                            <button class="btn btn-outline" style="padding: 8px; font-size: 13px;">Save Changes</button>
                        </form>
                        <form method="POST" action="{{ route('assets.destroy', $a->code) }}" onsubmit="return confirm('{{ $a->code }} মুছে ফেলবেন? এর সব Ticket-ও মুছে যাবে।')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" style="width: 100%; padding: 8px; font-size: 13px;">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tickets Table -->
    <div class="panel">
        <div class="panel-title">Recent Tickets (QR Reported Issues)</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Asset</th>
                        <th>Issue</th>
                        <th>Reporter</th>
                        <th>Priority</th>
                        <th>Technician</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $t)
                        <tr>
                            <td><b>{{ $t->ticket_no }}</b></td>
                            <td>{{ $t->asset->name }}</td>
                            <td>{{ $t->issue }}</td>
                            <td>{{ $t->reporter }}</td>
                            <td>
                                <span class="badge {{ ['High' => 'bg-red', 'Medium' => 'bg-yellow', 'Low' => 'bg-blue'][$t->priority] ?? 'bg-blue' }}">
                                    {{ $t->priority }}
                                </span>
                            </td>
                            <td>{{ $t->technician?->name ?? 'Unassigned' }}</td>
                            <td>
                                <form method="POST" action="{{ route('tickets.update', $t->id) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="status-select {{ $t->status === 'Open' ? 'bg-red' : ($t->status === 'In Progress' ? 'bg-yellow' : 'bg-green') }}">
                                        @foreach (['Open','In Progress','Resolved'] as $s)
                                            <option @selected($t->status === $s)>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('tickets.show', $t->id) }}" class="btn btn-outline" style="padding: 6px 12px; font-size: 12px;">Details →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 30px;">🎫 এখনো কোনো Ticket নেই</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const themeBtn = document.getElementById('theme-toggle');
    const htmlTag = document.documentElement;
    
    // Check for saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        htmlTag.setAttribute('data-theme', savedTheme);
        themeBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
    }

    // Toggle theme
    themeBtn.addEventListener('click', () => {
        const currentTheme = htmlTag.getAttribute('data-theme');
        if (currentTheme === 'dark') {
            htmlTag.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            themeBtn.textContent = '🌙';
        } else {
            htmlTag.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            themeBtn.textContent = '☀️';
        }
    });
</script>
</body>
</html>