<template>
    <div class="phone-list">
        <PhoneItem
            v-for="(phone, index) in phoneList"
            :key="index"
            :phone="phone" 
            class="phone-list__item" />
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import PhoneItem from './PhoneItem';

export default {
    computed: {
        ...mapGetters(['phoneList']),
    },
    components: {
        PhoneItem
    }
}
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.phone-list {
    &__item {
        min-width: 233px;
        margin-bottom: 10px;
        &:last-child {
            margin-bottom: 0;
        }
    }
}

@media #{$screen-min-768} {
    .phone-list {
        &__item {
            min-width: 216px;
        }
    }
}
</style>