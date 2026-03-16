<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ServiceRequestController extends Controller
{
    public function create(Request $request)
    {
        // Seçilen servis key ve option ID request query parametrelerinden alınacak
        $serviceKey = $request->query('service');
        $optionId = $request->query('option');

        // Eğer kullanıcı giriş yapmışsa bilgilerini al
        $userData = auth()->check() ? [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'address' => auth()->user()->address,
        ] : [];

        // Seçilen servis tipine uygun ürünleri çek
        $products = [];
        if ($serviceKey) {
            $categoryMap = [
                'camera' => 'kamera',
                'internet' => 'internet',
                'satellite' => 'çanak anten',
                'elektrik' => 'elektrik',
            ];
            $category = $categoryMap[$serviceKey] ?? null;
            if ($category) {
                $products = \App\Models\Product::where('category', $category)->get();
            }
        }

        // Bu bilgileri ServiceRequests/Create sayfasına prop olarak gönderelim
        return Inertia::render('ServiceRequests/Create', [
            'serviceKey' => $serviceKey,
            'optionId' => $optionId,
            'userData' => $userData,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'service_key' => 'nullable|string|in:camera,internet,satellite,elektrik',
            'service_id' => 'nullable|exists:services,id',
            'option_id' => 'nullable|string',
            'other_service_option' => 'required_if:option_id,other|nullable|string|max:255',
            'product_id' => 'nullable|string',
            'other_product_name' => 'required_if:product_id,other|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $serviceKey = $request->service_key;
        if (! $serviceKey && $request->service_id) {
            $service = \App\Models\Service::find($request->service_id);
            if ($service) {
                $categoryMap = [
                    'kamera' => 'camera',
                    'internet' => 'internet',
                    'çanak anten' => 'satellite',
                    'elektrik' => 'elektrik',
                ];
                $serviceKey = $categoryMap[strtolower($service->category)] ?? $service->category;
            }
        }

        $serviceRequest = ServiceRequest::create([
            'user_id' => auth()->id(),
            'service_type' => $serviceKey ?? 'internet', // Fallback to internet
            'service_option' => $request->option_id ?? 'genel',
            'other_service_option' => $request->option_id === 'other' ? $request->other_service_option : null,
            'product_id' => $request->product_id === 'other' ? null : $request->product_id,
            'other_product_name' => $request->product_id === 'other' ? $request->other_product_name : null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        // TODO: WhatsApp entegrasyonu
        // TODO: Email bildirimi

        $successData = [
            'title' => 'Hizmet Talebi Oluşturuldu',
            'message' => 'Talebiniz başarıyla alındı. En kısa sürede sizinle iletişime geçeceğiz.',
            'request_number' => $serviceRequest->request_number,
            'service_type' => $this->getServiceTypeText($request->service_key),
            'service_option' => $this->getServiceOptionText($request->service_key, $request->option_id, $request->other_service_option),
            'request_id' => $serviceRequest->id,
        ];

        if (auth()->check()) {
            return redirect()->route('service-requests.show', $serviceRequest->id)->with('success', $successData);
        } else {
            return redirect()->route('home')->with('success', $successData);
        }
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('user', 'product');

        return Inertia::render('ServiceRequests/Show', [
            'serviceRequest' => $serviceRequest,
        ]);
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        // Yetkilendirme kontrolü yapılabilir, örneğin sadece talebi oluşturan kullanıcı silebilir
        // if ($serviceRequest->user_id !== auth()->id()) {
        //     abort(403); // Yetkisiz erişim hatası
        // }

        $serviceRequest->delete();

        // Silme işleminden sonra kullanıcıyı profil sayfasına yönlendir ve bir mesaj göster
        return redirect()->route('profile')->with('success', 'Servis talebi başarıyla iptal edildi.');
    }

    private function getServiceTypeText($type)
    {
        return match ($type) {
            'camera' => 'Kamera Sistemleri',
            'internet' => 'İnternet Hizmetleri',
            'satellite' => 'Uydu Sistemleri',
            'elektrik' => 'Elektrik Servisi',
            default => 'Bilinmeyen Hizmet'
        };
    }

    private function getServiceOptionText($type, $option, $otherValue = null)
    {
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

        if ($option === 'other') {
            return $otherValue ?? 'Diğer (Belirtilmemiş)';
        }

        return $options[$type][$option] ?? $option;
    }

    public function queryByRequestNumber(Request $request)
    {
        $requestNumber = $request->query('request_number');

        $serviceRequest = null;
        if ($requestNumber) {
            $serviceRequest = ServiceRequest::where('request_number', $requestNumber)->first();
        }

        return Inertia::render('ServiceRequestQuery', [
            'serviceRequest' => $serviceRequest,
        ]);
    }
}
