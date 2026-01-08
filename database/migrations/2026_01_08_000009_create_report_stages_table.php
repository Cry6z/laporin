<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_stages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('label');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('report_stages')->insert([
            ['slug' => 'disposisi', 'label' => 'Disposisi', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['slug' => 'dikembalikan', 'label' => 'Dikembalikan', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['slug' => 'verifikasi', 'label' => 'Verifikasi', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['slug' => 'progres', 'label' => 'Progres', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $mapping = [
            'submitted' => 'disposisi',
            'returned' => 'dikembalikan',
            'in_progress' => 'verifikasi',
            'completed' => 'progres',
        ];

        foreach ($mapping as $from => $to) {
            DB::table('report_progresses')
                ->where('stage', $from)
                ->update(['stage' => $to]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('report_stages');
    }
};
