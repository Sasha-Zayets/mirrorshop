<template>
    <div class="phone-item">
        <a 
            :href="`tel:${phone.number}`" 
            class="phone-item__link"
            target="__blank">
            {{ phone.number }}
        </a>
        <div class="phone-item__social">
            <a href=""  
                :data-mob="`viber://add?number=${phone.number}`"
                :data-desc="`viber://chat?number=${phone.number}`"
                target="__blank"
                ref="viber">
                <svg-icon 
                v-if="phone.is_viber"
                name="viber" 
                class="phone-item__icon" />
            </a>
            <a :href="`tg://resolve?domain=${phone.number}`" target="__blank">
                <svg-icon 
                    v-if="phone.is_telegram"
                    name="telegram" 
                    class="phone-item__icon" />
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        phone: {
            type: Object
        }
    },
    mounted() {
        if(process.client) {
            const widthWindow = window.innerWidth;
            const hrefViber = this.$refs.viber;
            let dataAttibute;

            if(widthWindow < 768) {
                dataAttibute = hrefViber.getAttribute('data-mob');
            } else {
                dataAttibute = hrefViber.getAttribute('data-desc');
            }
            
            hrefViber.setAttribute('href', dataAttibute);
        }
    }
}
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.phone-item {
    display: flex;
    align-items: center;
    &__link {
        font-size: 16px;
        line-height: 20px;
        color: $black;
        text-transform: lowercase;
        min-width: 176px;
        margin-right: 5px;
    }
    &__social {
        position: relative;
        top: -5px;
    }
    &__icon {
        width: 18px;
        height: 18px;
        margin-right: 5px;
        &:last-child {
            margin-right: 0;
        }
    }
}

@media #{$screen-min-360} {
    .phone-item {
        &__link {
            font-size: 18px;
        }
        &__icon {
            width: 22px;
            height: 22px;
        }
    }
}

@media #{$screen-min-768} {
    .phone-item {
        &__link {
            font-size: 16px;
            min-width: 165px;
        }
        &__icon {
            width: 18px;
            height: 18px;
        }
    }
}

@media #{$screen-min-1200} {
    .phone-item {
        &__link {
            pointer-events: none;
        }
        &__icon {
            cursor: pointer;
            transition: all .3s;
            &:hover {
                transform: scale(1.03);
            }
        }
    }
}

@media #{$screen-min-1560} {
    .phone-item {
        &__link {
            font-size: 18px;
        }
        &__icon {
            width: 20px;
            height: 20px;
        }
    }
}
</style>