<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – {{ $asset->name }} History</title>
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
.theme-btn { background: var(--card-bg); border: 1px solid var(--card-border); color: var(--text-main); padding: 8px 14px; border-radius: 10px; cursor: pointer; font-size: 16px; margin-left: 15px; }

/* ---------- Main Layout ---------- */
.container { max-width: 1300px; margin: 40px auto; padding: 0 20px; }
.header-title { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px; }
.header-title h1 { font-size: 26px; font-weight: 600; margin-bottom: 5px; }
.header-title p { color: var(--text-muted); font-size: 14px; }

/* ---------- Stat Cards ---------- */
.stats-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 25px; }
.stat-card { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 16px; padding: 20px; position: relative; overflow: hidden; backdrop-filter: blur(10px); }
.stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: #3b82f6; }
.stat-card.green::before { background: #10b981; }
.stat-card.orange::before { background: #f59e0b; }
.stat-card.purple::before { background: #a855f7; }
.stat-title { font-size: 13px; color: var(--text-muted); font-weight: 500; margin-bottom: 8px; }
.stat-value { font-size: 32px; font-weight: 700; }

/* ---------- Panels ---------- */
.panel { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 20px; padding: 24px; backdrop-filter: blur(10px); margin-bottom: 25px; }
.panel-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }

/* ---------- Asset Info Grid ---------- */
.info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; }
.info-item { display: flex; flex-direction: column; gap: 4px; }
.info-label { font-size: 13px; color: var(--text-muted); }
.info-value { font-size: 15px; font-weight: 500; }

/* ---------- Tables ---------- */
.table-responsive { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; text-align: left; }
th { font-size: 12px; text-transform: uppercase; color: var(--text-muted); font-weight: 600; padding: 12px 15px; border-bottom: 1px solid var(--card-border); }
td { padding: 14px 15px; font-size: 14px; border-bottom: 1px solid var(--card-border); color: var(--text-main); vertical-align: top; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: var(--table-hover); }

/* ---------- Badges & Buttons ---------- */
.badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-block; white-space: nowrap; }
.bg-red { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
.bg-yellow { background: rgba(245, 158, 11, 0.15); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.3); }
.bg-green { background: rgba(16, 185, 129, 0.15); color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); }
.bg-blue { background: rgba(59, 130, 246, 0.15); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.3); }

