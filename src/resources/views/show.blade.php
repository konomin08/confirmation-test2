@extends('layouts.app')

@section('content')
<div style="padding: 40px; background-color: #f9f9f9;">
  <h2 style="font-weight: bold; margin-bottom: 20px;">【商品詳細画面】</h2>

  <a href="{{ url('/products') }}" style="color: #8d6e63; text-decoration: none;">商品一覧 ＞ {{ $product->name }}</a>

  <form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
    @csrf
    @method('POST')

    <div style="display: flex; gap: 40px;">
      <div style="flex: 1;">
        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 100%; border: 1px solid #ccc;">
        <div style="margin-top: 10px;">
          <input type="file" name="image">
          <p>{{ $product->image }}</p>
          @error('image')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div style="flex: 1;">
        <div style="margin-bottom: 10px;">
          <label>商品名</label><br>
          <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%;">
          @error('name')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        </div>

        <div style="margin-bottom: 10px;">
          <label>値段</label><br>
          <input type="text" name="price" value="{{ old('price', $product->price) }}" style="width: 100%;">
          @error('price')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        </div>

        <div style="margin-bottom: 10px;">
          <label>季節</label><br>
          @foreach (['春', '夏', '秋', '冬'] as $season)
            <label style="margin-right: 10px;">
              <input type="checkbox" name="seasons[]" value="{{ $season }}"
                {{ in_array($season, old('seasons', $product->seasons->pluck('name')->toArray())) ? 'checked' : '' }}>
              {{ $season }}
            </label>
          @endforeach
          @error('seasons')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        </div>

        <div>
          <label>商品説明</label><br>
          <textarea name="description" rows="5" style="width: 100%;">{{ old('description', $product->description) }}</textarea>
          @error('description')
            <div style="color: red;">{{ $message }}</div>
          @enderror
        </div>
      </div>
    </div>

    {{-- ボタン --}}
    <div style="margin-top: 30px; display: flex; gap: 20px;">
      <a href="{{ url('/products') }}" style="padding: 10px 30px; background-color: #ddd; color: #000; text-decoration: none; border-radius: 5px;">戻る</a>
      <button type="submit" style="padding: 10px 30px; background-color: #f9c933; color: #000; border: none; border-radius: 5px;">変更を保存</button>
    </div>
  </form>

  {{-- 削除ボタン --}}
  <form method="POST" action="{{ url('/products/' . $product->id . '/delete') }}" style="margin-top: 20px;">
    @csrf
    <button type="submit" style="padding: 10px 15px; background-color: #f44336; color: #fff; border: none; border-radius: 5px;">
      🗑 削除する
    </button>
  </form>
</div>
@endsection
