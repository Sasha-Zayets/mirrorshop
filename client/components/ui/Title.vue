<template>
    <div class="title">
        <h2 class="title__value">
            <slot></slot>
        </h2>
        <span 
            v-if="hasDescription"
            class="title__description">
            <slot name="description"></slot>
        </span>
    </div>
</template>

<script>
export default {
    name: "Title",
    computed: {
        hasDescription () {
            return !!this.$slots['description'];
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.title {
    position: relative;
    z-index: 3;
    &__value {
        font-weight: 800;
        font-size: 24px;
        line-height: 29px;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
        color: $black;
    }
    &__description {
        font-size: 14px;
        line-height: 17px;
        color: #A8A9AA;
        display: block;
        text-align: right;
        margin-top: 13px;
    }
}

@media #{$screen-min-576} {
    .title {
        &__value {
            font-size: 28px;
            line-height: 32px;
        }
        &__description {
            font-size: 16px;
        }
    }
}

@media #{$screen-min-768} {
    .title {
        width: fit-content;
        &__description {
            text-align: center;
        }
    }
}

@media #{$screen-min-1200} {
    .title {
        &__value {
            font-size: 32px;
            line-height: 39px;
        }
    }
}

@media #{$screen-min-1560} {
    .title {
        &__value {
            font-size: 34px;
        }
        &__description {
            font-size: 18px;
        }
    }
}
</style>
