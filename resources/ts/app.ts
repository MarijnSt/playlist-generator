// noinspection JSIgnoredPromiseFromCall

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import PrimeVue from 'primevue/config';
import { createPinia } from 'pinia';

// PrimeVue Imports
import 'primevue/resources/themes/aura-light-green/theme.css'
import 'primeicons/primeicons.css';
import Ripple from 'primevue/ripple';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import InputNumber from 'primevue/inputnumber';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Chip from 'primevue/chip';

// import styling
import "@scss/index.scss";

// state management
const pinia = createPinia();

createInertiaApp({
    resolve: (name) => resolvePageComponent<DefineComponent>(
        `./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue') as DefineComponent
    ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .use(PrimeVue, { ripple: true })
            .directive('ripple', Ripple)
            .component('DataTable', DataTable)
            .component('Column', Column)
            .component('ColumnGroup', ColumnGroup)
            .component('Row', Row)
            .component('InputNumber', InputNumber)
            .component('InputText', InputText)
            .component('Button', Button)
            .component('Chip', Chip)
            .mount(el)
    },
})
