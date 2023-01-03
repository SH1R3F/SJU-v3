import { createApp, h } from "vue";
import { createInertiaApp, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import route from "ziggy-js";

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component("Link", Link)
            .component("Head", Head)
            .mixin({ methods: { route } })
            .mixin(require("./translate"))
            .use(plugin)
            .mount(el);
    },
    title: (title) => {
        // Came from backend as a prop
        const { locale } = usePage().props.value;

        const name =
            locale === "ar"
                ? "هيئة الصحفيين السعوديين"
                : "Saudi journalists' association";

        return title ? `${title} - ${name}` : name;
    },
});
InertiaProgress.init();
