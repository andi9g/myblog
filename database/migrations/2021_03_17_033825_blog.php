<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class Blog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->unique();
            $table->string('gambar_utama')->nullable();
            $table->string('penulis')->nullable();
            $table->string('tag')->nullable();
            $table->integer('lihat')->nullable();
            $table->longText('konten');
            $table->timestamps();
        });

        Schema::create('visidanmisi', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->longText('visi');
            $table->longText('misi');
            $table->timestamps();
        });

        // new 
        Schema::create('gambarslide', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('judul');
            $table->string('pesan');
            $table->timestamps();
        });

        Schema::create('dokumentasi', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('judul');
            $table->timestamps();
        });

        // new 
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->integer('nim')->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->string('hp');
            $table->string('email')->nullable();
            $table->enum('posisi', ['anggota', 'admin','bendahara']);
            $table->string('password');
            $table->enum('ket', ['penulis', 'none']);
            $table->string('jabatan');
            $table->string('gambar');

            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->enum('jeniskelamin',['perempuan','pria']);
            $table->string('programstudi');
            $table->integer('semester');
            $table->longText('motohidup');
            $table->string('asalsekolah');
            $table->string('selfie');

            $table->timestamps();
        });

        Schema::create('programstudi', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan')->unique();
            $table->timestamps();
        });

        Schema::create('calonanggota', function (Blueprint $table) {
            $table->id();
            $table->integer('nim')->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->string('hp');
            $table->string('email');
            $table->longText('pesan');
            $table->string('perangkat');
            
            $table->string('tempatlahir');
            $table->date('tanggallahir');
            $table->enum('jeniskelamin',['perempuan','pria']);
            $table->string('programstudi');
            $table->integer('semester');
            $table->longText('motohidup');
            $table->string('asalsekolah');
            $table->string('pasfoto');
            $table->string('selfie');

            $table->timestamps();
        });

        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('pendaftaran');
            $table->timestamps();
        });

        Schema::create('jadwalrapat', function (Blueprint $table) {
            $table->id();
            $table->enum('rapat', ['rapat umum', 'rapat khusus']);
            $table->string('ket');
            $table->string('jam');
            $table->integer('tgl');
            $table->string('tempat');
            $table->integer('nim');
            $table->timestamps();
        });

        Schema::create('linimasa', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->date('tgl_mulai');
            $table->string('tgl_akhir')->nullable();
            $table->string('id_anggota')->nullable();
            $table->timestamps();
        });

        Schema::create('logo', function (Blueprint $table) {
            $table->id();
            $table->string('logo1');
            $table->string('logo2')->nullable();
            $table->string('logo3')->nullable();
            $table->timestamps();
        });


        Schema::create('sosialmedia', function (Blueprint $table) {
            $table->id();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('pinterest')->nullable();
            $table->timestamps();
        });


        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('hp')->nullable();
            $table->string('wa')->nullable();
            $table->timestamps();
        });


        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('wa')->nullable();
            $table->string('email');
            $table->longText('pesan');
            $table->string('perangkat');
            $table->timestamps();
        });

        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tgl_mulai');
            $table->string('tgl_selesai');
            $table->integer('total');
            $table->enum('ket', ['selesai','none']);
            $table->timestamps();
        });

        Schema::create('bank', function (Blueprint $table) {
            $table->id();
            $table->string('bank');
            $table->string('rekening');
            $table->string('nama');
            $table->integer('id_donasi');
            $table->timestamps();
        });

        Schema::create('web', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('footer')->nullable();
            $table->string('map')->nullable();
            $table->string('api_key')->nullable();
            $table->timestamps();
        });





        DB::unprepared('
        CREATE TRIGGER deleteCalon AFTER INSERT ON anggota FOR EACH ROW
            BEGIN
                DELETE FROM calonanggota WHERE nim=NEW.nim;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER deleteAnggota AFTER DELETE ON anggota FOR EACH ROW
            BEGIN
                INSERT INTO calonanggota 
                (nim,nama,alamat,hp,email,pesan,perangkat,
                tempatlahir,tanggallahir,jeniskelamin,
                programstudi,semester,motohidup,asalsekolah,
                selfie,pasfoto) 
                VALUES 
                (old.nim,old.nama,old.alamat,old.hp,old.email,"(system) : Telah dikeluarkan dari anggota..","none",
                old.tempatlahir,old.tanggallahir,old.jeniskelamin,
                old.programstudi,old.semester,old.motohidup,old.asalsekolah,
                old.selfie,old.gambar);
            END
        ');

        $password = Hash::make('admin'.date('Y'));
        $tgl = date('Y-m-d');

        DB::unprepared('
            INSERT INTO anggota (nim,nama,alamat,hp,email,posisi,password,ket,jabatan,gambar,tempatlahir,tanggallahir,jeniskelamin,programstudi,semester,motohidup,asalsekolah,selfie) 
            VALUES ("4321","admin","none","none","none","admin","'.$password.'","penulis","none","profile.png","none","'.$tgl.'","pria","none","0","none","none","none");
        ');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        
        Schema::dropIfExists('postingan');
        Schema::dropIfExists('gambarslide');
        Schema::dropIfExists('anggota');
        Schema::dropIfExists('visidanmisi');
        Schema::dropIfExists('dokumentasi');
        Schema::dropIfExists('linimasa');
        Schema::dropIfExists('calonanggota');
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('jadwalrapat');
        Schema::dropIfExists('sosialmedia');
        Schema::dropIfExists('logo');
        Schema::dropIfExists('kontak');
        Schema::dropIfExists('pesan');
        Schema::dropIfExists('programstudi');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('bank');
        Schema::dropIfExists('web');

        DB::unprepared('DROP TRIGGER deleteCalon');
        DB::unprepared('DROP TRIGGER deleteAnggota');


        // Schema::dropIfExists('kategori');
        // Schema::dropIfExists('admin');
        // Schema::dropIfExists('advanced');
        // Schema::dropIfExists('pengunjung');
        
    }
}
