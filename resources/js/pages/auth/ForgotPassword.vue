<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 bg-background p-6 md:p-10">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium">Şifremi Unuttum</h1>
                        <p class="text-center text-sm text-muted-foreground">Şifre sıfırlama bağlantısı almak için e-posta adresinizi girin</p>
                    </div>
                </div>

                <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <div class="space-y-6">
                    <form @submit.prevent="submit">
                        <div class="grid gap-2">
                            <Label for="email">E-posta Adresi</Label>
                            <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email" autofocus placeholder="email@example.com" />
                            <InputError :message="form.errors.email" />
                        </div>

                        <div class="my-6 flex items-center justify-start">
                            <Button class="w-full bg-blue-600 hover:bg-blue-700 text-white" :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin mr-2" />
                                Şifre Sıfırlama Bağlantısı Gönder
                            </Button>
                        </div>
                    </form>

                    <div class="space-x-1 text-center text-sm text-muted-foreground">
                        <span>Veya</span>
                        <TextLink :href="route('login')" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">giriş yapın</TextLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
