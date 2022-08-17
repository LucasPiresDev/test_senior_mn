import './bootstrap';
import './flash';
import './config';
import './mobile-check';
import AddScriptPlugin from './plugins/addScripts';
import Validator from './plugins/validator';

window.DEBUG = false;

import Header from './components/HeaderComponent';
import Side from './components/SideComponent';
import Footer from './components/FooterComponent';
import Dashboard from './components/DashboardComponent.vue';
import PageIndex from './components/PageIndexComponent.vue';
import PageCreate from './components/PageCreateComponent.vue';
import PageEdit from './components/PageEditComponent.vue';

import { createApp } from 'vue';

const app = createApp()

app
    .use(Validator)
    .use(AddScriptPlugin)
    .component('app-header', Header)
    .component('app-side', Side)
    .component('app-dashboard', Dashboard)
    .component('app-footer', Footer)
    .component('app-page-index', PageIndex)
    .component('app-page-create', PageCreate)
    .component('app-page-edit', PageEdit)
    .mount('#app')


