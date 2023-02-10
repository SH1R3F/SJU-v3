module.exports = {
    methods: {
        /**
         * Translate the given key.
         */
        __(key, replace = {}) {
            var translation = this.$page.props.language && this.$page.props.language[key] ? this.$page.props.language[key] : key;

            Object.keys(replace).forEach(function (key) {
                translation = translation.replace(':' + key, replace[key]);
            });

            return translation;
        },
        queryParams(...args) {
            let queryString = this.$page.url;

            if (queryString.indexOf('?') === -1) {
                return {};
            }

            queryString = queryString.substring(queryString.indexOf('?') + 1);
            return Object.assign(Object.fromEntries(new URLSearchParams(queryString)), ...args);
        },
        arabic_date(date) {
            return new Date(date).toLocaleDateString(`${this?.$page?.props?.locale == 'en' ? 'en-UK' : 'ar-EG'}-u-nu-latn`, { weekday: 'long', year: 'numeric', month: 'short', day: 'numeric' });
        },
    },
};
