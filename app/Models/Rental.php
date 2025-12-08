<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'nama_lengkap',
        'nomor_telepon',
        'nama_instansi',
        'tanggal_ambil',
        'durasi_sewa',
        'durasi_custom',
        'tanggal_kembali',
        'dokumen_jaminan',
        'metode_pembayaran',
        'bukti_transfer',
        'surat_peminjaman',
        'catatan',
        'syarat_ketentuan',
        'cart_items',
        'subtotal',
        'additional_cost',
        'total',
        'nominal_bayar',
        'status',
    ];

    protected $casts = [
        'cart_items' => 'array',
        'tanggal_ambil' => 'date',
        'tanggal_kembali' => 'date',
        'syarat_ketentuan' => 'boolean',
        'subtotal' => 'decimal:2',
        'additional_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get formatted order number
    public function getOrderNumberAttribute()
    {
        return 'ORD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    // Get status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge badge-warning">Menunggu Konfirmasi</span>',
            'approved' => '<span class="badge badge-success">Disetujui</span>',
            'rejected' => '<span class="badge badge-danger">Ditolak</span>',
            'completed' => '<span class="badge badge-info">Selesai</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }
}
