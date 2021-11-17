<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
         $genres = ['break', 'rock', 'house','pop','wacck', 'jazz',
         'krump', 'new hip', 'middle hip', 'style hip'];
         
         $categories = ['トップス', 'ジャケット/アウター', 'パンツ', 'スカート', 'ワンピース/ドレス', 'シューズ', 'アクセサリー', 'ヘアアクセサリー', 'レッグウェア', '帽子'];
         
         $colors = ['白系', '黒系', '青系', '緑系', '赤系', '黄色系'];
         
         $patterns = ['チェック', '和柄', 'ボーダー', 'ストライプ', 'ゼブラ', '迷彩','無地'];
         
         
          foreach ($genres as $genre) {
              DB::table('tags')->insert([
                  [
                      'name' => 'genre',
                      'genre' => $genre,
                      ],
                  ]);
                      
            }
         
          foreach ($colors as $color) {
              DB::table('tags')->insert([
                  [
                      'name' => 'color',
                      'color' => $color,
                      ],
                  ]);
                      
            }
         
          foreach ($categories as $category) {
              DB::table('tags')->insert([
                  [
                      'name' => 'category',
                      'category' => $category,
                      ],
                  ]);
                      
            }
         
          foreach ($patterns as $pattern) {
              DB::table('tags')->insert([
                  [
                      'name' => 'pattern',
                      'pattern' => $pattern,
                      ],
                  ]);
                      
            }
            
            
    }
}
