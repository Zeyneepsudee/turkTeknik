<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
        <!-- End Google Tag Manager -->

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-18017766633"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'AW-18017766633');
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Geo Meta Tags - Yerel SEO için --}}
        <meta name="geo.region" content="TR-35">
        <meta name="geo.placename" content="İzmir">
        <meta name="geo.position" content="38.4237;27.1428">
        <meta name="ICBM" content="38.4237, 27.1428">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@700;800;900&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
            }

            html.dark {
                background-color: oklch(0.145 0 0);
            }
        </style>

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @routes
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
        @inertiaHead

        {{-- LocalBusiness JSON-LD - Tüm sayfalarda geçerli --}}
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "ProfessionalService",
          "@id": "https://turkteknik.com.tr/#business",
          "name": "TürkTeknik Teknik Servis",
          "alternateName": "TürkTeknik",
          "url": "https://turkteknik.com.tr",
          "logo": "https://turkteknik.com.tr/images/logo.png",
          "image": "https://turkteknik.com.tr/images/og-image.jpg",
          "description": "İzmir'de internet, güvenlik kamerası, uydu sistemleri ve elektrik tesisatı alanlarında profesyonel teknik servis hizmetleri.",
          "telephone": "+905469118061",
          "priceRange": "₺₺",
          "currenciesAccepted": "TRY",
          "paymentAccepted": "Nakit, Kredi Kartı",
          "foundingDate": "2016",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "İzmir",
            "addressRegion": "İzmir",
            "addressCountry": "TR"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 38.4237,
            "longitude": 27.1428
          },
          "areaServed": [
            {
              "@type": "City",
              "name": "İzmir"
            },
            {
              "@type": "AdministrativeArea",
              "name": "İzmir İli"
            }
          ],
          "serviceArea": {
            "@type": "GeoCircle",
            "geoMidpoint": {
              "@type": "GeoCoordinates",
              "latitude": 38.4237,
              "longitude": 27.1428
            },
            "geoRadius": "50000"
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
              "opens": "08:00",
              "closes": "22:00"
            }
          ],
          "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Teknik Servis Hizmetleri",
            "itemListElement": [
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "İnternet Teknik Servis",
                  "description": "Fiber/VDSL arıza tespiti, modem kurulumu, Mesh Wi-Fi ve Access Point çözümleri",
                  "url": "https://turkteknik.com.tr/hizmetler/internet-hizmetleri"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Güvenlik Kamera Sistemleri",
                  "description": "IP/AHD güvenlik kamera kurulumu, DVR/NVR çözümleri ve uzaktan izleme",
                  "url": "https://turkteknik.com.tr/hizmetler/kamera-sistemleri"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Uydu & Çanak Anten Sistemleri",
                  "description": "Çanak anten montajı, merkezi uydu sistemi (SMATV) ve sinyal güçlendirme",
                  "url": "https://turkteknik.com.tr/hizmetler/uydu-sistemleri"
                }
              },
              {
                "@type": "Offer",
                "itemOffered": {
                  "@type": "Service",
                  "name": "Elektrik Teknik Servis",
                  "description": "Sigorta panosu, kaçak akım rölesi, LED aydınlatma ve tesisat yenileme",
                  "url": "https://turkteknik.com.tr/hizmetler/elektrik-servisi"
                }
              }
            ]
          },
          "sameAs": [
            "https://wa.me/905469118061"
          ],
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+905469118061",
            "contactType": "customer service",
            "availableLanguage": "Turkish",
            "contactOption": "TollFree",
            "areaServed": "TR"
          }
        }
        </script>

        {{-- WebSite JSON-LD --}}
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "@id": "https://turkteknik.com.tr/#website",
          "url": "https://turkteknik.com.tr",
          "name": "TürkTeknik Teknik Servis",
          "description": "İzmir teknik servis - internet, kamera, uydu ve elektrik hizmetleri",
          "inLanguage": "tr-TR",
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "https://turkteknik.com.tr/hizmetler?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          }
        }
        </script>

        {{-- İnternet Hız Testi Sayfası İçin JSON-LD --}}
        @if(request()->routeIs('internet-speed-test'))
            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "WebPage",
                  "name": "Ücretsiz İnternet Hız Testi | TürkTeknik İzmir",
                  "url": "https://turkteknik.com.tr/internet-hiz-testi",
                  "description": "Ücretsiz internet hız testi yapın. TürkTeknik İzmir ile anında bağlantı hızınızı öğrenin.",
                  "publisher": {
                    "@type": "Organization",
                    "name": "TürkTeknik"
                  }
                }
            </script>
        @endif

    </head>
    <body class="font-sans antialiased bg-white">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXXX"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @inertia
    </body>
</html>
