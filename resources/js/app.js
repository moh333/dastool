require('./bootstrap');

import Vue from 'vue';

import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';

Vue.use(ZiggyVue, Ziggy);


import * as Sentry from "@sentry/vue";
import { Integrations } from "@sentry/tracing";

Sentry.init({
    Vue,
    dsn: process.env.MIX_SENTRY_VUE_DSN,
    integrations: [new Integrations.BrowserTracing()],

    // Set tracesSampleRate to 1.0 to capture 100%
    // of transactions for performance monitoring.
    // We recommend adjusting this value in production
    tracesSampleRate: 0.0,
    logErrors: true,
});

window.Sentry = Sentry

Vue.prototype.$sentry = Sentry

import { BootstrapVue, BIcon, BIconX } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
Vue.component('BIcon', BIcon)
Vue.component('BIconX', BIconX)

import DirectionsService from './plugins/directions-service'
Vue.use(DirectionsService)


Vue.config.productionTip = false

new Vue({
    el: '#app',
    components: {  }
});
