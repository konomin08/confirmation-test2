<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>商品登録</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
      <div class="contact-form__heading">
        <h2>商品登録</h2>
      </div>

      {{-- 商品登録フォーム --}}
      <form action="{{ url('/products/store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="form__group">
        <label class="form__label" for="name">商品名</label>
        <span class="required-badge">必須</span>
        <input class="form__input" type="text" name="name" id="name" placeholder="商品名を入力" value="{{ old('name') }}">
        </div>
        @if ($errors->has('name'))
          <p class="form__error">{{ $errors->first('name') }}</p>
        @endif

        {{-- 値段 --}}
        <div class="form__group">
        <label class="form__label" for="price">値段</label>
        <input class="form__input" type="number" name="price" id="price" placeholder="値段を入力" value="{{ old('price') }}">
        </div>
        @if ($errors->has('price'))
          <p class="form__error">{{ $errors->first('price') }}</p>
        @endif

        {{-- 商品画像 --}}
        <div class="form__group">
        <label class="form__label" for="image">商品画像</label>
        <input type="file" name="image" id="image">
        </div>
        @if ($errors->has('image'))
          <p class="form__error">{{ $errors->first('image') }}</p>
        @endif

        {{-- 季節 --}}
        <div class="form__group">
        <label class="form__label">季節</label>
            <div class="season__group">
                @foreach($seasons as $season)
                <label><input type="checkbox" name="seasons[]" value="{{ $season->id }}"> {{ $season->name }}</label>
                @endforeach
            </div>
        </div>
        @if ($errors->has('seasons'))
          <p class="form__error">{{ $errors->first('seasons') }}</p>
        @endif

        {{-- 商品説明 --}}
        <div class="form__group">
        <label class="form__label" for="description">商品説明</label>
        <textarea class="form__textarea" name="description" id="description" rows="5" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        </div>
        @if ($errors->has('description'))
          <p class="form__error">{{ $errors->first('description') }}</p>
        @endif

        {{-- 送信ボタン --}}
        <div class="form__button">
        <button type="submit" class="form__button-submit">登録</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
