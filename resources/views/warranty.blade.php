<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Warranty</title>
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
.nav-links a.active { background: rgba(59, 130, 246, 0.15); color: #3b82f6; border-color: rgba(59, 130, 246, 0.3); }
.theme-btn { background: var(--card-bg); border: 1px solid var(--card-border); color: var(--text-main); padding: 8px 14px; border-radius: 10px; cursor: pointer; font-size: 16px; margin-left: 15px; }

/* ---------- Main Layout ---------- */
.container { max-width: 1300px; margin: 40px auto; padding: 0 20px; }

/* ---------- Panels ---------- */
.panel { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 20px; padding: 24px; backdrop-filter: blur(10px); margin-bottom: 25px; }
.panel-title { font-size: 18px; font-weight: 600; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; }
.panel-desc { font-size: 14px; color: var(--text-muted); margin-bottom: 20px; }

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

/* ---------- Asset Links ---------- */
.asset-link { color: #3b82f6; font-weight: 500; }
.asset-link:hover { text-decoration: underline; }

@media(max-width: 768px) {
    .navbar { flex-direction: column; gap: 15px; padding: 15px; }
    .nav-links { width: 100%; overflow-x: auto; padding-bottom: 5px; }
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
        <a href="{{ route('warranty.index') }}" class="active">Warranty</a>
        <a href="{{ route('maintenance.index') }}">Maintenance</a>
        <a href="{{ route('technicians.index') }}">Technicians</a>
        <button id="theme-toggle" class="theme-btn" title="Toggle Theme">🌙</button>
    </div>
</nav>

<div class="container">
    <!-- Warranty Tracker Table -->
    <div class="panel">
        <div class="panel-title">🛡️ Warranty Tracker</div>
        <p class="panel-desc">৩০ দিনের মধ্যে শেষ হবে এমন Asset "Expiring soon" দেখায়। প্রতিদিন সকাল ৮টায় Email Alert যায়।</p>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Asset</th>
                        <th>Warranty Ends</th>
                        <th>Remaining</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $a)
                        @php($d = $a->daysLeft())
                        <tr>
                            <td><b>{{ $a->code }}</b></td>
                            <td><a href="{{ route('assets.history', $a->code) }}" class="asset-link">{{ $a->name }}</a></td>
                            <td>{{ $a->warranty_end->format('d M Y') }}</td>
                            <td>{{ $d < 0 ? '—' : $d . ' দিন' }}</td>
                            <td>
                                @if ($d < 0)
                                    <span class="badge bg-red">Expired</span>
                                @elseif ($d <= 30)
                                    <span class="badge bg-yellow">Expiring soon</span>
                                @else
                                    <span class="badge bg-green">OK</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Warranty তারিখ দেওয়া কোনো Asset নেই</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- No Warranty Section -->
    @if ($noWarranty->count())
        <div class="panel">
            <div class="panel-title">⚠️ No Warranty Date</div>
            <p class="panel-desc" style="margin-bottom: 0;">{{ $noWarranty->pluck('code')->implode(', ') }}</p>
        </div>
    @endif
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