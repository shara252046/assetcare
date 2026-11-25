<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Dashboard</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

/* 🌞 Default: Light Mode Variables */
:root {
    --bg-color: #f1f5f9;
    --card-bg: #ffffff;
    --card-border: #e2e8f0;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --nav-bg: rgba(255, 255, 255, 0.9);
    
    --blue-glow: rgba(59, 130, 246, 0.2);
    --orange-glow: rgba(249, 115, 22, 0.2);
    --red-glow: rgba(239, 68, 68, 0.2);
    --purple-glow: rgba(168, 85, 247, 0.2);
    --green-glow: rgba(16, 185, 129, 0.2);
    
    --table-hover: #f8fafc;
    --progress-bg: #e2e8f0;
}

/* 🌙 Dark Mode Variables */
[data-theme="dark"] {
    --bg-color: #0b0f19;
    --card-bg: rgba(255, 255, 255, 0.03);
    --card-border: rgba(255, 255, 255, 0.08);
    --text-main: #f8fafc;
    --text-muted: #94a3b8;
    --nav-bg: rgba(11, 15, 25, 0.8);
    
    --blue-glow: rgba(59, 130, 246, 0.5);
    --orange-glow: rgba(249, 115, 22, 0.5);
    --red-glow: rgba(239, 68, 68, 0.5);
    --purple-glow: rgba(168, 85, 247, 0.5);
    --green-glow: rgba(16, 185, 129, 0.5);
    
    --table-hover: rgba(255, 255, 255, 0.02);
    --progress-bg: rgba(255, 255, 255, 0.1);
}

* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

body {
    background-color: var(--bg-color);
    color: var(--text-main);
    min-height: 100vh;
    transition: background-color 0.3s, color 0.3s;
    /* Background e subtle gradient glow */
    background-image: 
        radial-gradient(circle at 15% 50%, rgba(59, 130, 246, 0.05), transparent 25%),
        radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.05), transparent 25%);
}

a { text-decoration: none; color: inherit; transition: 0.3s; }

/* ---------- Navbar ---------- */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 40px;
    background: var(--nav-bg);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--card-border);
    position: sticky;
    top: 0;
    z-index: 100;
    transition: background 0.3s, border-color 0.3s;
}
.nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: 1px;
}
.nav-brand .logo-box {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    padding: 8px 10px;
    border-radius: 10px;
    font-size: 18px;
    color: #fff;
    box-shadow: 0 0 15px var(--blue-glow);
}
.nav-links { display: flex; gap: 10px; align-items: center; }
.nav-links a {
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 14px;
    color: var(--text-muted);
    border: 1px solid transparent;
}
.nav-links a:hover {
    color: var(--text-main);
    background: var(--table-hover);
    border-color: var(--card-border);
}
.nav-links a.active {
    background: rgba(59, 130, 246, 0.15);
    color: #3b82f6;
    border-color: rgba(59, 130, 246, 0.3);
}

/* 🌙 Theme Toggle Button */
.theme-btn {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    color: var(--text-main);
    padding: 8px 14px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 15px;
    transition: 0.3s;
}
.theme-btn:hover { background: var(--table-hover); }

/* ---------- Main Layout ---------- */
.container { max-width: 1300px; margin: 40px auto; padding: 0 20px; }
.header-title h1 { font-size: 28px; font-weight: 600; margin-bottom: 5px; }
.header-title p { color: var(--text-muted); font-size: 14px; }
.header-title { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }

/* ---------- Stat Cards (Glassmorphism) ---------- */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}
.stat-card {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 20px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}
.stat-card:hover { transform: translateY(-5px); border-color: rgba(59, 130, 246, 0.3); }
.stat-card::before {
    content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
    opacity: 0.15; z-index: 0; transition: 0.3s;
}
.stat-card.blue::before { background: radial-gradient(circle at top right, #3b82f6, transparent 70%); }
.stat-card.orange::before { background: radial-gradient(circle at top right, #f97316, transparent 70%); }
.stat-card.red::before { background: radial-gradient(circle at top right, #ef4444, transparent 70%); }
.stat-card.purple::before { background: radial-gradient(circle at top right, #a855f7, transparent 70%); }
.stat-card:hover::before { opacity: 0.25; }

.stat-content { position: relative; z-index: 1; }
.stat-title { font-size: 14px; color: var(--text-muted); font-weight: 500; }
.stat-value { font-size: 38px; font-weight: 700; margin: 10px 0; }
.stat-desc { font-size: 12px; color: var(--text-muted); }

/* ---------- Action Buttons ---------- */
.action-bar { display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap; }
.btn {
    padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 500;
    cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 8px;
    transition: 0.3s; text-decoration: none;
}
.btn-primary { background: #3b82f6; color: white; box-shadow: 0 4px 15px var(--blue-glow); }
.btn-primary:hover { background: #2563eb; transform: translateY(-2px); }
.btn-outline { background: transparent; color: var(--text-main); border: 1px solid var(--card-border); }
.btn-outline:hover { background: var(--table-hover); border-color: rgba(255,255,255,0.2); }
.btn-green { background: #10b981; color: white; box-shadow: 0 4px 15px var(--green-glow); }
.btn-green:hover { background: #059669; transform: translateY(-2px); }

/* ---------- Content Grids ---------- */
.grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; margin-bottom: 30px; }
.panel {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: 20px;
    padding: 24px;
    backdrop-filter: blur(10px);
    transition: background 0.3s, border-color 0.3s;
}
.panel-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.panel-title .dot { width: 8px; height: 8px; border-radius: 50%; }
.dot-blue { background: #3b82f6; box-shadow: 0 0 10px #3b82f6; }
.dot-green { background: #10b981; box-shadow: 0 0 10px #10b981; }
.dot-red { background: #ef4444; box-shadow: 0 0 10px #ef4444; }

/* ---------- Modern Table ---------- */
.table-responsive { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; text-align: left; }
th { font-size: 12px; text-transform: uppercase; color: var(--text-muted); font-weight: 600; padding: 12px 15px; border-bottom: 1px solid var(--card-border); }
td { padding: 14px 15px; font-size: 14px; border-bottom: 1px solid var(--card-border); color: var(--text-main); }
tr:last-child td { border-bottom: none; }
tr:hover td { background: var(--table-hover); }

/* ---------- Badges ---------- */
.badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-block; }
.bg-red { background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); }
.bg-yellow { background: rgba(245, 158, 11, 0.15); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.3); }
.bg-green { background: rgba(16, 185, 129, 0.15); color: #059669; border: 1px solid rgba(16, 185, 129, 0.3); }
.bg-blue { background: rgba(59, 130, 246, 0.15); color: #2563eb; border: 1px solid rgba(59, 130, 246, 0.3); }

/* ---------- Donut Chart ---------- */
.chart-container { display: flex; align-items: center; justify-content: space-around; flex-wrap: wrap; gap: 20px; }
.donut-svg { width: 160px; height: 160px; }
.legend-list { display: flex; flex-direction: column; gap: 12px; }
.legend-item { display: flex; align-items: center; justify-content: space-between; font-size: 14px; min-width: 120px; }
.sw { width: 12px; height: 12px; border-radius: 4px; display: inline-block; margin-right: 8px; }
.sw-AC { background: #3b82f6; }
.sw-Computer { background: #10b981; }
.sw-Printer { background: #f59e0b; }
.sw-Vehicle { background: #a855f7; }

/* ---------- Progress Bar ---------- */
.p-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
progress.pb { -webkit-appearance: none; appearance: none; width: 100%; height: 8px; border-radius: 10px; background: var(--progress-bg); border: none; margin-bottom: 18px; }
progress.pb::-webkit-progress-bar { background: var(--progress-bg); border-radius: 10px; }
progress.pb::-webkit-progress-value { background: var(--c, #3b82f6); border-radius: 10px; }
progress.pb::-moz-progress-bar { background: var(--c, #3b82f6); border-radius: 10px; }
progress.pb.r { --c: #ef4444; }
progress.pb.y { --c: #f59e0b; }
progress.pb.g { --c: #10b981; }

.empty-msg { text-align: center; color: var(--text-muted); padding: 20px; font-size: 14px; }

/* Responsive */
@media(max-width: 768px) {
    .navbar { flex-direction: column; gap: 15px; padding: 15px; }
    .nav-links { width: 100%; overflow-x: auto; padding-bottom: 5px; }
    .grid-2 { grid-template-columns: 1fr; }
    .header-title { flex-direction: column; align-items: flex-start; gap: 10px; }
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
        <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('admin.home') }}">Assets & Tickets</a>
        <a href="{{ route('warranty.index') }}">Warranty</a>
        <a href="{{ route('maintenance.index') }}">Maintenance</a>
        <a href="{{ route('technicians.index') }}">Technicians</a>
        
        <!-- 🌙 Light/Dark Mode Toggle Button -->
        <button id="theme-toggle" class="theme-btn" title="Toggle Theme">🌙</button>
    </div>
</nav>

<div class="container">
    <!-- Header -->
    <div class="header-title">
        <div>
            <h1>System Overview 📊</h1>
            <p>{{ now()->format('l, d M Y') }} · Real-time insights of your assets</p>
        </div>
    </div>

    @if (session('ok'))
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
            ✅ {{ session('ok') }}
        </div>
    @endif

    <!-- Stat Cards -->
    <div class="stats-grid">
        <a class="stat-card blue" href="{{ route('admin.home') }}">
            <div class="stat-content">
                <div class="stat-title">Total Assets</div>
                <div class="stat-value">{{ $stats['total'] }}</div>
                
            </div>
        </a>
        <a class="stat-card orange" href="{{ route('admin.home') }}">
            <div class="stat-content">
                <div class="stat-title">Open Tickets</div>
                <div class="stat-value">{{ $stats['open'] }}</div>
                
            </div>
        </a>
        <a class="stat-card red" href="{{ route('maintenance.index') }}">
            <div class="stat-content">
                <div class="stat-title">Overdue Maintenance</div>
                <div class="stat-value">{{ $stats['overdue'] }}</div>
                
            </div>
        </a>
        <a class="stat-card purple" href="{{ route('warranty.index') }}">
            <div class="stat-content">
                <div class="stat-title">Warranty Expiring</div>
                <div class="stat-value">{{ $stats['warranty'] }}</div>
                
            </div>
        </a>
    </div>

    <!-- Action Buttons -->
    <div class="action-bar">
        <a class="btn btn-primary" href="{{ route('admin.home') }}">➕ Add New Asset</a>
        <a class="btn btn-outline" href="{{ route('maintenance.index') }}">🗓️ Schedule Maintenance</a>
        <form method="POST" action="{{ route('maintenance.run') }}" style="margin:0;">
            @csrf
            <button class="btn btn-green">⚙️ Run Maintenance Check</button>
        </form>
    </div>

    <!-- Chart Panels -->
    <div class="grid-2">
        <!-- Asset Chart -->
        <div class="panel">
            <div class="panel-title"><span class="dot dot-blue"></span> Asset Overview</div>
            @php
                $palette = ['AC' => '#3b82f6', 'Computer' => '#10b981', 'Printer' => '#f59e0b', 'Vehicle' => '#a855f7'];
                $totalAssets = max($stats['total'], 1);
                $offset = 0;
            @endphp
            <div class="chart-container">
                <svg class="donut-svg" viewBox="0 0 42 42">
                    <circle cx="21" cy="21" r="15.915" fill="none" stroke="var(--progress-bg)" stroke-width="6"></circle>
                    @foreach ($byCategory as $cat => $n)
                        @php($len = $n / $totalAssets * 100)
                        <circle cx="21" cy="21" r="15.915" fill="none" stroke="{{ $palette[$cat] ?? '#64748b' }}" stroke-width="6" pathLength="100" stroke-dasharray="{{ round($len, 2) }} {{ round(100 - $len, 2) }}" stroke-dashoffset="{{ round(-$offset, 2) }}" transform="rotate(-90 21 21)"></circle>
                        @php($offset += $len)
                    @endforeach
                    <text x="21" y="22" text-anchor="middle" style="font-size: 8px; font-weight: 700; fill: var(--text-main);">{{ $stats['total'] }}</text>
                    <text x="21" y="26.5" text-anchor="middle" style="font-size: 2.6px; fill: var(--text-muted);">Assets</text>
                </svg>
                <div class="legend-list">
                    @forelse ($byCategory as $cat => $n)
                        <div class="legend-item">
                            <span><span class="sw sw-{{ $cat }}"></span>{{ $cat }}</span>
                            <b>{{ $n }}</b>
                        </div>
                    @empty
                        <p class="empty-msg">No Assets Found</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Ticket Chart -->
        <div class="panel">
            <div class="panel-title"><span class="dot dot-green"></span> Ticket Status</div>
            @php($totalTickets = max($ticketCounts->sum(), 1))
            @foreach (['Open' => 'r', 'In Progress' => 'y', 'Resolved' => 'g'] as $st => $cls)
                @php($n = $ticketCounts->get($st, 0))
                <div class="p-row"><span>{{ $st }}</span><b>{{ $n }}</b></div>
                <progress class="pb {{ $cls }}" value="{{ $n }}" max="{{ $totalTickets }}"></progress>
            @endforeach
            <p style="margin-top:10px; color:var(--text-muted); font-size:13px;">Total Tickets Generated: <b>{{ $ticketCounts->sum() }}</b></p>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid-2">
        <!-- Maintenance -->
        <div class="panel">
            <div class="panel-title"><span class="dot dot-green"></span> Upcoming Maintenance</div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr><th>Asset</th><th>Due Date</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($upcoming as $a)
                            @php($d = $a->serviceDaysLeft())
                            <tr>
                                <td><a href="{{ route('assets.history', $a->code) }}" style="color:#3b82f6;">{{ $a->name }}</a></td>
                                <td>{{ $a->next_service_date->format('d M Y') }}</td>
                                <td>
                                    @if ($d < 0)<span class="badge bg-red">Overdue</span>
                                    @elseif ($d <= 7)<span class="badge bg-yellow">{{ $d }} days left</span>
                                    @else<span class="badge bg-green">{{ $d }} days left</span>@endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="empty-msg">📭 No Schedules</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Warranty -->
        <div class="panel">
            <div class="panel-title"><span class="dot dot-red"></span> Warranty Alerts (30 Days)</div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr><th>Asset</th><th>Ends On</th><th>Remaining</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($expiring as $a)
                            @php($wd = $a->daysLeft())
                            <tr>
                                <td><a href="{{ route('assets.history', $a->code) }}" style="color:#3b82f6;">{{ $a->name }}</a></td>
                                <td>{{ $a->warranty_end->format('d M Y') }}</td>
                                <td><span class="badge {{ $wd <= 7 ? 'bg-red' : 'bg-yellow' }}">{{ $wd }} days left</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="empty-msg">🎉 No Expiring Warranties</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Tickets -->
    <div class="panel" style="margin-bottom: 30px;">
        <div class="panel-title"><span class="dot dot-blue"></span> Recent Tickets</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr><th>ID</th><th>Asset</th><th>Issue</th><th>Priority</th><th>Status</th><th>Date</th></tr>
                </thead>
                <tbody>
                    @forelse ($recent as $t)
                        <tr>
                            <td><a href="{{ route('tickets.show', $t->id) }}" style="color:#3b82f6; font-weight: 600;">{{ $t->ticket_no }}</a></td>
                            <td>{{ $t->asset->name }}</td>
                            <td>{{ $t->issue }}</td>
                            <td>
                                <span class="badge {{ ['High' => 'bg-red', 'Medium' => 'bg-yellow', 'Low' => 'bg-blue'][$t->priority] ?? 'bg-blue' }}">
                                    {{ $t->priority }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ ['Open' => 'bg-red', 'In Progress' => 'bg-yellow', 'Resolved' => 'bg-green'][$t->status] ?? 'bg-blue' }}">
                                    {{ $t->status }}
                                </span>
                            </td>
                            <td>{{ $t->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-msg">🎫 No Tickets Found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- 🌙 Theme Toggle Script -->
<script>
    const themeBtn = document.getElementById('theme-toggle');
    const htmlTag = document.documentElement;

    // Check local storage for saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        htmlTag.setAttribute('data-theme', savedTheme);
        themeBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';
    }

    // Toggle button click event
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