.btn { padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: 0.3s; }
.btn-primary { background: #3b82f6; color: white; box-shadow: 0 4px 15px var(--blue-glow); }
.btn-primary:hover { background: #2563eb; }
.btn-outline { background: transparent; color: var(--text-main); border: 1px solid var(--card-border); }
.btn-outline:hover { background: var(--table-hover); }

.text-right { text-align: right; }

@media(max-width: 768px) {
    .navbar { flex-direction: column; gap: 15px; padding: 15px; }
    .nav-links { width: 100%; overflow-x: auto; padding-bottom: 5px; }
    .header-title { flex-direction: column; align-items: flex-start; }
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-brand">
        <span class="logo-box">⚡</span> AssetCare
    </div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.home') }}">Assets & Tickets</a>
        <a href="{{ route('warranty.index') }}">Warranty</a>
        <a href="{{ route('maintenance.index') }}">Maintenance</a>
        <a href="{{ route('technicians.index') }}">Technicians</a>
        <button id="theme-toggle" class="theme-btn" title="Toggle Theme">🌙</button>
    </div>
</nav>

<div class="container">
    <!-- Header -->
    <div class="header-title">
        <div>
            <h1>{{ $asset->name }} <span style="font-size: 16px; color: var(--text-muted); font-weight: 400;">({{ $asset->code }})</span></h1>
            <p>Service History & Real-time Asset Information</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" class="btn btn-outline">🖨️ Print</button>
            <a href="{{ route('admin.home') }}" class="btn btn-primary">← All Assets</a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Completed Jobs</div>
            <div class="stat-value">{{ $history->count() }}</div>
        </div>
        <div class="stat-card green">
            <div class="stat-title">Total Cost</div>
            <div class="stat-value">{{ number_format($totalCost, 2) }}</div>
        </div>
        <div class="stat-card orange">
            <div class="stat-title">Last Service</div>
            <div class="stat-value" style="font-size: 22px; margin-top: 6px;">{{ $asset->last_service_date?->format('d M Y') ?? '—' }}</div>
        </div>
        <div class="stat-card purple">
            <div class="stat-title">Next Service Due</div>
            <div class="stat-value" style="font-size: 22px; margin-top: 6px; display: flex; align-items: center; gap: 10px;">
                {{ $asset->next_service_date?->format('d M Y') ?? '—' }}
                @php($sd = $asset->serviceDaysLeft())
                @if ($sd !== null)
                    @if ($sd < 0)<span class="badge bg-red">Overdue</span>
                    @elseif ($sd <= 7)<span class="badge bg-yellow">{{ $sd }} দিনে Due</span>
                    @else<span class="badge bg-green">{{ $sd }} দিন পরে</span>@endif
                @endif
            </div>
        </div>
    </div>

    <!-- Asset Info Panel -->
    <div class="panel">
        <div class="panel-title">📦 Asset Information</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Category</div>
                <div class="info-value">{{ $asset->category }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Warranty End</div>
                <div class="info-value">
                    {{ $asset->warranty_end ? $asset->warranty_end->format('d M Y') : '—' }}
                    @if ($asset->warranty_end)
                        @php($wd = $asset->daysLeft())
                        @if ($wd < 0)<span class="badge bg-red" style="margin-left:8px;">Expired</span>
                        @elseif ($wd <= 30)<span class="badge bg-yellow" style="margin-left:8px;">{{ $wd }} দিন বাকি</span>
                        @else<span class="badge bg-green" style="margin-left:8px;">OK</span>@endif
                    @endif
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Service Interval</div>
                <div class="info-value">{{ $asset->service_interval_days ? $asset->service_interval_days . ' দিন' : '—' }}</div>
            </div>
        </div>
    </div>

    <!-- Open Tickets Panel -->
    <div class="panel">
        <div class="panel-title">🚨 Open Tickets</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Issue</th>
                        <th>Priority</th>
                        <th>Technician</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($open as $t)
                        <tr>
                            <td><a href="{{ route('tickets.show', $t->id) }}" style="color: #3b82f6; font-weight: 600;">{{ $t->ticket_no }}</a></td>
                            <td>{{ $t->issue }}</td>
                            <td>
                                <span class="badge {{ ['High' => 'bg-red', 'Medium' => 'bg-yellow', 'Low' => 'bg-blue'][$t->priority] ?? 'bg-blue' }}">{{ $t->priority }}</span>
                            </td>
                            <td>{{ $t->technician?->name ?? 'Unassigned' }}</td>
                            <td>
                                <span class="badge {{ ['Open' => 'bg-red', 'In Progress' => 'bg-yellow'][$t->status] ?? 'bg-blue' }}">{{ $t->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">No open tickets at the moment.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Service History Panel -->
    <div class="panel">
        <div class="panel-title">📜 Service History (Completed Jobs)</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Ticket</th>
                        <th>Type</th>
                        <th>Issue</th>
                        <th>Technician</th>
                        <th>Note</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($history as $t)
                        <tr>
                            <td>{{ ($t->resolved_at ?? $t->updated_at)->format('d M Y') }}</td>
                            <td><a href="{{ route('tickets.show', $t->id) }}" style="color: #3b82f6; font-weight: 600;">{{ $t->ticket_no }}</a></td>
                            <td>
                                @if ($t->source === 'Maintenance')
                                    <span class="badge" style="background: rgba(168, 85, 247, 0.15); color: #a855f7; border: 1px solid rgba(168, 85, 247, 0.3);">Maintenance</span>
                                @else
                                    <span class="badge bg-blue">Issue</span>
                                @endif
                            </td>
                            <td>{{ $t->issue }}</td>
                            <td>{{ $t->technician?->name ?? '—' }}</td>
                            <td>{{ $t->technician_note ?? '—' }}</td>
                            <td><b>{{ $t->cost !== null ? number_format((float) $t->cost, 2) : '—' }}</b></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 30px;">No service history yet. Resolved tickets will appear here.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-right" style="margin-top: 20px; font-size: 18px; font-weight: 700; border-top: 2px solid var(--card-border); padding-top: 15px;">
            Total Cost: {{ number_format($totalCost, 2) }}
        </div>
    </div>
</div>

<script>
    const themeBtn = document.getElementById('theme-toggle');
    const htmlTag = document.documentElement;
    
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        htmlTag.setAttribute('data-theme', savedTheme);
        themeBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
    }

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