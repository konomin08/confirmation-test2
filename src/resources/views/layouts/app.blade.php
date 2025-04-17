<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'デフォルトタイトル')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <!-- ナビゲーションメニュー -->
        </nav>
    </header>

    <main>
        @yield('content')  <!-- 各ページのコンテンツを表示 -->
    </main>

    <footer>
        <!-- フッター -->
    </footer>
</body>
</html>
