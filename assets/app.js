import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import {createApp} from 'vue'
import App from './vue/App.vue'
import axios from 'axios'
import router from './vue/router'

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.mount('#app');