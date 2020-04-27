<template>
    <div class="advantages-item">
        <svg-icon :name="nameIcon" class="advantages-item__icon"></svg-icon>
        <div class="advantages-item__content">
            <h2 class="advantages-item__title">
                <slot></slot>
            </h2>
            <p class="advantages-item__description">
                <slot name="description"></slot>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        nameIcon: {
            type: String
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.advantages-item {
    display: flex;
    align-items: center;
    &__icon {
        width: 33px;
        min-width: 33px;
        height: 45px;
        margin-right: 16px;
    }
    &__title {
        font-weight: bold;
        font-size: 14px;
        line-height: 17px;
        text-transform: uppercase;
        color: #000000;
        margin-bottom: 10px;
    }
    &__description {
        font-size: 12px;
        line-height: 15px;
        color: #424141;
    }
} 

@media #{$screen-min-360} {
    .advantages-item {
        &__icon {
            width: 36px;
            min-width: 36px;
            height: 48px;
        }
        &__title {
            font-size: 16px;
        }
        &__description {
            font-size: 14px;
        }
    }
}

@media #{$screen-min-1560} {
    .advantages-item {
        &__icon {
            width: 40px;
            min-width: 40px;
            height: 50px;
            margin-right: 20px;
        }
        &__title {
            font-size: 18px;
        }
        &__description {
            font-size: 16px;
            line-height: 18px;
        }
    }
}
</style>