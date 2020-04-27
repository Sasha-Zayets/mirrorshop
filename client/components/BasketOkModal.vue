<template>
    <div :class="['basket-modal', {'basket-modal--show': showModal}]" @click="clickBackground($event)">
        <div class="basket-modal__container">
            <burger-button 
                :open="true"
                @toggle="closeModal"
                class="basket-modal__close"></burger-button>
            <h2 class="basket-modal__title">
                {{ $t('basket-ok-title') }}
                <br/>
                {{ $t('basket-ok-sub-title') }}
            </h2>
            <div class="basket-modal__description">
                <span class="basket-modal__content">
                    {{ $t('basket-ok-description') }}
                </span>
            </div>
            <button @click="closeModal" class="basket-modal__button">
                OK
            </button>
        </div>
    </div>
</template>

<script>
import BurgerButton from '@/components/BurgerButton';

export default {
    props: {
        showModal: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        closeModal(event) {
            this.$emit('closeModal', false);
        },
        clickBackground(event) {
            const hasClickBackground = event.target.classList.contains('basket-modal--show');

            if(hasClickBackground) {
                this.closeModal();
            }
        }
    },
    components: {
        BurgerButton
    }
}
</script>

<style lang="scss">
@import "~assets/sass/variables";

$basket: '.basket-modal';
.basket-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 0;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    transition: all .3s;
    
    &--show {
        z-index: 22;
        opacity: 1;
        transform: none;
        #{$basket} {
            &__close {
                transition-delay: 1s;
                opacity: 1;
                right: 20px;
            }
            &__title {
                transition-delay: .3s;
                transform: none;
                opacity: 1;
            }
            &__description {
                transition-delay: .6s;
                transform: none;
                opacity: 1;
            }
            &__container {
                transform: none;
            }
        }
    }
    &__close {
        background-color: transparent;
        position: absolute;
        top: 20px;
        right: 0;
        opacity: 0;
        transition: all .3s;
    }
    &__container {
        width: 100%;
        padding: 40px 15px 45px 15px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        z-index: 2;
        max-width: 255px;
        margin: 0 auto;
        background-image: url('~static/images/other/basket-modal.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        transform: translateY(-100%);
        &:before {
            content: "";
            width: 100%;
            height: 100%;
            background-color: transparent;
            position: absolute;
            left: 0;
            top: 0;
            z-index: -1;
            border: 10px solid rgba(255, 255, 255, 0.6);
        }
    }
    &__title {
        font-weight: bold;
        font-size: 18px;
        line-height: 20px;
        text-align: center;
        text-transform: uppercase;
        color: #446DBC;
        position: relative;
        min-height: 105px;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translateX(-100%);
        opacity: 0;
        background-image: url('~static/images/other/title-basket-bg.svg');
        background-size: cover;
        background-repeat: no-repeat;
        transition: all .3s;
        // &:before {
        //     content: "";
        //     position: absolute;
        //     left: 0;
        //     top: 0;
        //     bottom: 0;
        //     width: 100%;
        //     z-index: -1;
        // }
    }
    &__content {
        max-width: 170px;
    }
    &__description {
        font-size: 16px;
        line-height: 18px;
        text-align: center;
        color: #424141;
        position: relative;
        padding: 29px 23px 20px 23px;
        min-height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 32px;
        transform: translateY(100%);
        opacity: 0;
        transition: all .3s;
        background-image: url('~static/images/other/description-bg.svg');
        background-size: cover;
        background-repeat: no-repeat;
        // &:before {
        //     content: "";
        //     position: absolute;
        //     left: 0;
        //     top: 0;
        //     bottom: 0;
        //     right: 0;
        //     z-index: -1;
        // }
    }
    &__button {
        height: 30px;
        padding: 0 30px;
        display: flex;
        align-items: center;
        background: #FF6E05;
        box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 17px;
        color: #FFFFFF;
        width: fit-content;
        margin: 0 auto;
    }
}

@media #{$screen-min-340} {
    .basket-modal {
        &__title {
            margin-bottom: 10px;
        }
    }
}

@media #{$screen-min-360} {
    .basket-modal {
        &__title {
            font-size: 22px;
            line-height: 26px;
            min-height: 138px;
        }
        &__description {
            font-size: 18px;
            line-height: 20px;
        }
        &__content {
            max-width: 200px;
        }
        &__container {
            max-width: 320px;
        }
    }
}

@media #{$screen-min-576} {
    .basket-modal {
        &__title {
            max-width: 260px;
            width: 100%;
            min-height: 145px;
        }
        &__description {
            max-width: 260px;
            width: 100%;
            margin-left: auto;
            margin-top: - 30px;
        }
        &__button {
            height: 35px;
            padding: 0 35px;
            font-size: 18px;
        }
        &__container {
            max-width: 450px;
            padding-left: 30px;
            padding-right: 30px;
        }
    }
}

@media #{$screen-min-768} {
    .basket-modal {
        &--show {
            #{$basket} {
                &__close {
                    right: 40px;
                }
            }
        }
        &__close {
            display: block;
            top: 40px;
        }
        &__container {
            max-width: 520px;
            padding: 32px 90px 42px 85px;
        }
        &__title,
        &__description {
            max-width: 225px;
        }
        &__title {
            font-size: 16px;
            line-height: 20px;
            min-height: 105px;
        }
        &__description {
            font-size: 14px;
            line-height: 17px;
            padding-top: 0;
            padding-bottom: 0;
            min-height: 100px;
        }
    }
}

@media #{$screen-min-1200} {
    .basket-modal {
        &__container {
            background-image: url('~static/images/other/basket-modal-md.jpg');
        }
        &__title,
        &__description {
            max-width: 280px;
        }
        &__title {
            font-size: 22px;
            line-height: 26px;
            min-height: 135px;
        }
        &__description {
            font-size: 16px;
            line-height: 18px;
            display: flex;
            align-items: center;
            min-height: 123px;
        }
        &__content {
            max-width: 100%;
        }
        &__close {
            cursor: pointer;
        }
        &__button {
            cursor: pointer;
            transition: all .3s;
            &:hover {
                background-color:#F94D03;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
            }
        }
    }
}

@media #{$screen-min-1560} {
    .basket-modal {
        &__container {
            max-width: 700px;
            padding-top: 45px;
            padding-bottom: 45px;
        }
        &__title {
            font-size: 24px;
            line-height: 28px;
            min-height: 140px;
        }
        &__description {
            font-size: 18px;
            line-height: 20px;
            min-height: 133px;
        }
        &__title,
        &__description {
            max-width: 300px;
        }
    }
}
</style>