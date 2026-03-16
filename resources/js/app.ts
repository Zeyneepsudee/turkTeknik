import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';
import { createHead } from '@vueuse/head';
import { MotionPlugin } from '@vueuse/motion';
import AOS from 'aos';
import 'aos/dist/aos.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const head = createHead();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue');
        const pagePath = `./pages/${name}.vue`;

        // Custom resolution for service pages
        if (name === 'services.camera') {
            return resolvePageComponent('./pages/CameraService.vue', pages);
        } else if (name === 'services.internet') {
            return resolvePageComponent('./pages/InternetService.vue', pages);
        } else if (name === 'services.satellite') {
            return resolvePageComponent('./pages/SatelliteService.vue', pages);
        }

        // Default resolution for other pages
        return resolvePageComponent(pagePath, pages);
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(ZiggyVue)
            .use(head)
            .use(MotionPlugin)
            .mount(el);

        // Initialize AOS after app is mounted
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100,
        });

        // Refresh AOS on page changes using Inertia events
        document.addEventListener('inertia:success', () => {
            // Small delay to ensure DOM is updated
            setTimeout(() => {
                AOS.refresh();
            }, 100);
        });
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
