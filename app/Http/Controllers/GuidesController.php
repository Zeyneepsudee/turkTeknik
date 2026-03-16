<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class GuidesController extends Controller
{
    /**
     * Tüm rehber içerikleri - SEO metadata, bölümler ve SSS.
     */
    private function allGuides(): array
    {
        return [
            // ─── İNTERNET / MODEM ────────────────────────────────────────
            'zte-modem-kurulumu' => [
                'slug'       => 'zte-modem-kurulumu',
                'category'   => 'internet',
                'title'      => 'ZTE Modem Kurulumu',
                'seoTitle'   => 'ZTE Modem Kurulumu İzmir | Adım Adım Ayarlar | TürkTeknik',
                'seoDesc'    => 'İzmir\'de ZTE modem kurulumu ve ayarları için rehber. PPPoE, Wi-Fi şifre değişimi, kanal ayarı ve servis başlatma adımları. Sorun yaşıyorsanız 0546 911 80 61.',
                'keywords'   => 'zte modem kurulumu izmir, zte f660 kurulum, zte zxhn h298a ayar, zte modem arayüz, zte modem şifre değiştirme izmir',
                'icon'       => 'fas fa-network-wired',
                'color'      => 'blue',
                'intro'      => 'ZTE modemleri; Türknet, Türk Telekom ve SuperOnline tarafından yaygın olarak kullanılan güvenilir cihazlardır. Ancak fabrika çıkışlı ayarlar her zaman optimal performansı vermez. Bu rehberde ZTE modeminizi İzmir\'de doğru biçimde nasıl kuracağınızı ve optimize edeceğinizi anlatıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. Modeme Erişim — Arayüzü Açın',
                        'content' => 'Tarayıcınıza 192.168.1.1 veya 192.168.100.1 yazın. Kullanıcı adı ve şifre genellikle kutunun altında yazar (varsayılan: admin / admin veya user / user). Giriş yaptıktan sonra "WAN Ayarları" bölümüne geçin.',
                        'tips'    => ['Arayüz açılmıyorsa modemi 10 sn basılı tutarak fabrika ayarlarına sıfırlayın.', 'HTTPS kullanıyorsanız 192.168.1.1 yerine http:// ile deneyin.'],
                    ],
                    [
                        'heading' => '2. PPPoE / İnternet Bağlantısı Ayarı',
                        'content' => 'WAN ayarlarında "PPPoE" bağlantı tipini seçin. Servis sağlayıcınızın verdiği kullanıcı adı ve şifreyi girin. Türknet için bu bilgiler aktivasyon SMS\'inde gelir; Türk Telekom için fatura adresindeki müşteri kodudur.',
                        'tips'    => ['VPI/VCI değerleri: Türk Telekom 8/35, SuperOnline 0/35, Türknet 0/35.', 'Bağlantı sağlanamıyorsa ISP\'nizi arayarak hat durumunu teyit edin.'],
                    ],
                    [
                        'heading' => '3. Wi-Fi Ağ Adı ve Şifre Değiştirme',
                        'content' => '"Kablosuz" veya "WLAN" sekmesine gidin. 2.4 GHz ve 5 GHz ağ adlarını (SSID) dilediğiniz gibi değiştirin. WPA2-AES şifreleme seçerek güçlü bir şifre belirleyin (en az 12 karakter, harf+rakam+sembol).',
                        'tips'    => ['5 GHz daha hızlı ama kısa menzillidir; 2.4 GHz daha geniş kapsamalıdır.', 'Komşu ağlarla kanal çakışması varsa "Kanal" değerini manuel 1, 6 veya 11 olarak ayarlayın.'],
                    ],
                    [
                        'heading' => '4. Optimizasyon ve Güvenlik',
                        'content' => 'DNS sunucusunu 1.1.1.1 (Cloudflare) veya 8.8.8.8 (Google) olarak ayarlayın. Remote Management ve UPnP özelliklerini kapatın. Firmware\'i güncel tutun; ZTE\'nin resmi sitesinden model numaranıza uygun versiyonu indirin.',
                        'tips'    => ['QoS aktifleştirerek video arama veya oyun cihazlarına öncelik verebilirsiniz.', 'Aylık bir kez modemi yeniden başlatmak performansı artırır.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'ZTE modem arayüzüne giremiyorum, ne yapmalıyım?', 'a' => 'Modem sıfırlandıktan sonra 192.168.1.1 adresini deneyin. Antivirüs veya güvenlik duvarı arayüzü bloke ediyor olabilir; tarayıcının gizli penceresinde deneyin.'],
                    ['q' => 'ZTE modem internet ışığı yanmıyor, neden?', 'a' => 'Hat arızası ya da PPPoE bilgilerinin yanlış girilmiş olması en yaygın nedendir. ISP hattının kesilip açılması ve PPPoE kullanıcı adı/şifresinin tekrar girilmesi çözüm sağlar.'],
                    ['q' => 'ZTE modem kurulumunu yapamıyorum, yardım alabilir miyim?', 'a' => 'Evet! İzmir\'de ZTE modem kurulumu ve ayarı için TürkTeknik ekibini 0546 911 80 61 numarasından arayın. Aynı gün yerinde destek sağlıyoruz.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'tp-link-modem-kurulumu' => [
                'slug'       => 'tp-link-modem-kurulumu',
                'category'   => 'internet',
                'title'      => 'TP-Link Modem Kurulumu',
                'seoTitle'   => 'TP-Link Modem Kurulumu İzmir | Archer & Deco Ayarları | TürkTeknik',
                'seoDesc'    => 'İzmir\'de TP-Link Archer ve Deco modem kurulumu. PPPoE ayarı, Wi-Fi optimizasyonu, ebeveyn denetimi ve Mesh kurulumu adım adım anlatım. Destek: 0546 911 80 61.',
                'keywords'   => 'tp-link modem kurulumu izmir, tp-link archer kurulum, tp-link deco kurulumu, tplink modem ayarı, tp-link wi-fi şifre değiştirme izmir',
                'icon'       => 'fas fa-network-wired',
                'color'      => 'blue',
                'intro'      => 'TP-Link\'in Archer ve Deco serisi; hız, güvenilirlik ve kolay yönetim için birinci tercih haline gelmiştir. İzmir\'deki fibere bağlı evlerde en sık karşılaştığımız modem ailesi olan TP-Link\'in doğru kurulum ve ayar adımlarını bu rehberde bulabilirsiniz.',
                'sections'   => [
                    [
                        'heading' => '1. Archer Serisi — Web Arayüzü Kurulumu',
                        'content' => 'Tarayıcıya tplinkwifi.net veya 192.168.0.1 yazın. İlk girişte şifre oluşturmanız istenir. Kurulum sihirbazını takip ederek bağlantı tipini (PPPoE/Dinamik IP) seçin. Fiber hat için genellikle PPPoE kullanılır.',
                        'tips'    => ['Türk Telekom GPON hatlarında bağlantı tipi "Dinamik IP" olabilir; ISP\'nizi teyit edin.', 'Sihirbaz yerine "Gelişmiş Kurulum" tercih ederek her parametreyi kendiniz girebilirsiniz.'],
                    ],
                    [
                        'heading' => '2. TP-Link Deco Mesh Kurulumu',
                        'content' => 'Deco uygulamasını (iOS/Android) indirin. Ana Deco ünitesini modeminize veya doğrudan fiber ONT\'ye bağlayın. Uygulama üzerinden ağ adı ve şifre belirleyip diğer Deco ünitelerini aynı ağa ekleyin. Birimler arası bağlantı otomatik kurulur.',
                        'tips'    => ['Deco ünitelerini aralarında 1-2 oda mesafe olacak şekilde yerleştirin.', 'Kablolu backhaul için Deco\'nun LAN portlarını birbirine ethernet ile bağlayabilirsiniz; en iyi performansı bu verir.'],
                    ],
                    [
                        'heading' => '3. Wi-Fi Kanal ve Band Optimizasyonu',
                        'content' => '"Gelişmiş" → "Kablosuz" menüsünde 2.4 ve 5 GHz bantlarını ayrı ayrı yönetin. 5 GHz bandını 80 MHz kanal genişliğine, 2.4 GHz\'i ise 20 MHz\'e (doluluk durumuna göre) ayarlayın. Band Steering aktifken cihazlar otomatik uygun banda geçer.',
                        'tips'    => ['Komşu ağlarla çakışan kanal varsa manuel kanal seçimi hızı artırır.', '5 GHz için DFS kanalları (50-144) daha az kalabalık ama bazı eski cihazlarla uyumsuz olabilir.'],
                    ],
                    [
                        'heading' => '4. Güvenlik ve QoS Ayarları',
                        'content' => 'TP-Link HomeShield veya yerleşik güvenlik duvarı etkinleştirin. QoS menüsünden belirli cihazlara öncelikli bant genişliği ayırın (streaming, oyun). Ebeveyn denetimiyle belirli siteleri veya internet erişim saatlerini kısıtlayabilirsiniz.',
                        'tips'    => ['VPN sunucusu aktifleştirirseniz evden uzaktan güvenli erişim sağlarsınız.', 'TP-Link ID hesabı oluşturarak modeминizи akıllı telefondan yönetebilirsiniz.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'TP-Link modemin Wi-Fi\'si 5 GHz görünmüyor, neden?', 'a' => 'Cihazınızın 5 GHz desteği olmayabilir veya modem arayüzünde 5 GHz bandı devre dışı bırakılmış olabilir. Archer arayüzünde "Gelişmiş → Kablosuz → 5 GHz Kablosuz Ayarları" bölümünden etkinleştirin.'],
                    ['q' => 'TP-Link Deco ünitelerim birbirini bulamıyor, ne yapmalıyım?', 'a' => 'Deco uygulamasından "Deco Ekle" ile yeniden eşleştirme deneyin. Birimler arasındaki mesafe çok fazlaysa veya beton duvar varsa sinyal engellenebilir; birini daha yakın konumlandırın.'],
                    ['q' => 'İzmir\'de TP-Link modem veya Deco kurulumu için yardım alabilir miyim?', 'a' => 'Evet, TürkTeknik olarak İzmir\'in tüm ilçelerinde TP-Link kurulumu ve konfigürasyon desteği veriyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'turknet-modem-kurulumu' => [
                'slug'       => 'turknet-modem-kurulumu',
                'category'   => 'internet',
                'title'      => 'Türknet Modem Kurulumu',
                'seoTitle'   => 'Türknet Modem Kurulumu ve Bağlantı Ayarı İzmir | TürkTeknik',
                'seoDesc'    => 'Türknet fiber hattınızı aktive ettikten sonra modem kurulumu nasıl yapılır? İzmir\'de Türknet PPPoE ayarı, ONT bağlantısı ve Wi-Fi optimizasyonu. 0546 911 80 61.',
                'keywords'   => 'türknet modem kurulumu izmir, türknet fiber kurulum, türknet pppoe ayarı, türknet bağlantı sorunu, türknet internet gelmiyor izmir',
                'icon'       => 'fas fa-globe',
                'color'      => 'blue',
                'intro'      => 'Türknet, İzmir\'de giderek yaygınlaşan bir fiber internet servis sağlayıcısıdır. Fiber aktivasyonu sonrası gelen ONT cihazının yanında kendi modeminizi kullanmak istiyorsanız veya verilen standart modemin performansını artırmak istiyorsanız bu rehber tam size göredir.',
                'sections'   => [
                    [
                        'heading' => '1. Türknet Fiber ONT Bağlantısı',
                        'content' => 'Türknet fiber hattında eve bir ONT (Optik Ağ Terminali) kurulur. Modeminizi ONT\'nin LAN1 portuna ethernet kablosuyla bağlayın. ONT\'nin WAN ışığı yeşil yanarsa fiber hattınız aktif demektir.',
                        'tips'    => ['ONT sıfırlamak için fabrika ayarlarına dönme butonuna 10 sn basın.', 'Bazı Türknet kurulumlarında ONT doğrudan köprü (bridge) modda çalışır; bu durumda PPPoE bilgilerini kendi modeminize girmeniz gerekir.'],
                    ],
                    [
                        'heading' => '2. PPPoE Kullanıcı Adı ve Şifre Girişi',
                        'content' => 'Türknet aktivasyon SMS\'indeki kullanıcı adı (genellikle @türknet.net.tr uzantılı) ve şifrenizi modeminizin WAN ayarlarına girin. Bağlantı tipi "PPPoE" olmalıdır. Kaydetip bağlantıyı yeniden başlatın.',
                        'tips'    => ['Şifrenizi unuttuysanız Türknet müşteri hizmetleri (444 87 65) üzerinden sıfırlatabilirsiniz.', 'ONT bridge modda değilse PPPoE doğrudan ONT\'de tamamlanır; modeminiz bu durumda DHCP ile IP alır.'],
                    ],
                    [
                        'heading' => '3. Bağlantı Sorunu Teşhisi',
                        'content' => 'İnternet gelmiyorsa şu sırayla kontrol edin: (1) Fiber kablosu sağlam mı? (2) ONT\'de WAN/Internet ışığı yanıyor mu? (3) PPPoE bilgileri doğru mu? (4) Türknet servis bölgenizdeki arıza var mı? Türknet\'in arıza sayfasını veya 444 87 65\'i arayın.',
                        'tips'    => ['Modem bağlantı geçmişini kontrol edin; tekrarlayan kopma/bağlanma döngüsü PPPoE kimlik doğrulama hatasına işaret eder.', 'Hattı başka bir cihaz veya basit router ile test edin.'],
                    ],
                    [
                        'heading' => '4. Hız Optimizasyonu',
                        'content' => 'Türknet fiber paketinizin tam hızını almak için modeminizin gigabit LAN portuna bağlı olduğunuzdan emin olun. Wi-Fi üzerinden gerçek fiber hızını almak için 5 GHz bandı ve 80 MHz kanal genişliği kullanın. Kablo ile bağlantıda paket hızının %90-95\'ini almanız normaldir.',
                        'tips'    => ['Wi-Fi şifrelemesini WPA2 veya WPA3 seçin; WEP hız düşürür.', 'Çok cihaz aynı anda bağlıysa QoS ile önceliklendirme yapın.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Türknet internet kurulumu ne kadar sürer?', 'a' => 'Türknet fiber aktivasyonu genellikle talep gününden itibaren 3-7 iş günü sürer. Altyapı müsaitliğine göre değişebilir. Kurulum teknisyeni ONT montajını tamamlar; modem ayarı size kalır.'],
                    ['q' => 'Türknet bağlantısı sürekli kesiliyor, ne yapmalıyım?', 'a' => 'Önce fiber kablo hasar görüp görmediğini kontrol edin. PPPoE oturumu tekrar tekrar düşüyorsa ISP tarafından kaynaklanan bir hattır; Türknet destek hattını (444 87 65) arayın.'],
                    ['q' => 'Türknet modem kurulumunda yardım alabileceğim bir teknik servis var mı İzmir\'de?', 'a' => 'TürkTeknik olarak İzmir\'de Türknet dahil tüm ISP\'lerin modem kurulumu ve konfigürasyonunu yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'vodafone-internet-arizasi' => [
                'slug'       => 'vodafone-internet-arizasi',
                'category'   => 'internet',
                'title'      => 'Vodafone İnternet Arızası',
                'seoTitle'   => 'Vodafone İnternet Çekmiyor / Bağlanamıyor İzmir | TürkTeknik',
                'seoDesc'    => 'İzmir\'de Vodafone internet çekmiyor veya bağlanamıyor mu? Hat arızası, modem sorunu, sinyal zayıflığı tanı ve çözüm rehberi. Teknik destek: 0546 911 80 61.',
                'keywords'   => 'vodafone internet çekmiyor izmir, vodafone arıza izmir, vodafone bağlanamıyor, vodafone internet kesildi, vodafone hız sorunu izmir',
                'icon'       => 'fas fa-exclamation-triangle',
                'color'      => 'red',
                'intro'      => 'Vodafone ADSL, VDSL ya da fiber hattınızda sorun yaşıyorsanız, arızanın kaynağını doğru tespit etmek çözümü hızlandırır. Bu rehberde İzmir\'de Vodafone internet arızalarında izlenecek adımları ve olası çözüm yollarını anlatıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. Genel Kontroller — Arıza mı, Cihaz mı?',
                        'content' => 'Vodafone\'un güncel arıza bildirimi için "Vodafone Destek" uygulamasını veya 542\'yi arayın. Bölgesel arıza yoksa modeminizi prize takıp 30 sn bekleyin (soğuk yeniden başlatma). Bilgisayarınızı ya da telefonu kablo ile doğrudan modeme bağlayıp test edin; sorun devam ederse modem veya hat kaynaklıdır.',
                        'tips'    => ['Vodafone mobil hattınız varsa aynı ortamda 4G/5G interneti test edin; bölgesel kesinti yoksa problem evinizdeki altyapıdadır.'],
                    ],
                    [
                        'heading' => '2. VDSL / ADSL Hat Sorunları',
                        'content' => 'Telefon prizi ile modem arasındaki splitter\'ı değiştirin. Bina dağıtım kutusuna kadar olan dahili hat oksitlenmiş veya kopuk olabilir. Modem DSL ışığı kırmızı/yanıp sönüyor olabilir; bu genellikle hat sorununu işaret eder.',
                        'tips'    => ['Bina girişindeki ADSL/VDSL kutusu kapı komşunuz tarafından yanlışlıkla kapatılmış olabilir; teyit edin.', 'Splitter arızası çok yaygındır; yedek bir splitter ile test edin.'],
                    ],
                    [
                        'heading' => '3. Vodafone Fiber (GPON) Bağlantı Sorunları',
                        'content' => 'Fiber ONT\'de LOS (kırmızı alarm ışığı) yanıyorsa fiber kablosunda kırık veya bükülme olabilir. ONT ile modem arasındaki ethernet kablosunu değiştirin. Vodafone fiber portalından port numaranızı öğrenip ONT\'nin doğru porta atandığını teyit edin.',
                        'tips'    => ['Fiber kablo kesitini doğrudan incelemeyin; invisible lazer içerir.', 'ONT\'yi yeniden başlatmak için fişini 30 sn çıkarın.'],
                    ],
                    [
                        'heading' => '4. Ne Zaman Profesyonel Destek Gerekir?',
                        'content' => 'Modemi değiştirmenize rağmen DSL ışığı yanmıyorsa, yapılan tüm kontrollere rağmen internet gelmiyorsa veya bina içi kablo hasarı şüphesi varsa mutlaka profesyonel teknik destek alın. Özellikle bina içi tesisat tamiri ISP\'nin sorumluluk alanı dışında kalır.',
                        'tips'    => ['Vodafone\'un arıza kaydını açtırmadan önce problemi kendi testlerinizle belgeleyin.', 'Bina içi tesisat tamiri için TürkTeknik\'i arayın; aynı gün yerinde müdahale yapıyoruz.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Vodafone internet tamamen kesildi, ne yapmalıyım?', 'a' => 'Önce Vodafone\'un 542 hattını arayarak bölgesel arıza olup olmadığını sorun. Arıza yoksa modemi sıfırlayın ve bağlantıyı kablolu test edin. Sorun devam ediyorsa ISP arıza kaydı açtırın.'],
                    ['q' => 'Vodafone Wi-Fi sinyali çok zayıf, nasıl güçlendiririm?', 'a' => 'Modemi merkezi bir konuma taşıyın, 5 GHz bandını etkinleştirin veya Access Point/Mesh sistemi ekleyin. Duvarlar ve büyük metal yüzeyler sinyali zayıflatır.'],
                    ['q' => 'Vodafone internet arızası için İzmir\'de yardım alabileceğim bir yer var mı?', 'a' => 'TürkTeknik olarak İzmir\'de bina içi hat tespiti ve onarımı yapıyoruz. 0546 911 80 61\'i arayın; aynı gün geliyoruz.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'superonline-arizasi' => [
                'slug'       => 'superonline-arizasi',
                'category'   => 'internet',
                'title'      => 'SuperOnline Arızası ve Sorun Giderme',
                'seoTitle'   => 'SuperOnline Internet Arıza ve Bağlantı Sorunu İzmir | TürkTeknik',
                'seoDesc'    => 'İzmir\'de SuperOnline internet arıza, yavaş bağlantı, kopma sorunları için rehber. Hat tespiti ve bina içi onarım. Teknik destek: 0546 911 80 61.',
                'keywords'   => 'superonline arıza izmir, superonline internet kesildi, superonline bağlanamıyor izmir, superonline hız sorunu, superonline teknik servis izmir',
                'icon'       => 'fas fa-exclamation-triangle',
                'color'      => 'orange',
                'intro'      => 'SuperOnline, Türkiye\'nin en büyük altyapı sağlayıcılarından biridir ve İzmir\'de geniş bir fiber ağına sahiptir. Ancak son kilometre (bina içi) altyapısı çoğu zaman eskidir ve bu da bağlantı sorunlarına yol açabilir.',
                'sections'   => [
                    [
                        'heading' => '1. SuperOnline Arıza Sorgulama',
                        'content' => 'superonline.com/ariza-sorgulama sayfasından veya 444 5 375 hattından bölgenizdeki arızayı sorgulayın. Toplu arıza yoksa sorun genellikle bina içi tesisattadır.',
                        'tips'    => ['SuperOnline uygulaması (iOS/Android) üzerinden anlık arıza bildirimi yapabilirsiniz.', 'Hesabınızdaki borcu kontrol edin; gecikmiş ödeme hat askıya alınmasına neden olabilir.'],
                    ],
                    [
                        'heading' => '2. Modem ve ONT Kontrolleri',
                        'content' => 'Fiber hatlarda ONT ışıklarını kontrol edin: PON ve LAN ışıkları yeşil olmalıdır. ADSL/VDSL hatlarda modem DSL ışığının sürekli yeşil yandığını doğrulayın. Modemi 30 sn tamamen kapatıp açın.',
                        'tips'    => ['Farklı bir ethernet kablosu ile test edin; hasarlı kablo çok yaygın bir sorundur.', 'SuperOnline VDSL hatlarında modeme VPI=0 / VCI=35 parametrelerini girin.'],
                    ],
                    [
                        'heading' => '3. Yavaş Hız ve Kopma Sorunları',
                        'content' => 'fast.com veya speedtest.net ile hız testi yapın. Hat gürültüsünü (SNR) modem istatistiklerinden kontrol edin; 20 dB altı bozuk hat işaretidir. Bina içi eski çift sarmal telefon kablosu VDSL hızını %40-50 düşürebilir.',
                        'tips'    => ['Dahili telefon hatları ve modeminiz arasındaki splitter arızası çok yaygındır.', 'Yoğun saatlerde hız düşüyorsa (akşam 18-22) bu ISP kaynaklı tıkanma olabilir; SuperOnline\'ı arayın.'],
                    ],
                    [
                        'heading' => '4. Bina İçi Hat Tamiri',
                        'content' => 'SuperOnline bina dağıtım kutusundan dairenize kadar olan hatta sorun varsa bu ISP\'nin sorumluluğu dışındadır. Hasarlı veya oksitlenmiş dahili VDSL kablosunun değiştirilmesi gerekebilir. Profesyonel bir teknik servis ile hat analizi yapılması en doğru çözümdür.',
                        'tips'    => ['Apartman yöneticisiyle konuşarak bina giriş kutusu durumunu teyit edin.', 'Kablo uzunluğu hız üzerinde önemli etki bırakır; mümkünse daha kısa hat çekin.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'SuperOnline internet neden yavaş?', 'a' => 'Bina içi hat kalitesi, modeminizin kapasitesi veya ISP tarafındaki tıkanma neden olabilir. Hat SNR değeri 25 dB üzerindeyse altyapı sağlamdır; altındaysa hat tamiri gerekebilir.'],
                    ['q' => 'SuperOnline arıza kaydı nasıl açılır?', 'a' => '444 5 375 numaralı SuperOnline destek hattını arayarak arıza kaydı açtırabilirsiniz. Online olarak superonline.com/destek üzerinden de başvuru yapabilirsiniz.'],
                    ['q' => 'İzmir\'de SuperOnline bina içi hat tamiri için kimle iletişime geçmeliyim?', 'a' => 'TürkTeknik olarak İzmir\'de bina içi VDSL/fiber hat tespiti ve onarımı yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'modem-arayuz-ayarlari' => [
                'slug'       => 'modem-arayuz-ayarlari',
                'category'   => 'internet',
                'title'      => 'Modem Arayüz Ayarları',
                'seoTitle'   => 'Modem Arayüz Ayarları — Şifre, DNS, Port Yönlendirme | TürkTeknik İzmir',
                'seoDesc'    => 'Modem arayüzüne nasıl girilir? Wi-Fi şifre değiştirme, DNS ayarı, port yönlendirme, güvenlik duvarı ve QoS rehberi. İzmir teknik destek: 0546 911 80 61.',
                'keywords'   => 'modem arayüz ayarları, modem şifre değiştirme, modem dns ayarı, port yönlendirme, modem güvenlik duvarı izmir, modem qos ayarı',
                'icon'       => 'fas fa-sliders-h',
                'color'      => 'indigo',
                'intro'      => 'Modem arayüzüne girerek Wi-Fi şifresi değiştirme, port yönlendirme veya DNS ayarı yapabilirsiniz. Marka ve modele göre arayüz farklılık gösterse de temel adımlar benzerdir.',
                'sections'   => [
                    [
                        'heading' => '1. Modem Arayüzüne Giriş',
                        'content' => 'Bilgisayarınızda bir tarayıcı açın ve adres çubuğuna 192.168.1.1, 192.168.0.1 veya 192.168.100.1 girin. Kullanıcı adı/şifre genellikle modem üzerindeki etikette yazar. Bilmiyorsanız "admin/admin" veya "admin/password" deneyin.',
                        'tips'    => ['Adres bulunamıyorsa komut istemcisine "ipconfig" yazın; "Varsayılan Ağ Geçidi" modeminizin IP\'sidir.', 'Tarayıcı HTTPS uyarısı veriyorsa "Yine de Devam Et" seçeneğiyle geçebilirsiniz.'],
                    ],
                    [
                        'heading' => '2. Wi-Fi Şifresi ve Ağ Adı (SSID) Değiştirme',
                        'content' => '"Kablosuz" veya "WLAN" sekmesini açın. Ağ adını (SSID) dilediğiniz gibi değiştirin. Şifreleme tipi olarak WPA2-AES seçin ve en az 12 karakterli, büyük/küçük harf, rakam ve sembol içeren güçlü bir şifre belirleyin.',
                        'tips'    => ['WPA3 destekli modem kullanıyorsanız WPA3 seçmek daha güvenlidir.', 'Şifrenizi değiştirdikten sonra tüm cihazların yeni şifre ile tekrar bağlanması gerekir.'],
                    ],
                    [
                        'heading' => '3. DNS Sunucusu ve İnternet Hızı',
                        'content' => 'WAN veya İnternet ayarlarından DNS sunucularını manuel girin. Cloudflare 1.1.1.1 / 1.0.0.1 veya Google 8.8.8.8 / 8.8.4.4 daha hızlı ve güvenlidir. Bu ayar DNS çözümleme hızını artırarak genel sörf deneyimini iyileştirir.',
                        'tips'    => ['DNS değişikliği sayfa açma hızını etkiler ama indirme hızını değil.', 'Ebeveyn denetimi için OpenDNS Family Shield (208.67.222.123) kullanabilirsiniz.'],
                    ],
                    [
                        'heading' => '4. Port Yönlendirme (Port Forwarding)',
                        'content' => '"NAT" veya "Port Yönlendirme" menüsünden dışarıdan erişmek istediğiniz uygulamanın portunu belirleyin. Örneğin güvenlik kamerası için TCP/UDP 8080 portunu NVR\'ınızın yerel IP\'sine yönlendirin. Bu sayede dış ağdan cihazınıza erişebilirsiniz.',
                        'tips'    => ['Yönlendirme yapacağınız cihazın IP\'sini sabit (statik) atayın; DHCP ile her seferinde değişebilir.', 'Gereksiz portları açık bırakmak güvenlik açığı oluşturur.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Modem arayüzü şifremi unutdum, ne yapabilirim?', 'a' => 'Modeminizi fabrika ayarlarına sıfırlayın (reset butonu 10 sn). Bundan sonra varsayılan şifre ile giriş yapabilirsiniz. Fabrika şifresi modem kutusunda veya üzerindeki etikette yazar.'],
                    ['q' => 'Modem arayüzüne bağlanamayanlar ne yapmalı?', 'a' => 'Ethernet kablosuyla direkt bağlanın ve 192.168.1.1 veya 192.168.0.1 deneyin. IP çakışması varsa bilgisayarınızın IP\'sini otomatik (DHCP) olarak ayarlayın.'],
                    ['q' => 'İzmir\'de modem ayarı için uzaktan destek alabilir miyim?', 'a' => 'Evet, TürkTeknik olarak telefon veya yerinde destek veriyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'mesh-wifi-sistemi-kurulumu' => [
                'slug'       => 'mesh-wifi-sistemi-kurulumu',
                'category'   => 'internet',
                'title'      => 'Mesh Wi-Fi Sistemi Kurulumu',
                'seoTitle'   => 'Mesh Wi-Fi Kurulumu İzmir | TP-Link Deco & Eero Kurulum | TürkTeknik',
                'seoDesc'    => 'İzmir\'de ev ve işyeri için Mesh Wi-Fi sistemi kurulumu. TP-Link Deco, Eero, Netgear Orbi kurulum rehberi ve profesyonel montaj. 0546 911 80 61.',
                'keywords'   => 'mesh wifi kurulumu izmir, tp-link deco kurulum, mesh sistem izmir, wifi kapsama alanı genişletme, access point kurulumu izmir, eero kurulum izmir',
                'icon'       => 'fas fa-server',
                'color'      => 'cyan',
                'intro'      => 'Büyük evlerde, dublekslerde veya ölü nokta sorunu yaşadığınız mekânlarda Mesh Wi-Fi sistemi mükemmel bir çözümdür. Tek bir ağ ismiyle tüm alana kesintisiz bağlantı sağlar; cihazlarınız odalar arasında geçerken otomatik en güçlü noktaya bağlanır.',
                'sections'   => [
                    [
                        'heading' => '1. Mesh Sistemi Nedir ve Ne Zaman Gerekir?',
                        'content' => 'Klasik tekrarlayıcı (repeater) sinyali kopyalar ve bant genişliğini yarıya düşürür. Mesh sistemlerde ise düğümler (node) aralarında ayrı bir kanal üzerinden haberleşir; performans kaybı minimumdur. 150 m² üzeri mekânlar, çok katlı evler ve betonlu yapılar için idealdir.',
                        'tips'    => ['Sadece Wi-Fi zayıfsa ve bina küçükse önce güçlü bir tekli router deneyin; belki Mesh\'e gerek olmayabilir.'],
                    ],
                    [
                        'heading' => '2. Kurulum Adımları (TP-Link Deco Örneği)',
                        'content' => 'Ana Deco ünitesini modeminizin/ONT\'nin LAN portuna ethernet ile bağlayın. Deco uygulamasını indirip hesap oluşturun ve ağ adı/şifre belirleyin. İkinci ve üçüncü düğümleri aynı uygulama üzerinden sisteme ekleyin; otomatik olarak ağı genişletirler.',
                        'tips'    => ['Düğümleri birbirine kablo ile bağlarsanız (kablolu backhaul) performans önemli ölçüde artar.', 'Düğüm yerleşiminde sinyal gücünün %40-70 arasında olduğu noktaları seçin; çok zayıf yer sistemi yavaşlatır.'],
                    ],
                    [
                        'heading' => '3. Kanal ve Band Yönetimi',
                        'content' => 'Kaliteli Mesh sistemleri "Band Steering" ile cihazı 2.4 veya 5 GHz bandına otomatik yönlendirir. Tri-band sistemlerde (2.4 + 5 + 5 GHz) üçüncü band yalnızca düğümler arası backhaul için kullanılır; bu da kullanıcı trafiği için tam bant genişliği sağlar.',
                        'tips'    => ['6 GHz destekli (Wi-Fi 6E) Mesh sistemleri mümkün olan en yüksek performansı verir.', 'Düğümler arası mesafeyi ölçmek için uygulamadaki sinyal göstergesini kullanın.'],
                    ],
                    [
                        'heading' => '4. Profesyonel Kurulumda Avantajlar',
                        'content' => 'Doğru cihaz konumlandırması, ethernet backhaul kablolama planlaması ve güvenlik ayarları profesyonel kurulum gerektirir. Yanlış yerleştirilen düğümler Mesh\'in performans vaadini karşılayamaz.',
                        'tips'    => ['Kurulum sonrası her odadan hız testi yaparak kapsama kalitesini doğrulayın.', 'Aylık yazılım güncellemelerini yapmayı unutmayın.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Mesh Wi-Fi sistemi normal modemden daha mı iyi?', 'a' => 'Büyük alanlarda kesinlikle daha iyidir. 80 m² altı dairelerde iyi konumlandırılmış tek bir router yeterlidir; Mesh\'in avantajı geniş mekânlarda ortaya çıkar.'],
                    ['q' => 'Kaç tane Mesh düğümü yeterli?', 'a' => 'Standart bir 3+1 daireli ev için 2 düğüm genellikle yeterlidir. 200 m² üzeri veya çok katlı evler için 3 düğüm önerilir.'],
                    ['q' => 'İzmir\'de Mesh Wi-Fi kurulumu için kimle iletişime geçebilirim?', 'a' => 'TürkTeknik olarak İzmir\'de Mesh Wi-Fi planlama, kurulum ve konfigürasyon hizmeti veriyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            'turk-telekom-arizasi' => [
                'slug'       => 'turk-telekom-arizasi',
                'category'   => 'internet',
                'title'      => 'Türk Telekom Arızası ve Sorun Giderme',
                'seoTitle'   => 'Türk Telekom Internet Arızası İzmir | Hat Tespiti | TürkTeknik',
                'seoDesc'    => 'İzmir\'de Türk Telekom internet arızası, fiber veya ADSL bağlantı kesilmesi, hız düşüklüğü sorunları. Bina içi hat tespiti ve onarım. 0546 911 80 61.',
                'keywords'   => 'türk telekom arıza izmir, türk telekom internet gelmiyor, tt fiber arıza, adsl arıza izmir, türk telekom hız sorunu, türk telekom teknik servis izmir',
                'icon'       => 'fas fa-phone-slash',
                'color'      => 'blue',
                'intro'      => 'Türk Telekom, İzmir\'de en geniş altyapıya sahip internet servis sağlayıcısıdır. ADSL, VDSL ve FTTH (fiber) hizmetleri sunan TT\'nin arıza süreçleri ve bina içi hat sorunlarını bu rehberde ele alıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. TT Arıza Sorgulama',
                        'content' => 'Türk Telekom\'un 444 1 444 hattını veya tt.com.tr/ariza sayfasını kullanarak bölgenizdeki arıza kaydını sorgulayın. "e-devlet üzerinden Türk Telekom Arıza" araması da sonuçlara ulaştırır.',
                        'tips'    => ['Fiber aboneler için "TT Fiber" uygulamasından anlık durum takibi yapılabilir.', 'Sabah 07:00-08:00 saatlerinde 444 1 444\'ü aramak kuyruk süresini kısaltır.'],
                    ],
                    [
                        'heading' => '2. ADSL/VDSL Hat Sorunları',
                        'content' => 'Telefon prizi ve splitter\'ı kontrol edin. Dahili hat üzerindeki tüm paralel bağlantıları (ek priz, aynı hattan beslenen faks vb.) kaldırın. Modemi doğrudan duvardaki ana prize bağlayın. DSL ışığı hâlâ yanmıyorsa TT arıza kaydı açtırın.',
                        'tips'    => ['Fırtına veya yağmur sonrası arıza artıyorsa bina girişindeki kablo kutusu nemden etkilenmiştir.', 'Splitter kalitesi çok düşükse VDSL hızını ciddi biçimde düşürür; kaliteli bir splitter değiştirin.'],
                    ],
                    [
                        'heading' => '3. TT Fiber (FTTH) Bağlantı Problemleri',
                        'content' => 'ONT cihazındaki "LOS" (kırmızı) ışık fiber kablo sorununa işaret eder. ONT ile modem arasındaki ethernet kablosunu değiştirip tekrar deneyin. Sorun devam ediyorsa TT arıza kaydı açtırın; ISP kendi altyapısını ücretsiz onarır.',
                        'tips'    => ['Fiber kablo katlanmamalıdır; minimum 30 mm bükülme yarıçapına dikkat edin.', 'ONT cihazını yeniden başlatmak için düğmesine 10 sn basın veya fişini çekin.'],
                    ],
                    [
                        'heading' => '4. Bina İçi Tesisat ve Profesyonel Onarım',
                        'content' => 'TT teknisyeni bina giriş noktasına kadar sorumluluk alır. Dairenizdeki dahili tesisat ISP sorumluluk alanı dışındadır. Kablo oksidasyonu, kopuk veya kötü eklenmiş kablo, eski borular içindeki nem; tüm bu sorunlar bağımsız teknik servis gerektiren dahili hat sorunlarıdır.',
                        'tips'    => ['Sigorta kaydı açtırmadan önce ISP\'den ayrı bina içi hat tespiti yaptırın; bu zaman kazandırır.', 'CAT6 kablo ile eski telefon kablolarını değiştirmek uzun vadeli çözümdür.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Türk Telekom arıza kaydı nasıl açılır?', 'a' => '444 1 444\'ü arayarak arıza kaydı açabilirsiniz. Kayıt numarası alın ve onay SMS\'ini saklayın. e-devlet üzerinden de talep oluşturabilirsiniz.'],
                    ['q' => 'TT teknisyeni geldi ama sorun çözülmedi, ne yapabilirim?', 'a' => 'Bina içi dahili hat arızalarını TT çözmez. Bu durumda bağımsız teknik servislerden (TürkTeknik gibi) bina içi hat tespiti ve onarımı yaptırmanız gerekir.'],
                    ['q' => 'Türk Telekom internet arızası için İzmir\'de teknik servis var mı?', 'a' => 'TürkTeknik olarak İzmir\'de TT dahil tüm sağlayıcılarda bina içi hat tespiti ve onarımı yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'internet',
                'ctaRoute'   => 'services.internet',
            ],

            // ─── UYDU / ANTEN ────────────────────────────────────────────
            'diseqc-ayarlari' => [
                'slug'       => 'diseqc-ayarlari',
                'category'   => 'uydu',
                'title'      => 'DiSEqC Ayarları Nasıl Yapılır',
                'seoTitle'   => 'DiSEqC Ayarları Nasıl Yapılır? İzmir Uydu Teknik Servis | TürkTeknik',
                'seoDesc'    => 'DiSEqC anahtarı nedir, nasıl bağlanır ve alıcıda nasıl ayarlanır? İzmir\'de uydu sistemi kurulumu ve DiSEqC problemi için teknik destek. 0546 911 80 61.',
                'keywords'   => 'diseqc ayarı, diseqc switch bağlantısı, diseqc 1.0 1.1 1.2 nedir, diseqc uydu problemi izmir, çok uydu alımı ayarı izmir',
                'icon'       => 'fas fa-satellite-dish',
                'color'      => 'emerald',
                'intro'      => 'DiSEqC (Digital Satellite Equipment Control), tek çanakla birden fazla uyduyu veya LNB\'yi yönetmenizi sağlayan bir protokoldür. İzmir\'de merkezi uydu sistemlerinde ve çok uydulu kurulumlarda sıklıkla karşılaşılan bu protokolün ayarlarını bu rehberde adım adım anlatıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. DiSEqC Nedir ve Sürümleri',
                        'content' => 'DiSEqC 1.0: Maksimum 4 uydu/LNB için 2 bitlik ton burst komutu. DiSEqC 1.1: 16\'ya kadar cihaz destekler. DiSEqC 1.2: Motorlu (USALS) çanak anten kontrolü. DiSEqC 2.x: İki yönlü iletişim, daha gelişmiş kontrol.',
                        'tips'    => ['Alıcınızın hangi DiSEqC sürümünü desteklediğini kılavuzundan kontrol edin.', '4\'ten fazla uydu için DiSEqC 1.1 switch gerekir.'],
                    ],
                    [
                        'heading' => '2. DiSEqC Switch Bağlantısı',
                        'content' => 'Switch\'in girişlerini (IN1, IN2…) LNB çıkışlarına, çıkışını (OUT) alıcıya bağlayın. Kablo bağlantısı tamamlandıktan sonra alıcı menüsünden "Anten Ayarları" → "DiSEqC" bölümüne gelin. Her kanal için hangi LNB/uydu portuna karşılık geldiğini girin.',
                        'tips'    => ['F konnektörleri doğru sıkın; gevşek bağlantı sinyal kaybına neden olur.', '2\'li switch için DiSEqC 1.0, 4\'lü switch için DiSEqC 1.0 veya 1.1 kullanılır.'],
                    ],
                    [
                        'heading' => '3. Alıcıda Kanal Tarama ve Uydu Seçimi',
                        'content' => 'Alıcı menüsünde "Kurulum → Anten Ayarları"na girin. Her uydu için LNB frekansını (Universal LNB: 9750/10600 MHz) ve DiSEqC portunu belirleyin. Uydu üzerinden otomatik kanal arama yapın. Türksat 42E için DiSEqC 1 genellikle yeterlidir.',
                        'tips'    => ['Türksat 42E + Hotbird 13E kombinasyonu için 2\'li DiSEqC switch yeterlidir.', 'Kanal taramadan önce doğru uydu frekans transponder bilgilerini girin.'],
                    ],
                    [
                        'heading' => '4. DiSEqC Sorunları ve Çözümleri',
                        'content' => 'Bazı kanallar gelmiyorsa DiSEqC port numarası yanlış seçilmiş olabilir. Sinyal gidip geliyorsa DiSEqC switch arızası veya kablo sorunu vardır. Tüm uydular gelmiyorsa LNB güç kaynağı veya switch beslemesi yetersiz olabilir.',
                        'tips'    => ['Switch\'i atlatıp doğrudan LNB-alıcı bağlantısıyla test edin; böylece switch arızasını izole edersiniz.', 'Uzun kablo mesafesinde sinyal kaybı DiSEqC komutlarının iletilmesini engelleyebilir.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'DiSEqC switch olmadan iki uyduya bakabilir miyim?', 'a' => 'Hayır, tek anten ve tek LNB ile sadece bir uyduya bakılabilir. İki uydu için ya iki ayrı çanak (2 LNB + DiSEqC switch) ya da çift LNB\'li çanak gerekir.'],
                    ['q' => 'DiSEqC ayarı yaptım ama kanallar gelmiyor, neden?', 'a' => 'Büyük ihtimalle DiSEqC port numarası yanlış veya kablo bağlantısı gevşek. Ayrıca sinyal gücünü alıcı menüsünden kontrol edin; 50 altındaysa çanak yön problemi vardır.'],
                    ['q' => 'İzmir\'de DiSEqC kurulumu için profesyonel yardım alabilir miyim?', 'a' => 'Evet, TürkTeknik olarak İzmir\'de DiSEqC kurulumu ve çok uydu sistemi montajı yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'uydu',
                'ctaRoute'   => 'services.satellite',
            ],

            'canak-anten-ayari' => [
                'slug'       => 'canak-anten-ayari',
                'category'   => 'uydu',
                'title'      => 'Çanak Anten Ayarı Nasıl Yapılır',
                'seoTitle'   => 'Çanak Anten Ayarı Nasıl Yapılır? İzmir Uydu Yön Ayarı | TürkTeknik',
                'seoDesc'    => 'İzmir\'de çanak anten yön ayarı, Türksat bulmak, sinyal ölçümü ve LNB ayarı rehberi. Profesyonel uydu montajı için 0546 911 80 61.',
                'keywords'   => 'çanak anten ayarı nasıl yapılır, türksat çanak anten yönü izmir, çanak anten sinyal ayarı, lnb ayarı izmir, uydu bulucu izmir',
                'icon'       => 'fas fa-satellite-dish',
                'color'      => 'emerald',
                'intro'      => 'Çanak anten yön ayarı, milimetrik hassasiyetle yapılması gereken ve deneyim isteyen bir işlemdir. İzmir\'de Türksat 42°E uydusunu bulabilmek için azimut ve elevasyon değerlerini doğru ayarlamak gerekmektedir.',
                'sections'   => [
                    [
                        'heading' => '1. İzmir İçin Uydu Koordinatları',
                        'content' => 'İzmir\'in coğrafi konumuna göre Türksat 42°E için yaklaşık azimut 165-170° (güneyin biraz doğusuna) ve elevasyon 42-44° şeklindedir. dishpointer.com sitesinden tam adresinizi girerek hassas değerleri elde edin.',
                        'tips'    => ['Komşunuzun çanağının yönünü referans alabilirsiniz; aynı binada yakın değerler geçerlidir.', 'Pusula uygulamasını kullanarak azimut yönünü belirleyin.'],
                    ],
                    [
                        'heading' => '2. Montaj ve Kaba Ayar',
                        'content' => 'Çanağı sağlam bir yüzeye sabit montajlayın. Direği su terazisi ile tam dik konumlandırın; hafif bir eğim bile sinyali keser. Önce elevasyon vidasını ayarlayın, ardından azimut (yatay yön) vidasını. Sigorta vidalarını çok sıkmadan gevşek bırakın.',
                        'tips'    => ['Çanak önünde ağaç, bina veya baca yokluğunu teyit edin.', 'Montaj deliklerini silikon ile kapatın; içeri su kaçması LNB\'yi bozar.'],
                    ],
                    [
                        'heading' => '3. Sinyal Ölçümü ve İnce Ayar',
                        'content' => 'Uydu alıcısının sinyal ölçüm ekranını veya uydu bulucu cihazı açın. Alıcı menüsünden "Anten Sinyal Durumu"na girin. Çanağı yavaşça sağa-sola, yukarı-aşağı hareket ettirin. Sinyal değeri (kalite) maksimuma ulaştığında tüm vidaları sıkıştırın.',
                        'tips'    => ['Sinyal gücü değil sinyal kalitesi önemlidir; kalite %60 üzeri iyi kabul edilir.', 'Bir yardımcı ile çalışın: biri çanağı hareket ettirsin, diğeri alıcıdan değerleri okusun.'],
                    ],
                    [
                        'heading' => '4. LNB Konumu ve Polarizasyon',
                        'content' => 'LNB\'yi tutucuda döndürerek yatay/dikey polarizasyon açısını optimize edin (skew ayarı). İzmir\'de Türksat için skew yaklaşık -5° ile +5° arasındadır. F konnektörlerine ısı büzüşmeli makaron takın; nem LNB\'nin en büyük düşmanıdır.',
                        'tips'    => ['LNB değişiminde orijinal veya kaliteli marka tercih edin; ucuz LNB yağmurda sinyal kaybı yaratır.', 'Yıllık bakımda LNB konnektörlerini kontrol ettirin.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Çanak anten yönünü kendim ayarlayabilir miyim?', 'a' => 'Temel yön bilgisiyle deneyebilirsiniz, ancak profesyonel ölçüm cihazları olmadan optimum sinyale ulaşmak zorlaşır. Özellikle merkezi sistemlerde uzman yardımı şarttır.'],
                    ['q' => 'Çanak antenimi komşu bina gölgeliyorsa ne yapabilirim?', 'a' => 'Çanağı daha yüksek bir noktaya (teras, çatı) taşımak çözüm olabilir. Alternatif olarak çatı güney cephesinde açık alan varsa oraya montaj yapılabilir.'],
                    ['q' => 'İzmir\'de çanak anten ayarı için ücretli teknik servis var mı?', 'a' => 'Evet, TürkTeknik olarak İzmir\'de uydu bulucu cihazla milimetrik hassasiyette çanak anten ayarı yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'uydu',
                'ctaRoute'   => 'services.satellite',
            ],

            'tv-kanal-ayarlari' => [
                'slug'       => 'tv-kanal-ayarlari',
                'category'   => 'uydu',
                'title'      => 'TV Kanallar Gelmiyor — Kanal Arama',
                'seoTitle'   => 'TV Kanallar Gelmiyor, Çakırtı Var İzmir | Uydu Kanal Sorunu | TürkTeknik',
                'seoDesc'    => 'Uydu veya kablo TV\'de kanallar gelmiyor, çakırtı var veya siyah ekran? İzmir\'de uydu kanal arama, sinyal tespiti ve onarım. 0546 911 80 61.',
                'keywords'   => 'tv kanallar gelmiyor izmir, uydu kanal bulunamıyor, kanallar silindi nasıl yüklenilir, çakırtı var televizyon izmir, sinyal yok uydu izmir',
                'icon'       => 'fas fa-tv',
                'color'      => 'emerald',
                'intro'      => 'TV ekranında "Sinyal Yok", "Anten Takılı Değil" veya çakırtı görüntüsü ile karşılaştıysanız sorun anten, LNB, kablo veya alıcıda olabilir. Bu rehberde İzmir\'de yaygın yaşanan TV kanal sorunlarını ve çözümlerini anlatıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. Temel Kontroller',
                        'content' => 'Kablo bağlantılarını kontrol edin: anten kablosu TV girişine veya uydu alıcısına sıkı oturmalıdır. Alıcıyı yeniden başlatın. Kanallar tamamen kaybolduysa "Fabrika Ayarları" yerine "Kanal Arama" yapın; bu şekilde tüm ayarlarınız korunur.',
                        'tips'    => ['Elektrik kesintisi sonrası kanal listesi kaybolmuşsa alıcıyı USB\'den yedekle geri yükleyebilirsiniz.', 'Uydu alıcısı ile TV arasındaki HDMI/SCART kablosunu değiştirip test edin.'],
                    ],
                    [
                        'heading' => '2. Türksat Kanal Taraması',
                        'content' => 'Alıcı menüsünden "Kurulum → Kanal Arama → Otomatik Arama" seçin. Türksat 42°E için frekans 11854 MHz, sembol hızı 30000, FEC 5/6 girilir (ya da otomatik arama tercih edilir). Arama sonunda kanalları "Listeye Ekle" ile kaydedin.',
                        'tips'    => ['Manuel transponder girişi ile daha hızlı sonuç alabilirsiniz.', 'Türksat\'ta bazı kanallar şifreli (ücretli) olduğundan ücretsiz kanal sayısı arama sonucundan az çıkabilir.'],
                    ],
                    [
                        'heading' => '3. Sinyal Yok veya Çakırtı Nedenleri',
                        'content' => '"Sinyal Yok" hatası için: LNB arızası, bağlantı kablolarındaki kırık/nem, çanak yön kayması veya DiSEqC switch arızası. "Çakırtı/Bozuk Görüntü" için: Zayıf sinyal (SNR düşük), kablo hasarı, bant genişliği problemi veya yanlış sembol hızı.',
                        'tips'    => ['LNB beslemesini (13V/18V) kontrol edin; alıcı uygun voltajı göndermiyorsa LNB çalışmaz.', 'Çanak üzerine kar veya ağırlık binmişse sinyali keser; temizleyin.'],
                    ],
                    [
                        'heading' => '4. Merkezi Sistem (SMATV) Sorunları',
                        'content' => 'Apartmanda sadece kendi dairenizde kanal gelmiyorsa sorun dairenizin kablosu veya prizindedir. Birden fazla dairede sorun varsa multiswitch veya kablo gövdesinde problem olabilir. Yalnızca bir uydu kanalı gelmiyorsa DiSEqC port numarası veya LNB sorunu vardır.',
                        'tips'    => ['Kanal gelen komşunun kablosunu kendi alıcınıza bağlayıp test edin; bu yöntemi bağımsız değişkenleri izole etmek için kullanın.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Tüm kanallar silindi, nasıl geri yüklerim?', 'a' => 'Alıcı menüsünden "Otomatik Kanal Arama" yapın. Eğer USB\'de yedek varsa "USB\'den Yükle" seçeneği ile geri getirin.'],
                    ['q' => 'Yağmurda kanallar gidiyor, bu normal mi?', 'a' => 'Hafif yağmurda kanal kayboluyorsa sinyal marjininiz (SNR) zayıf demektir; LNB değişimi veya çanak yön ince ayarı gerekebilir. Şiddetli fırtınada geçici kayıp normaldir.'],
                    ['q' => 'İzmir\'de kanal sorunu ve uydu tamir için kimle iletişime geçmeliyim?', 'a' => 'TürkTeknik olarak İzmir\'de uydu kanal sorunu, LNB değişimi ve sinyal ölçümü yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'uydu',
                'ctaRoute'   => 'services.satellite',
            ],

            // ─── KAMERA ──────────────────────────────────────────────────
            'kamera-goruntusu-gelmiyor' => [
                'slug'       => 'kamera-goruntusu-gelmiyor',
                'category'   => 'kamera',
                'title'      => 'Güvenlik Kamerası Görüntüsü Gelmiyor',
                'seoTitle'   => 'Güvenlik Kamerası Görüntüsü Gelmiyor İzmir | Kamera Arızası | TürkTeknik',
                'seoDesc'    => 'İzmir\'de güvenlik kamerası görüntüsü gelmiyor, siyah ekran veya bağlanamıyor hatası? Kamera, kablo ve NVR/DVR arıza tespiti. Destek: 0546 911 80 61.',
                'keywords'   => 'güvenlik kamerası görüntüsü gelmiyor izmir, kamera siyah ekran, kamera bağlanamıyor, dvr nvr arıza izmir, ip kamera arıza izmir',
                'icon'       => 'fas fa-video-slash',
                'color'      => 'indigo',
                'intro'      => 'Güvenlik kamera sistemlerinde "Görüntü Yok", "Kanal Yok" veya siyah ekran sorunları oldukça yaygındır. Sorunun kaynağını doğru tespit etmek onarım süresini kısaltır. Bu rehberde İzmir\'de en sık karşılaştığımız kamera sorunlarını ve çözümlerini bulabilirsiniz.',
                'sections'   => [
                    [
                        'heading' => '1. Güç ve Kablo Kontrolü',
                        'content' => 'Kameranın güç LED\'i yanıyor mu? Güç adaptörü veya PoE switch üzerinden voltaj ölçün (12V DC veya PoE). Kameradan DVR/NVR\'a giden koaksiyel (BNC) veya CAT6 (IP) kablonun kontakları ve konnektörleri kontrol edin.',
                        'tips'    => ['PoE kameralarda switch portu arızalı olabilir; başka bir porta bağlayıp deneyin.', 'Uzun kablo mesafesinde voltaj düşmesi kamera görüntüsünü bozar; 30 m üzerinde kalın kablo (RG59U) kullanın.'],
                    ],
                    [
                        'heading' => '2. DVR/NVR Kanal Ayarları',
                        'content' => 'DVR/NVR arayüzünde ilgili kanalın aktif olduğunu doğrulayın. Kanal tipi ayarını kontrol edin: Analog kamera için "Analog/AHD/TVI", IP kamera için "IP Kanal" seçili olmalıdır. Kanalı silin ve yeniden ekleyin.',
                        'tips'    => ['NVR ile IP kameranın aynı alt ağda (subnet) olduğundan emin olun; IP çakışması görüntüyü keser.', 'DVR firmware güncel değilse yeni nesil kameraları tanıyamayabilir.'],
                    ],
                    [
                        'heading' => '3. IP Kamera Erişim Sorunu',
                        'content' => 'Kameranın IP adresini ağ tarayıcısı (SADP Tool, Advanced IP Scanner) ile tespit edin. Kameraya tarayıcı üzerinden (http://IP) erişmeyi deneyin. Şifre yanlışsa veya unutulmuşsa kamerayı fiziksel resetleyin (genellikle kablo konnektörü yakınında reset deliği).',
                        'tips'    => ['IP kamera varsayılan şifreleri: admin/admin, admin/12345 veya boş şifreli olabilir.', 'Kamera ile NVR farklı marka ise ONVIF protokolünün açık olduğunu teyit edin.'],
                    ],
                    [
                        'heading' => '4. Kamera Fiziksel Arızası',
                        'content' => 'Kameranın içindeki sensör veya lens hasarı, elektrik dalgalanmalarından yanan board veya nem giren gövde kalıcı arızaya yol açar. Kamerayı doğrudan monitöre bağlayıp test edin; görüntü geliyorsa sorun DVR/NVR veya kablodadır, gelmiyorsa kamera arızalıdır.',
                        'tips'    => ['Dış mekân kameralarında gece lens önü buğulanıyorsa conta sızdırmaz değildir; servis gerekir.', 'Yıllık bakımda lens temizliği ve kablo tespiti yaptırın.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Kamera görüntüsü gece siyah, gündüz normal. Neden?', 'a' => 'Gece görüş (IR) LED\'leri yanmıyor olabilir. Kameranın güç kaynağının yeterli akım sağlayıp sağlamadığını kontrol edin. IR cut filtre arızası da bu soruna neden olabilir.'],
                    ['q' => 'Bazı kanallar görüntü veriyor bazıları vermiyor. Neden?', 'a' => 'Sorunlu kanalların kablo bağlantılarını ve kamera güçlendirmelerini ayrı ayrı test edin. DVR\'da o kanal için sinyal formatı (AHD/TVI/CVI) yanlış seçilmiş olabilir.'],
                    ['q' => 'İzmir\'de kamera görüntü sorunu için teknik servis var mı?', 'a' => 'TürkTeknik olarak İzmir\'de kamera sistemleri arıza tespiti ve onarımı yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'kamera',
                'ctaRoute'   => 'services.camera',
            ],

            'kamera-uzaktan-izleme' => [
                'slug'       => 'kamera-uzaktan-izleme',
                'category'   => 'kamera',
                'title'      => 'Kamera Uzaktan İzleme Kurulumu',
                'seoTitle'   => 'Kamera Uzaktan İzleme Kurulumu — Telefon ile İzleme | TürkTeknik İzmir',
                'seoDesc'    => 'İzmir\'de güvenlik kameralarını telefondan izleme kurulumu. Port yönlendirme, P2P bulut, DDNS ayarı ve uygulama yapılandırma rehberi. 0546 911 80 61.',
                'keywords'   => 'kamera uzaktan izleme izmir, güvenlik kamerası telefon izleme, nvr port yönlendirme, ddns ayarı kamera, p2p kamera kurulumu izmir',
                'icon'       => 'fas fa-mobile-alt',
                'color'      => 'indigo',
                'intro'      => 'Güvenlik kameralarınızı evden veya iş yerinden uzaktan izlemek için birkaç farklı yöntem kullanılabilir. Bu rehberde İzmir\'de en yaygın kullanılan P2P bulut bağlantısı ve port yönlendirme yöntemlerini anlatıyoruz.',
                'sections'   => [
                    [
                        'heading' => '1. P2P (Bulut) Uzaktan Erişim',
                        'content' => 'Modern NVR/DVR cihazlarının büyük çoğunluğu P2P bulut teknolojisine sahiptir. Cihazınızın arayüzünden "P2P" veya "Cloud" seçeneğini etkinleştirin. QR kodu okutarak üretici uygulamasına (Hik-Connect, iVMS-4500, XMEye) ekleyin. Statik IP veya port yönlendirmeye gerek kalmadan erişim sağlanır.',
                        'tips'    => ['P2P basit ama bulut sunucusuna bağımlıdır; güvenlik açısından güçlü parola şarttır.', 'Hik-Connect: Hikvision, XMEye: Dahua/Uniview uyumlu sistemler için kullanılır.'],
                    ],
                    [
                        'heading' => '2. Port Yönlendirme ile Doğrudan Erişim',
                        'content' => 'Modemin arayüzünde "Port Yönlendirme" menüsünü açın. DVR/NVR için HTTP portu (genellikle 80 veya 8080) ve cihaz iletişim portu (genellikle 8000) için kurallar oluşturun. Gelen bağlantıları DVR/NVR\'ın yerel IP adresine yönlendirin.',
                        'tips'    => ['DVR/NVR\'a sabit IP atayın; DHCP ile her seferinde IP değişirse yönlendirme çalışmaz.', 'Dışarıdan erişim testi için canlı bağlantı üzerinden not edin; www.whatismyip.com ile dış IP\'nizi öğrenin.'],
                    ],
                    [
                        'heading' => '3. DDNS Ayarı (Değişen IP Sorunu)',
                        'content' => 'İnternet servis sağlayıcınız dinamik IP kullanıyorsa DDNS (Dinamik DNS) servisine ihtiyaç duyarsınız. DVR/NVR arayüzünde "DDNS" sekmesini etkinleştirin; No-IP, DynDNS veya üretici DDNS servisi kullanabilirsiniz. Böylece IP değişse bile sabit alan adı üzerinden erişim sürer.',
                        'tips'    => ['Türkiye\'de çoğu ISP dinamik IP verir; statik IP için ek ücret ödenerek ISP\'den alınabilir.', 'DDNS güncellemesi modeminizden de yapılabilir; bu daha güvenilirdir.'],
                    ],
                    [
                        'heading' => '4. Mobil Uygulama Yapılandırması',
                        'content' => 'Cihaz markanıza uygun uygulamayı yükleyin. IP/DDNS adresi, port, kullanıcı adı ve şifreyi girin. Akış kalitesini (Ana Akış / Alt Akış) mobil veri kullanımına göre ayarlayın. Motion alert bildirimleri etkinleştirin; hareket algılandığında telefonunuza anlık bildirim gelsin.',
                        'tips'    => ['Hücresel ağ üzerinden izleme için Alt Akış (Sub-Stream) seçin; daha az veri harcar.', 'Uygulama bağlanamıyorsa port 8080\'in ISP tarafından engellenip engellenmediğini kontrol edin.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Kamerayı telefondan izleyemiyorum, port açık ama bağlanamıyorum?', 'a' => 'ISP\'niz gelen bağlantıları kısıtlıyor olabilir. Alternatif port deneyin veya P2P bulut yöntemini tercih edin. Çift NAT (modem + router) durumunda her ikisinde de port yönlendirme yapılmalıdır.'],
                    ['q' => 'P2P bağlantısı güvenli mi?', 'a' => 'Güçlü şifre kullanıldığında P2P makul ölçüde güvenlidir. Ancak kurumsal güvenlik için VPN üzerinden erişim daha sağlam bir yöntemdir.'],
                    ['q' => 'İzmir\'de kamera uzaktan izleme kurulumu için yardım alabilir miyim?', 'a' => 'Evet, TürkTeknik olarak İzmir\'de P2P, DDNS ve port yönlendirme yapılandırması yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'kamera',
                'ctaRoute'   => 'services.camera',
            ],

            'nvr-dvr-entegrasyonu' => [
                'slug'       => 'nvr-dvr-entegrasyonu',
                'category'   => 'kamera',
                'title'      => 'NVR/DVR Kurulumu ve Sistem Entegrasyonu',
                'seoTitle'   => 'NVR DVR Kurulumu ve Kamera Entegrasyonu İzmir | TürkTeknik',
                'seoDesc'    => 'İzmir\'de NVR (IP kamera) ve DVR (analog kamera) kurulumu, hard disk montajı, kamera entegrasyonu ve hareket algılama ayarları. Destek: 0546 911 80 61.',
                'keywords'   => 'nvr kurulumu izmir, dvr kurulumu izmir, kamera kayıt cihazı, ip kamera entegrasyonu, güvenlik kamerası sistemi kurulumu izmir',
                'icon'       => 'fas fa-hdd',
                'color'      => 'indigo',
                'intro'      => 'NVR (Network Video Recorder) IP kameralarda, DVR (Digital Video Recorder) ise analog/AHD kameralarda kullanılan kayıt cihazlarıdır. Doğru kurulum ve entegrasyon, güvenlik sisteminizin kesintisiz ve güvenilir çalışmasını sağlar.',
                'sections'   => [
                    [
                        'heading' => '1. Doğru Cihaz Seçimi — NVR mi DVR mi?',
                        'content' => 'Yeni kurulumlar için NVR + IP kamera tercih edilir; daha yüksek çözünürlük (4K), esnek yerleşim ve PoE (kablo üzerinden güç) avantajı sağlar. Mevcut koaksiyel kablo altyapısı varsa DVR + AHD kamera daha ekonomiktir.',
                        'tips'    => ['4 kamera için 8 kanallı NVR/DVR alın; ileride genişleme imkânı bırakın.', 'H.265 codec destekli cihazlar aynı kalitede daha az disk alanı kullanır.'],
                    ],
                    [
                        'heading' => '2. Hard Disk Montajı ve Kayıt Ayarları',
                        'content' => 'Güvenlik sistemleri için özel üretilmiş HDD\'leri kullanın (WD Purple, Seagate SkyHawk). NVR/DVR içine HDD\'yi montajlayın; arayüzden formatlar ve kayıt kapasitesi hesaplaması yapın. Döngüsel kayıt (overwrite) etkinleştirin; disk dolduğunda en eski kayıtların üzerine yazar.',
                        'tips'    => ['1080p, 15 fps, H.265 ile 4 kameralık sistem için ~1 TB ≈ 30 gün kayıt saklar.', 'NAS veya bulut yedekleme eklemek kritik görüntüleri korur.'],
                    ],
                    [
                        'heading' => '3. IP Kamera Entegrasyonu (NVR)',
                        'content' => 'PoE NVR\'da kamerayı doğrudan PoE portuna bağlayın; otomatik keşfedilir. PoE switch üzerinden bağlantıda kameranın NVR ile aynı subnet\'te olduğunu doğrulayın. ONVIF protokolü farklı marka kamera-NVR uyumluluğunu sağlar.',
                        'tips'    => ['Kamera şifresini mutlaka değiştirin; varsayılan şifreli cihazlar siber saldırıya açıktır.', 'Kamera çözünürlüğünü NVR\'ın desteklediği maksimum değerde çalıştırın.'],
                    ],
                    [
                        'heading' => '4. Hareket Algılama ve Alarm Bildirimleri',
                        'content' => 'Her kanal için hareket algılama bölgesi çizin (kapı önü, pencere vb.). Hassasiyeti aşırı yüksek ayarlamayın; rüzgarda sallanan ağaç veya ışık değişimleri sahte alarm tetikler. E-posta bildirimi veya uygulama push bildirimini etkinleştirin.',
                        'tips'    => ['Yapay zeka (AI) destekli NVR\'lar insan/araç tespiti yaparak sahte alarmlara karşı daha iyidir.', 'Alarm çıkış rölesini harici siren veya kapı kilidine bağlayabilirsiniz.'],
                    ],
                ],
                'faqs'       => [
                    ['q' => 'Kaç günlük kayıt için kaç TB HDD gerekir?', 'a' => '4 kameralı 1080p sistem için yaklaşık olarak: 7 gün = 250 GB, 15 gün = 500 GB, 30 gün = 1 TB (H.265, 15 fps, ortalama hareket). Hesap için üretici\'nin kayıt hesaplayıcılarını kullanın.'],
                    ['q' => 'DVR kamerasını NVR\'a bağlayabilir miyim?', 'a' => 'Hayır, doğrudan bağlanamazsınız. Analog kameranızı video encoder ile IP\'ye dönüştürüp NVR\'a bağlayabilirsiniz, ancak bu genellikle maliyet açısından verimsizdir.'],
                    ['q' => 'İzmir\'de NVR/DVR kurulumu ve kamera entegrasyonu için destek var mı?', 'a' => 'TürkTeknik olarak İzmir\'de NVR/DVR kurulumu, HDD montajı ve kamera entegrasyonu yapıyoruz. 0546 911 80 61\'i arayın.'],
                ],
                'ctaService' => 'kamera',
                'ctaRoute'   => 'services.camera',
            ],
        ];
    }

    /**
     * Rehberler ana liste sayfası.
     */
    public function index(): Response
    {
        $all = $this->allGuides();

        // Kategorilere ayır
        $categories = [
            'internet' => ['label' => 'İnternet & Modem', 'icon' => 'fas fa-wifi', 'color' => 'blue'],
            'uydu'     => ['label' => 'Uydu & Çanak Anten', 'icon' => 'fas fa-satellite-dish', 'color' => 'emerald'],
            'kamera'   => ['label' => 'Güvenlik Kameraları', 'icon' => 'fas fa-video', 'color' => 'indigo'],
        ];

        $grouped = [];
        foreach ($categories as $catKey => $catMeta) {
            $grouped[$catKey] = [
                'label' => $catMeta['label'],
                'icon'  => $catMeta['icon'],
                'color' => $catMeta['color'],
                'guides' => [],
            ];
        }
        foreach ($all as $guide) {
            $grouped[$guide['category']]['guides'][] = [
                'slug'    => $guide['slug'],
                'title'   => $guide['title'],
                'icon'    => $guide['icon'],
                'color'   => $guide['color'],
                'seoDesc' => $guide['seoDesc'],
            ];
        }

        return Inertia::render('GuidesIndex', [
            'grouped' => array_values($grouped),
        ]);
    }

    /**
     * Tekil rehber sayfası.
     */
    public function show(string $slug): Response|\Illuminate\Http\RedirectResponse
    {
        $all   = $this->allGuides();
        $slug  = strtolower(trim($slug));

        if (! array_key_exists($slug, $all)) {
            abort(404);
        }

        $guide = $all[$slug];

        // Related: aynı kategoriden diğer rehberler (maks 4)
        $related = array_values(
            array_filter($all, fn($g) => $g['category'] === $guide['category'] && $g['slug'] !== $slug)
        );
        $related = array_slice($related, 0, 4);
        $related = array_map(fn($g) => ['slug' => $g['slug'], 'title' => $g['title'], 'icon' => $g['icon'], 'color' => $g['color']], $related);

        return Inertia::render('GuideDetail', [
            'guide'   => $guide,
            'related' => $related,
        ]);
    }

    /**
     * Tüm rehber slug listesi — SitemapController için.
     */
    public function getSlugs(): array
    {
        return array_keys($this->allGuides());
    }
}
