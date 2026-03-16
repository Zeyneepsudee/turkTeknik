<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_type',
        'service_option',
        'name',
        'email',
        'phone',
        'address',
        'district',
        'description',
        'status',
        'admin_notes',
        'whatsapp_message_id',
        'request_number',
        'other_product_name',
        'other_service_option',
    ];

    protected $appends = [
        'status_text',
        'service_type_text',
        'service_option_text',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($serviceRequest) {
            // Talep numarası oluştur (YIL-AY-SIRA)
            $year = date('Y');
            $month = date('m');
            $lastRequest = self::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('id', 'desc')
                ->first();

            $sequence = $lastRequest ? (int) substr($lastRequest->request_number, -4) + 1 : 1;
            $serviceRequest->request_number = sprintf('%s%s%04d', $year, $month, $sequence);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ServiceComment::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'pending' => 'Beklemede',
            'in_progress' => 'İşleme Alındı',
            'completed' => 'Tamamlandı',
            'cancelled' => 'İptal Edildi',
            default => 'Bilinmiyor'
        };
    }

    public function getServiceTypeTextAttribute()
    {
        return match ($this->service_type) {
            'camera' => 'Kamera Sistemleri',
            'internet' => 'İnternet Hizmetleri',
            'satellite' => 'Uydu Sistemleri',
            'elektrik' => 'Elektrik Servisi',
            default => $this->service_type
        };
    }

    public function getServiceOptionTextAttribute()
    {
        if ($this->service_option === 'other') {
            return $this->other_service_option ?? 'Diğer';
        }

        $options = [
            'camera' => [
                'kamera_kurulum' => 'Güvenlik Kamerası Kurulumu',
                'kayit_cihazi' => 'Kayıt Cihazı Bakım & Onarım',
                'altyapi_yenileme' => 'Kamera Altyapı Yenileme',
                'sistem_bakim' => 'Sistem Bakım & Temizlik',
            ],
            'internet' => [
                'internet_ariza' => 'İnternet Arıza & Onarım',
                'data_kablolama' => 'Daire İçi Data Kablolama',
                'wifi_guclendirme' => 'Wi-Fi Sinyal Güçlendirme',
                'modem_kurulum' => 'Modem Kurulum & Konfigürasyon',
            ],
            'satellite' => [
                'merkezi_uydu' => 'Merkezi Uydu Kurulumu',
                'canak_montaj' => 'Çanak Anten Montaj & Ayar',
                'sinyal_ariza' => 'Sinyal & Kablo Arızaları',
                'tv_montaj' => 'TV Ünitesi & Panel Montajı',
            ],
            'elektrik' => [
                'elek_ariza' => 'Genel Elektrik Arızaları',
                'aydinlatma' => 'Aydınlatma Sistemleri (LED/Spot/Avize)',
                'pano_onarim' => 'Sigorta & Pano Onarımı',
                'cihaz_montaj' => 'Elektrikli Cihaz Montajı',
            ],
        ];

        return $options[$this->service_type][$this->service_option] ?? $this->service_option;
    }
}
