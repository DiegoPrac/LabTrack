<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::create([
            'nama_perangkat' => 'Router MikroTik 01',
            'kategori' => 'Router',
            'lokasi' => 'Lab A3.1',
            'ip_address' => '192.168.1.1',
            'status' => 'Aktif',
            'keterangan' => 'Router utama laboratorium',
        ]);

        Device::create([
            'nama_perangkat' => 'Switch Cisco 01',
            'kategori' => 'Switch',
            'lokasi' => 'Lab A3.1',
            'ip_address' => '192.168.1.2',
            'status' => 'Aktif',
            'keterangan' => 'Switch jaringan laboratorium',
        ]);

        Device::create([
            'nama_perangkat' => 'Server Lab 01',
            'kategori' => 'Server',
            'lokasi' => 'Ruang Server',
            'ip_address' => '192.168.1.10',
            'status' => 'Maintenance',
            'keterangan' => 'Server praktikum mahasiswa',
        ]);

        Device::create([
            'nama_perangkat' => 'Access Point 01',
            'kategori' => 'Access Point',
            'lokasi' => 'Lab A3.2',
            'ip_address' => '192.168.1.20',
            'status' => 'Aktif',
            'keterangan' => 'Access point laboratorium',
        ]);
    }
}
