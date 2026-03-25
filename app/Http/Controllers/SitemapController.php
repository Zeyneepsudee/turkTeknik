<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /** İzmir ilçe slug listesi */
    private array $districtSlugs = [
        'konak', 'bornova', 'buca', 'karsiyaka', 'karabaglar',
        'bayrakli', 'cigli', 'balcova', 'gaziemir', 'narlidere',
        'menemen', 'guzelbahce',
    ];

    /** Teknik rehber slug listesi */
    private array $guideSlugs = [
        'zte-modem-kurulumu',
        'tp-link-modem-kurulumu',
        'turknet-modem-kurulumu',
        'vodafone-internet-arizasi',
        'superonline-arizasi',
        'modem-arayuz-ayarlari',
        'mesh-wifi-sistemi-kurulumu',
        'turk-telekom-arizasi',
        'diseqc-ayarlari',
        'canak-anten-ayari',
        'tv-kanal-ayarlari',
        'kamera-goruntusu-gelmiyor',
        'kamera-uzaktan-izleme',
        'nvr-dvr-entegrasyonu',
    ];

    public function index(): Response
    {
        $today = now()->toDateString();

        // Ana sayfalar
        $urls = [
            ['loc' => 'https://turkteknik.com.tr/',                                   'changefreq' => 'weekly',  'priority' => '1.0', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hizmetler',                          'changefreq' => 'weekly',  'priority' => '0.9', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hizmetler/internet-hizmetleri',      'changefreq' => 'monthly', 'priority' => '0.9', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hizmetler/kamera-sistemleri',        'changefreq' => 'monthly', 'priority' => '0.9', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hizmetler/uydu-sistemleri',          'changefreq' => 'monthly', 'priority' => '0.9', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hizmetler/elektrik-servisi',         'changefreq' => 'monthly', 'priority' => '0.9', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/hakkimizda',                         'changefreq' => 'monthly', 'priority' => '0.7', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/iletisim',                           'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/service-request',                    'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/internet-hiz-testi',                 'changefreq' => 'monthly', 'priority' => '0.6', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/referanslar',                        'changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => $today],
            ['loc' => 'https://turkteknik.com.tr/rehberler',                          'changefreq' => 'weekly',  'priority' => '0.9', 'lastmod' => $today],
        ];

        // İlçe sayfaları (örn: /izmir/konak)
        foreach ($this->districtSlugs as $slug) {
            $urls[] = [
                'loc' => 'https://turkteknik.com.tr/izmir/'.$slug,
                'changefreq' => 'monthly',
                'priority' => '0.8',
                'lastmod' => $today,
            ];
        }

        // Rehber sayfaları (örn: /rehberler/zte-modem-kurulumu)
        foreach ($this->guideSlugs as $slug) {
            $urls[] = [
                'loc' => 'https://turkteknik.com.tr/rehberler/'.$slug,
                'changefreq' => 'monthly',
                'priority' => '0.8',
                'lastmod' => $today,
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
