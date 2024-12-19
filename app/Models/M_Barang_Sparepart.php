<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang_Sparepart extends Model
{
    protected $table      = 'barang_sparepart';
    protected $primaryKey = 'id_part';
    
    protected $allowedFields = [
        'kode_part', 
        'nama_part', 
        'kode_group', 
        'kode_kategori', 
        'satuan', 
        'isi', 
        'stok', 
        'harga_beliawal', 
        'harga_belibaru', 
        'harga_jualawal',
        'harga_jualbaru', 
        'nama_kategori', 
        'user_id',
        'tanggal'
    ];

}
