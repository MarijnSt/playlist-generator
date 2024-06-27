// noinspection JSIgnoredPromiseFromCall

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import PrimeVue from 'primevue/config';
import { createPinia } from 'pinia';

// Import PrimeVue UI Theme
import 'primevue/resources/themes/aura-light-green/theme.css'
// Import Prime Icons
import 'primeicons/primeicons.css';
// Import PrimeVue UI Components
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

// import styling
import "@scss/index.scss";

// state management
const pinia = createPinia();

const appName = window.document.getElementsByTagName('title')[0]?.innerText || '';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent<DefineComponent>(
        `./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue') as DefineComponent
    ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .use(PrimeVue)
            .component('DataTable', DataTable)
            .component('Column', Column)
            .component('ColumnGroup', ColumnGroup)
            .component('Row', Row)
            .component('InputNumber', InputNumber)
            .component('InputText', InputText)
            .component('Button', Button)
            .mount(el)
    },
})
