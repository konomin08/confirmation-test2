<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'kiwi.png',
                'seasons' => [3, 4], // 秋・冬
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。',
                'image' => 'strawberry.png',
                'seasons' => [1], // 春
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。',
                'image' => 'orange.png',
                'seasons' => [4], // 冬
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。暑い日の水分補給や熱中症予防にも。',
                'image' => 'watermelon.png',
                'seasons' => [2], // 夏
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。見た目の可愛さも抜群！',
                'image' => 'peach.png',
                'seasons' => [2], // 夏
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカット。',
                'image' => 'muscat.png',
                'seasons' => [2, 3], // 夏・秋
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。',
                'image' => 'pineapple.png',
                'seasons' => [1, 2], // 春・夏
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => '国産の巨峰を使用。高い糖度と適度な酸味が魅力。',
                'image' => 'grapes.png',
                'seasons' => [2, 3], // 夏・秋
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーで栄養満点、濃厚な甘みが楽しめるスムージー。',
                'image' => 'banana.png',
                'seasons' => [2], // 夏
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => 'ジューシーで品のある甘さが人気のメロンスムージー。',
                'image' => 'melon.png',
                'seasons' => [1, 2], // 春・夏
            ],
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'image' => $item['image'],
            ]);

            $product->seasons()->attach($item['seasons']);
        }
    }
}
