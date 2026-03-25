<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LocationController extends Controller
{
    /**
     * Tüm slug'lar ASCII. Türkçe karakter içermez.
     */
    private array $districts = [
        'konak' => [
            'name' => 'Konak',
            'seoTitle' => 'Konak Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Konak\'ta internet arızası, güvenlik kamerası kurulumu, çanak anten montajı ve elektrik servisi. Aynı gün servis. ☎ 0546 911 80 61',
            'description' => 'Konak\'ta internet, güvenlik kamerası, çanak anten ve elektrik teknik servisi için TürkTeknik. Aynı gün servis, garantili işçilik.',
            'keywords' => 'konak teknik servis, konak uyducu, konak internet servisi, konak güvenlik kamerası, konak elektrikçi, konak çanak anten kurulumu',
        ],
        'bornova' => [
            'name' => 'Bornova',
            'seoTitle' => 'Bornova Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Bornova\'da internet arızası, güvenlik kamerası kurulumu, çanak anten montajı ve elektrik servisi. Aynı gün servis. ☎ 0546 911 80 61',
            'description' => 'Bornova\'da internet arızası, kamera sistemi, uydu montajı ve elektrik tesisat hizmetleri. Profesyonel ekip, güvenilir servis.',
            'keywords' => 'bornova teknik servis, bornova uyducu, bornova internet servisi, bornova güvenlik kamerası, bornova elektrikçi, bornova wifi arızası',
        ],
        'buca' => [
            'name' => 'Buca',
            'seoTitle' => 'Buca Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Buca\'da internet arızası, güvenlik kamerası kurulumu, çanak anten ve elektrik tesisatı hizmetleri. 7/24 destek. ☎ 0546 911 80 61',
            'description' => 'Buca\'da internet, kamera, uydu ve elektrik teknik servisi. Buca\'nın tüm mahallelerine ulaşıyoruz.',
            'keywords' => 'buca teknik servis, buca uyducu, buca internet servisi, buca güvenlik kamerası kurulumu, buca elektrikçi, buca modem kurulumu',
        ],
        'karsiyaka' => [
            'name' => 'Karşıyaka',
            'seoTitle' => 'Karşıyaka Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Karşıyaka\'da internet arızası, güvenlik kamerası, çanak anten montajı ve elektrik tesisat hizmetleri. ☎ 0546 911 80 61',
            'description' => 'Karşıyaka\'da internet, kamera, uydu ve elektrik teknik servisi. Güvenilir, hızlı ve garantili hizmet.',
            'keywords' => 'karşıyaka teknik servis, karşıyaka uyducu, karşıyaka internet servisi, karşıyaka güvenlik kamerası, karşıyaka elektrikçi',
        ],
        'karabaglar' => [
            'name' => 'Karabağlar',
            'seoTitle' => 'Karabağlar Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Karabağlar\'da internet arızası, güvenlik kamerası kurulumu, çanak anten ve elektrik servisi. Aynı gün hizmet. ☎ 0546 911 80 61',
            'description' => 'Karabağlar\'da internet, kamera, uydu ve elektrik teknik servisi. Aynı gün servis, uygun fiyat garantisi.',
            'keywords' => 'karabağlar teknik servis, karabağlar uyducu, karabağlar internet servisi, karabağlar güvenlik kamerası, karabağlar elektrikçi',
        ],
        'bayrakli' => [
            'name' => 'Bayraklı',
            'seoTitle' => 'Bayraklı Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Bayraklı\'da internet, güvenlik kamerası, çanak anten montajı ve elektrik servis hizmetleri. ☎ 0546 911 80 61',
            'description' => 'Bayraklı\'da internet arızası, kamera sistemi kurulumu, uydu ve elektrik tesisat hizmetleri.',
            'keywords' => 'bayraklı teknik servis, bayraklı uyducu, bayraklı internet servisi, bayraklı güvenlik kamerası, bayraklı elektrikçi',
        ],
        'cigli' => [
            'name' => 'Çiğli',
            'seoTitle' => 'Çiğli Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Çiğli\'de internet arızası, güvenlik kamerası kurulumu, çanak anten ve elektrik tesisat servisi. ☎ 0546 911 80 61',
            'description' => 'Çiğli\'de internet, kamera, uydu ve elektrik teknik servisi. Çiğli\'nin tüm semtlerine servis veriyoruz.',
            'keywords' => 'çiğli teknik servis, çiğli uyducu, çiğli internet servisi, çiğli güvenlik kamerası, çiğli elektrikçi, çiğli modem kurulumu',
        ],
        'balcova' => [
            'name' => 'Balçova',
            'seoTitle' => 'Balçova Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Balçova\'da internet arızası, güvenlik kamerası, çanak anten montajı ve elektrik servisi. ☎ 0546 911 80 61',
            'description' => 'Balçova\'da internet, kamera, uydu ve elektrik teknik servis hizmetleri. Sertifikalı teknisyenler.',
            'keywords' => 'balçova teknik servis, balçova uyducu, balçova internet servisi, balçova güvenlik kamerası, balçova elektrikçi',
        ],
        'gaziemir' => [
            'name' => 'Gaziemir',
            'seoTitle' => 'Gaziemir Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Gaziemir\'de internet arızası, güvenlik kamerası kurulumu, çanak anten ve elektrik tesisat servisi. ☎ 0546 911 80 61',
            'description' => 'Gaziemir\'de internet, kamera, uydu ve elektrik teknik servisi. Hızlı müdahale, garantili işçilik.',
            'keywords' => 'gaziemir teknik servis, gaziemir uyducu, gaziemir internet servisi, gaziemir güvenlik kamerası, gaziemir elektrikçi',
        ],
        'narlidere' => [
            'name' => 'Narlıdere',
            'seoTitle' => 'Narlıdere Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Narlıdere\'de internet arızası, güvenlik kamerası kurulumu, çanak anten ve elektrik servis hizmetleri. ☎ 0546 911 80 61',
            'description' => 'Narlıdere\'de internet, kamera, uydu ve elektrik teknik servisi. Uygun fiyat, kaliteli hizmet.',
            'keywords' => 'narlıdere teknik servis, narlıdere uyducu, narlıdere internet servisi, narlıdere güvenlik kamerası, narlıdere elektrikçi',
        ],
        'menemen' => [
            'name' => 'Menemen',
            'seoTitle' => 'Menemen Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Menemen\'de internet arızası, güvenlik kamerası, çanak anten montajı ve elektrik tesisat hizmetleri. ☎ 0546 911 80 61',
            'description' => 'Menemen\'de internet, kamera, uydu ve elektrik teknik servisi. Menemen\'e özel servis ekibimiz.',
            'keywords' => 'menemen teknik servis, menemen uyducu, menemen internet servisi, menemen güvenlik kamerası, menemen elektrikçi',
        ],
        'guzelbahce' => [
            'name' => 'Güzelbahçe',
            'seoTitle' => 'Güzelbahçe Teknik Servis | İnternet, Kamera, Uydu, Elektrik | TürkTeknik',
            'seoDesc' => 'Güzelbahçe\'de internet arızası, güvenlik kamerası, çanak anten ve elektrik servis hizmetleri. ☎ 0546 911 80 61',
            'description' => 'Güzelbahçe\'de internet, kamera, uydu ve elektrik teknik servisi. Sahil bölgesine özel hızlı servis.',
            'keywords' => 'güzelbahçe teknik servis, güzelbahçe uyducu, güzelbahçe internet servisi, güzelbahçe güvenlik kamerası, güzelbahçe elektrikçi',
        ],
    ];

    public function show(string $district): \Inertia\Response
    {
        // Basit küçük harf dönüşümü yeterli — tüm key'ler ASCII
        $slug = strtolower(trim($district));

        if (! array_key_exists($slug, $this->districts)) {
            abort(404);
        }

        $data = $this->districts[$slug];

        return Inertia::render('LocationService', [
            'district' => array_merge($data, ['slug' => $slug]),
            'allDistricts' => $this->getDistrictList(),
        ]);
    }

    private function getDistrictList(): array
    {
        $list = [];
        foreach ($this->districts as $slug => $d) {
            $list[] = ['slug' => $slug, 'name' => $d['name']];
        }

        return $list;
    }
}
