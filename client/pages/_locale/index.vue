<template>
    <Index />
</template>

<script>
import { mapActions } from 'vuex';
import Index from '../index';
export default {
    created() {
        const locale = this.$route.params.locale;
        this.setLocale(locale);
    },
    async asyncData ({store}) {
        await store.dispatch('getSlides');
    },
    methods: {
        ...mapActions([
            'setLocale'
        ])
    },
    components: {
        Index
    }
}
</script>