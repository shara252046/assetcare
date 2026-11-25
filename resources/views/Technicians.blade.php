<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AssetCare – Technicians</title>
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

/* ---------- Panels ---------- */
.panel { background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 20px; padding: 24px; backdrop-filter: blur(10px); margin-bottom: 25px; }
.panel-title { font-size: 18px; font-weight: 600; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }

/* ---------- Forms & Inputs ---------- */
.form-row { display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end; }
.form-group { display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 150px; }
input { width: 100%; padding: 12px 15px; border-radius: 10px; background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main); font-family: inherit; font-size: 14px; transition: 0.2s; }
input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.2); }

/* ---------- Buttons ---------- */
.btn { padding: 12px 24px; border-radius: 10px; font-size: 14px; font-weight: 600; cursor: pointer; border: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: 0.3s; }
.btn-primary { background: #3b82f6; color: white; box-shadow: 0 4px 15px var(--blue-glow); }
.btn-primary:hover { background: #2563eb; transform: translateY(-2px); }
.btn-danger { background: #ef4444; color: white; }
.btn-danger:hover { background: #dc2626; }

/* ---------- Tables ---------- */
.table-responsive { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; text-align: left; }
th { font-size: 12px; text-transform: uppercase; color: var(--text-muted); font-weight: 600; padding: 12px 15px; border-bottom: 1px solid var(--card-border); }
td { padding: 14px 15px; font-size: 14px; border-bottom: 1px solid var(--card-border); color: var(--text-main); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: var(--table-hover); }

/* ---------- Alert ---------- */
.alert-success { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; padding: 15px; border-radius: 12px; margin-bottom: 20px; }
.alert-error { background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 15px; border-radius: 12px; margin-bottom: 20px; }

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
        <a href="{{ route('warranty.index') }}">Warranty</a>
        <a href="{{ route('maintenance.index') }}">Maintenance</a>
        <a href="{{ route('technicians.index') }}" class="active">Technicians</a>
        <button id="theme-toggle" class="theme-btn" title="Toggle Theme">🌙</button>
    </div>
</nav>

<div class="container">
    <!-- Alerts -->
    @if (session('ok'))
        <div class="alert-success">✅ {{ session('ok') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert-error">⚠️ {{ $errors->first() }}</div>
    @endif

    <!-- Add Technician Panel -->
    <div class="panel">
        <div class="panel-title">👷 Add New Technician</div>
        <form method="POST" action="{{ route('technicians.store') }}" class="form-row">
            @csrf
            <div class="form-group" style="flex: 2;">
                <input name="name" placeholder="Technician Name" maxlength="60" required value="{{ old('name') }}">
            </div>
            <div class="form-group" style="flex: 1.5;">
                <input name="phone" placeholder="Phone Number (Optional)" maxlength="30" value="{{ old('phone') }}">
            </div>
            <div class="form-group" style="flex: 2;">
                <input type="email" name="email" placeholder="Email Address (Optional)" maxlength="100" value="{{ old('email') }}">
            </div>
            <button class="btn btn-primary" style="height: 44px;">➕ Add Technician</button>
        </form>
    </div>

    <!-- Technicians List Panel -->
    <div class="panel">
        <div class="panel-title">📋 Technician List</div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Active Tickets</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($technicians as $t)
                        <tr>
                            <td><b>{{ $t->name }}</b></td>
                            <td>{{ $t->phone ?? '—' }}</td>
                            <td>{{ $t->email ?? '—' }}</td>
                            <td>
                                <span style="background: rgba(59, 130, 246, 0.15); color: #3b82f6; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 13px;">
                                    {{ $t->open_count }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <form method="POST" action="{{ route('technicians.destroy', $t->id) }}" onsubmit="return confirm('{{ $t->name }}-কে মুছে ফেলবেন? তার Ticket-গুলো Unassigned হয়ে যাবে।')" style="display: inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" style="padding: 8px 16px; font-size: 13px;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">👷 এখনো কোনো Technician নেই</td>
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