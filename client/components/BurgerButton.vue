<template>
    <button 
        :class="[
            'burger-button',
            {'burger-button--active': toggle}
        ]" 
        @click="toggleButton">
            <svg-icon name="menu-button" v-if="!toggle"/>
            <svg-icon name="menu-button-close" v-else />
    </button>    
</template>

<script>
export default {
    props: {
        open: {
            type: Boolean,
            default: false
        }
    },
    created() {
        this.toggle = this.open;
    },
    data: () => ({
        toggle: false
    }),
    methods: {
        toggleButton () {
            if (this.open) {
                this.$emit('toggle', false);
            } else {
                this.toggle = !this.toggle;
                this.$emit('toggle', this.toggle);
            }
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.burger-button {
    width: 25px;
    height: 25px;
    fill: $black;
    position: relative;
    transition: all .3s;

    .icons {
        width: 100%;
        height: 100%;
    }

    &--active {
        z-index: 11;
        animation: scale 1s ease-in forwards;
    }
} 

@media #{$screen-min-360} {
    .burger-button {
        width: 30px;
        height: 30px;
    }
}

@media #{$screen-min-768} {
    .burger-button {
        display: none;
    }
}

@keyframes scale {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
    100% {
        transform: scale(1);
    }
}
</style>