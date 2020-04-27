<template>
    <div class="choise-count">
        <svg-icon name="count-icon" class="choise-count__icon" :style="`fill: ${color};`"></svg-icon>
        <span class="choise-count__number" :style="`color: ${color};`">
            <slot></slot>
        </span>
    </div>
</template>

<script>
export default {
    props: {
        color: {
            type: String,
            required: true
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.choise-count {
    display: flex;
    align-items: center;
    &__icon {
        width: 32px;
        height: 30px;
        margin-right: 10px;
    }
    &__number {
        font-weight: 800;
        font-size: 32px;
        line-height: 39px;
        text-transform: uppercase;
    }
}

@media #{$screen-min-360} {
    .choise-count {
        &__icon {
            width: 34px;
            height: 32px;
        }
        &__number {
            font-size: 34px;
        }
    }
}
</style>