import { createApp, h } from 'vue';
import { createInertiaApp, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { Link, usePage } from '@inertiajs/inertia-vue3';
import route from 'ziggy-js';
import AdminLayout from './Layouts/Admin/App.vue';
import UserLayout from './Layouts/App.vue';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

createInertiaApp({
    resolve: (name) => {
        const page = require(`./Pages/${name}`).default;
        if (page.layout === undefined) {
            if (name.startsWith('Admin/')) {
                page.layout = AdminLayout;
            } else {
                page.layout = UserLayout;
            }
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('Link', Link)
            .component('Head', Head)
            .component('QuillEditor', QuillEditor)
            .mixin({ methods: { route } })
            .mixin({
                methods: {
                    toastAlert(message) {
                        toast.info(message, {
                            rtl: usePage().props.value.locale == 'ar',
                            position: toast.POSITION.TOP_CENTER,
                            hideProgressBar: true,
                            closeButton: false,
                        });
                    },
                },
            })
            .mixin(require('./mixins'))
            .use(plugin)
            .mount(el);
    },
    title: (title) => {
        // Came from backend as a prop
        const { locale } = usePage().props.value;

        const name = locale === 'ar' ? 'هيئة الصحفيين السعوديين' : "Saudi journalists' association";

        return title ? `${title} - ${name}` : name;
    },
});
InertiaProgress.init({
    color: '#007c42',
});
