<template>
    <button 
        :class="[
            'button',
            buttonClass,
        ]"
        v-on="$listeners">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        theme: {
            type: String,
            default: 'yellow'
        },
        size: {
            type: String,
            default: 'normal'
        }
    },
    computed: {
        buttonClass () {
            return `button--${this.theme} button--${this.size}`
        }
    }
}
</script>

<style lang="scss" scoped>

.button {
    display: flex;
    align-items: center;
    justify-content: center;
    text-transform: uppercase;
    transition: all .3s;
    
    &--yellow {
        background: #FF6E05;
        color: white;
        &:hover {
            background: #F94D03;
        }
    }

    &--blue {
        background: #75B0F4;
        color: white;
    }

    &--normal {
        height: 63px;
        font-size: 18px;
        font-weight: bold;
        line-height: 22px;
        padding: 0 50px;
    }

    &--small {
        height: 26px;
        font-size: 14px;
        line-height: 17px;
    }
}
</style>