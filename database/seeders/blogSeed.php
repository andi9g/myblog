<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use Hash;

class blogSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::Create('id_ID');

        $gambar = ['gambar1.jpg','gambar2.jpg','gambar3.jpg','gambar4.png','none.jpg'];
        
        $post = "<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia vero voluptate totam? Officiis, illum quidem! Eius, facilis velit. Doloremque possimus itaque architecto dolore enim cupiditate quod saepe sunt aperiam tempora?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti hic molestiae dignissimos? Fugit dolores ipsum aut nobis molestiae, inventore repudiandae natus doloribus illum accusamus! Harum debitis necessitatibus aliquam totam suscipit.</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia vero voluptate totam? Officiis, illum quidem! Eius, facilis velit. Doloremque possimus itaque architecto dolore enim cupiditate quod saepe sunt aperiam tempora?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti hic molestiae dignissimos? Fugit dolores ipsum aut nobis molestiae, inventore repudiandae natus doloribus illum accusamus! Harum debitis necessitatibus aliquam totam suscipit.</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia vero voluptate totam? Officiis, illum quidem! Eius, facilis velit. Doloremque possimus itaque architecto dolore enim cupiditate quod saepe sunt aperiam tempora?Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deleniti hic molestiae dignissimos? Fugit dolores ipsum aut nobis molestiae, inventore repudiandae natus doloribus illum accusamus! Harum debitis necessitatibus aliquam totam suscipit.</p>";


        for ($i=0; $i < 100; $i++) { 
            DB::table('postingan')->insert([
                'judul' => 'Judul dengan nama '.$faker->name,
                'kategori' => rand(1,2),
                'gambar_utama' => $gambar[rand(0,4)],
                'dibaca' => '0',
                'penulis' => '1',
                'tag' => 'ada,bayu',
                'konten' => $post,
            ]);
        }
        $kategori = ['program','java'];
        for ($i=0; $i < 2; $i++) { 
            DB::table('kategori')->insert([
                'kategori' => $kategori[$i]
            ]);
        }

        $password = Hash::make('andi420415');
        DB::table('admin')->insert([
            'nama_admin' => 'andi bayu',
            'username'  => 'admin',
            'password' => $password,
            'posisi' => 'super admin',
            'email' => 'andibayu@gmail.com',
            'hp' => '081268293603',
            'gambar' => 'admin_default.png',
        ]);
        
    }
}
