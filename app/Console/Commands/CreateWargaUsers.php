<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateWargaUsers extends Command
{
    protected $signature = 'warga:create-users';
    protected $description = 'Buat akun user role warga dari data warga yang belum punya akun';

    public function handle()
    {
        $wargas = Warga::whereNull('user_id')->get();

        if ($wargas->isEmpty()) {
            $this->info('Semua data warga sudah punya akun user.');
            return Command::SUCCESS;
        }

        foreach ($wargas as $warga) {
            $email = Str::slug($warga->nama) . '@rt.local';
            $email = strtolower(str_replace(' ', '', $email));

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $warga->nama,
                    'email' => $email,
                    'password' => Hash::make('warga123'),
                    'role' => 'warga',
                ]
            );

            $warga->user_id = $user->id;
            $warga->save();

            $this->info("Akun dibuat untuk {$warga->nama} -> {$email}");
        }

        return Command::SUCCESS;
    }
}
