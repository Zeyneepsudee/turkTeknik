<script setup lang="ts">
import TopBar from '@/components/TopBar.vue';
import SEO from '@/components/SEO.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    phone: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        onSuccess: () => {
            form.reset();
        },
        onError: () => {},
    });
};
</script>

<template>
    <div class="min-h-screen bg-slate-950 flex flex-col pt-24 pb-16 px-4">
        <TopBar />
        <SEO
          title="İletişim | TürkTeknik İzmir Teknik Servis"
          description="TürkTeknik ile iletişime geçin. İzmir'de internet, kamera, uydu ve elektrik teknik servis için bize ulaşın. ☎ 0546 911 80 61 | WhatsApp iletişim mevcut."
          url="https://turkteknik.com.tr/iletisim"
          keywords="türkteknik iletişim, izmir teknik servis iletişim, türkteknik telefon, teknik servis izmir ara"
        />

        <div class="max-w-5xl mx-auto w-full flex-grow">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sky-500/10 border border-sky-500/20 text-sky-400 text-xs font-bold uppercase tracking-widest mb-5">
                    <i class="fas fa-headset"></i> Bize Ulaşın
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    İletişime <span class="text-sky-400">Geçin</span>
                </h1>
                <p class="text-slate-400 text-lg max-w-xl mx-auto">
                    Sorularınız veya servis talepleriniz için bize yazın ya da doğrudan arayın.
                </p>
            </div>

            <div class="grid md:grid-cols-5 gap-8">
                <!-- Contact Info Cards -->
                <div class="md:col-span-2 flex flex-col gap-4">
                    <a href="tel:+905469118061"
                       class="flex items-center gap-4 p-5 rounded-2xl border border-slate-800 bg-slate-900 hover:border-sky-500/40 hover:bg-slate-800 transition-all duration-200 group">
                        <div class="w-11 h-11 rounded-xl bg-sky-500/10 border border-sky-500/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-phone text-sky-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-0.5">Telefon</p>
                            <p class="text-white font-bold text-base">0546 911 80 61</p>
                        </div>
                    </a>

                    <a href="https://wa.me/905469118061" target="_blank" rel="noopener noreferrer"
                       class="flex items-center gap-4 p-5 rounded-2xl border border-slate-800 bg-slate-900 hover:border-emerald-500/40 hover:bg-slate-800 transition-all duration-200 group">
                        <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fab fa-whatsapp text-emerald-400 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-0.5">WhatsApp</p>
                            <p class="text-white font-bold text-base">Mesaj Gönder</p>
                        </div>
                    </a>

                    <div class="flex items-center gap-4 p-5 rounded-2xl border border-slate-800 bg-slate-900">
                        <div class="w-11 h-11 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-0.5">Hizmet Bölgesi</p>
                            <p class="text-white font-bold text-base">İzmir ve çevresi</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-5 rounded-2xl border border-slate-800 bg-slate-900">
                        <div class="w-11 h-11 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-amber-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold mb-0.5">Çalışma Saatleri</p>
                            <p class="text-white font-bold text-base">7/24 Destek</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="md:col-span-3">
                    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8">
                        <!-- Success message -->
                        <div v-if="form.wasSuccessful" class="mb-6 flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm font-semibold">
                            <i class="fas fa-check-circle"></i> Mesajınız başarıyla gönderildi! En kısa sürede dönüş yapacağız.
                        </div>

                        <form @submit.prevent="submit" class="space-y-5">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-semibold text-slate-300">
                                    Adınız Soyadınız <span class="text-sky-400">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <i class="fas fa-user text-sm"></i>
                                    </span>
                                    <input
                                        id="name"
                                        type="text"
                                        v-model="form.name"
                                        required
                                        placeholder="Adınız ve soyadınız"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500/50 transition-colors"
                                        :class="form.errors.name ? 'border-red-500' : ''"
                                    />
                                </div>
                                <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-slate-300">
                                    E-posta Adresiniz <span class="text-sky-400">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <i class="fas fa-envelope text-sm"></i>
                                    </span>
                                    <input
                                        id="email"
                                        type="email"
                                        v-model="form.email"
                                        required
                                        placeholder="ornek@email.com"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500/50 transition-colors"
                                        :class="form.errors.email ? 'border-red-500' : ''"
                                    />
                                </div>
                                <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
                            </div>

                            <!-- Phone -->
                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-semibold text-slate-300">
                                    Telefon <span class="text-slate-600 font-normal text-xs">(opsiyonel)</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <i class="fas fa-phone text-sm"></i>
                                    </span>
                                    <input
                                        id="phone"
                                        type="tel"
                                        v-model="form.phone"
                                        placeholder="05XX XXX XX XX"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500/50 transition-colors"
                                    />
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="space-y-2">
                                <label for="message" class="block text-sm font-semibold text-slate-300">
                                    Mesajınız <span class="text-sky-400">*</span>
                                </label>
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    required
                                    rows="5"
                                    placeholder="Sorununuzu veya talebinizi kısaca açıklayın..."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500/50 transition-colors resize-none"
                                    :class="form.errors.message ? 'border-red-500' : ''"
                                ></textarea>
                                <p v-if="form.errors.message" class="text-red-400 text-xs mt-1">{{ form.errors.message }}</p>
                            </div>

                            <!-- Submit -->
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full py-3.5 rounded-xl font-bold text-sm text-white transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
                                style="background: linear-gradient(135deg, #0ea5e9, #0055cc); box-shadow: 0 0 20px rgba(14,165,233,0.25);"
                            >
                                <i v-if="form.processing" class="fas fa-spinner fa-spin"></i>
                                <i v-else class="fas fa-paper-plane text-xs"></i>
                                {{ form.processing ? 'Gönderiliyor...' : 'Mesajı Gönder' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- WhatsApp Floating Button -->
        <a href="https://wa.me/905469118061" target="_blank" rel="noopener noreferrer"
           class="float-wp fixed bottom-6 right-6 text-white w-11 h-11 rounded-full flex items-center justify-center z-50"
           aria-label="WhatsApp ile İletişim">
          <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>
</template>

<style scoped>
@keyframes float-bob {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-6px); }
}
.float-wp { background:#25d366; box-shadow:0 4px 16px rgba(37,211,102,0.5); animation: float-bob 2.8s ease-in-out infinite; }
.float-wp:hover { animation: none; transform:scale(1.12); box-shadow:0 6px 24px rgba(37,211,102,0.65); }
</style>