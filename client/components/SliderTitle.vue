<template>
    <h2 :class="['slider-title', alignClass]">
        <slot></slot>
    </h2>
</template>

<script>
export default {
    props: {
        align: {
            type: String,
            default: 'left'
        }
    },
    computed: {
        alignClass () {
            return `slider-title--${this.align}`
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.slider-title {
    font-size: 20px;
    font-weight: bold;
    line-height: 24px;
    color: black;
    text-transform: uppercase;
    padding: 10px 24px 10px 16px;
    background: rgba(255, 255, 255, 0.68);
    box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
    width: calc(100% - 10px);
    transform: translateY(100%);
    opacity: 0;
    // transition-delay: .3s;
    transition: all .3s;
    &--left {
        text-align: left;
    }
    &--right {
        text-align: right;
    }
    &--center {
        text-align: center;
    }
    &--active {
        transform: none;
        opacity: 1;
    }
}

@media #{$screen-min-360} {
    .slider-title {
        font-size: 22px;
        line-height: 26px;
    }
}

@media #{$screen-min-768} {
    .slider-title {
        max-width: 420px;
    }
}

@media #{$screen-min-992} {
    .slider-title {
        max-width: 600px;
    }
}

@media #{$screen-min-1200} {
    .slider-title {
        font-size: 28px;
        padding: 22px 28px;
        max-width: 670px;
        width: 100%;
    }
}
</style>
