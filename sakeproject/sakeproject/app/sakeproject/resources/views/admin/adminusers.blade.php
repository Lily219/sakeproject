<html>
<head>
  <title>ユーザー一覧</title>
</head>
<body>
  <h1>ユーザー一覧</h1>

<div class="admin-userall">
@foreach($users as $user) 
{{ $user->name }}
@endforeach
</div>


  </body>
</html>