<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Report an issue</title>
<style>
body{font-family:system-ui,sans-serif;background:#f4f6fb;margin:0;padding:20px;color:#0f172a}
.box{max-width:420px;margin:20px auto;background:#fff;border-radius:12px;padding:20px;box-shadow:0 1px 6px #0002}
label{display:block;margin-top:12px;font-size:14px}
input,select,textarea{width:100%;padding:10px;margin-top:4px;border:1px solid #cbd5e1;border-radius:8px;font:inherit;box-sizing:border-box}
button{margin-top:16px;width:100%;padding:11px;border:0;border-radius:8px;background:#2563eb;color:#fff;font:inherit;cursor:pointer}
.ok{color:#166534}.er{color:#b91c1c}
</style>
</head>
<body><div class="box">
<h2 style="margin-top:0">Report an issue</h2>
<p>Asset: <b>{{ $asset->name }}</b> ({{ $asset->code }})</p>

@if (session('ok'))<p class="ok">{{ session('ok') }}</p>@endif
@if ($errors->any())<p class="er">{{ $errors->first() }}</p>@endif

<form method="POST" action="{{ route('report.store', $asset->code) }}">
@csrf
<label>আপনার নাম (ঐচ্ছিক)<input name="reporter" maxlength="60" value="{{ old('reporter') }}"></label>
<label>সমস্যা কী?<textarea name="issue" rows="4" maxlength="300" required>{{ old('issue') }}</textarea></label>
<label>Priority
<select name="priority">
@foreach (['Low','Medium','High'] as $p)<option @selected(old('priority', 'Medium') === $p)>{{ $p }}</option>@endforeach
</select></label>
<button>Submit issue</button>
</form>
</div></body></html>