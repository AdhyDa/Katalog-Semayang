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

    // Accessors for view compatibility
    public function getCustomerNameAttribute()
    {
        return $this->nama_lengkap;
    }

    public function getCustomerPhoneAttribute()
    {
        return $this->nomor_telepon;
    }

    public function getCustomerInstitutionAttribute()
    {
        return $this->nama_instansi;
    }

    public function getPickupDateAttribute()
    {
        return $this->tanggal_ambil;
    }

    public function getReturnDateAttribute()
    {
        return $this->tanggal_kembali;
    }

    public function getDurationDaysAttribute()
    {
        return $this->durasi_sewa;
    }

    public function getPaymentAmountAttribute()
    {
        return $this->nominal_bayar;
    }

    public function getPaymentTypeAttribute()
    {
        return $this->metode_pembayaran;
    }

    public function getIdCardPhotoAttribute()
    {
        return $this->dokumen_jaminan;
    }

    public function getPaymentProofAttribute()
    {
        return $this->bukti_transfer;
    }

    public function getNotesAttribute()
    {
        return $this->catatan;
    }

    // Get order items as collection
    public function getOrderItemsAttribute()
    {
        $items = collect($this->cart_items ?? []);
        return $items->map(function ($item) {
            return (object) [
                'product' => (object) [
                    'name' => $item['name'] ?? 'Unknown',
                    'stock_available' => $item['stock_available'] ?? 0,
                    'image' => $item['image'] ?? null,
                ],
                'quantity' => $item['quantity'] ?? 1,
            ];
        });
    }

    // Get remaining amount
    public function getRemainingAmountAttribute()
    {
        return $this->total - $this->nominal_bayar;
    }
}
