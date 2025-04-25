<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>mogitate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        mogitate
      </a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading contact-form__header-row">
        <h2>商品一覧</h2>
        <a href="{{ url('/products/register') }}" class="add-product-button">
            + 商品を追加
        </a>
      </div>

      <form action="{{ url('/products/search') }}" method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}" class="search-input">
        <button type="submit" class="search-button">検索</button>
      </form>


      <!-- 並び替えフォーム -->
        <form method="GET" action="{{ route('index') }}">
            <div class="sort-options">
                <label for="sort">価格順で表示</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>低い順</option>
                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </div>
        </form>

        <!-- 並び替え条件タグの表示 -->
        @if ($sort)
            <div class="sort-tag">
                <span>並び替え:
                    <strong>{{ $sort == 'desc' ? '高い順' : '低い順' }}</strong>
                    <button onclick="window.location.href='{{ route('index') }}'">×</button>
                </span>
            </div>
        @endif

        {{-- 商品一覧（カード形式） --}}
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach ($products as $product)
            <div style="width: 200px; border: 1px solid #ccc; padding: 10px; text-align: center;">
            {{-- <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: auto;"> --}}
            <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/' . $product->image) : asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: auto;">
            <h3>{{ $product->name }}</h3>
            <p>¥{{ number_format($product->price) }}</p>
            <a href="{{ url('/products/' . $product->id) }}">詳細を見る</a>
            </div>
        @endforeach
        </div>

      {{-- ページネーション --}}
      <div style="margin-top: 20px;">
        {{ $products->links() }}
      </div>
    </div>
  </main>
</body>
</html>
