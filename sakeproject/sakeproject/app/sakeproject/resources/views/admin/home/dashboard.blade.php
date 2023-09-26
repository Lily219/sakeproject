<html>
<head>
  <title>管理画面トップ</title>
</head>
<body>
  <h1>管理画面トップ</h1>

  @if (session('login_msg'))
  <p>{{ session('login_msg') }}</p>
  @endif

  @if (Auth::guard('admins')->check())
  <div>管理者ユーザーID {{ Auth::guard('admins')->user()->id }}でログイン中</div>
  @endif

  <br>
  <div class="admin-contents">
  <ul>
    <li><a href="{{ route('admin.users') }}">ユーザー一覧</a></li><br>
    <li><a href="{{ route('admin.contents') }}">投稿一覧</a></li>
  </ul>
  </div>

  <br><br>
  <div>
    <a href="/admin/logout">ログアウト</a>
  </div>
</body>
</html>