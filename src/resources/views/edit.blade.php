@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>商品編集</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/products">mogitate</a>
    </div>
  </header>

@section('content')
<div class="container">
    <h2>商品編集</h2>

    <form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
        </div>

        {{-- 値段 --}}
        <div class="mb-3">
            <label for="price">値段</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
        </div>

        {{-- 季節 --}}
        <div class="mb-3">
            <label>季節</label><br>
            @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
            @endforeach
        </div>

        {{-- 商品説明 --}}
        <div class="mb-3">
            <label for="description">商品説明</label><br>
            <textarea name="description" id="description" rows="5">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- 画像 --}}
        <div class="mb-3">
            <label for="image">商品画像</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" width="150"><br>
            @endif
            <input type="file" name="image" id="image">
        </div>

        {{-- ボタン類 --}}
        <div class="flex items-center justify-between mt-4">
            <a href="{{ url('/products') }}" class="btn btn-secondary">戻る</a>

            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-primary">変更を保存</button>

                {{-- 削除ボタン --}}
                <form action="{{ url('/products/' . $product->id . '/delete') }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                    @csrf
                    @method('POST')
                    <button type="submit" style="background: none; border: none;">
                        <img src="{{ asset('images/icons/trash-icon.png') }}" alt="削除" width="24">
                    </button>
                </form>
            </div>
        </div>
    </form>
</div>
@endsection
</body>
</html>
