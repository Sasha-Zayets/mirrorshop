<template>
    <section class="advices">
        <div class="container">
            <div class="advices__wrapper">
                <div class="advices__content">
                    <picture class="advices__faq-icon">
                        <source srcset="@/static/images/other/faq.svg" media="(min-width: 1200px)">
                        <img src="@/static/images/other/faq-icon.png" alt="">
                    </picture>
                    <div class="advices__faq">
                        <h2 class="advices__faq-title">
                            {{ $t('advices-title') }}
                        </h2>
                        <span class="advices__faq-sub-title">
                            {{ $t('advices-description') }}
                        </span>
                    </div>
                    <validation-observer
                        tag="div"
                        ref="form"
                        class="advices__form">
                        <validation-provider 
                            :rules="{required: true}"
                            v-slot="{errors}">
                            <Input
                                :class="[
                                    'advices__input',
                                    {'advices__input--error': errors[0]}
                                ]"
                                iconName="user"
                                v-model="name" 
                                :placeholder="$t('advices-name-input')"/>
                        </validation-provider>
                        <Input
                            :class="[
                                'advices__input',
                                {'advices__input--error': phoneError}
                            ]"
                            :mask="true"
                            maskValue="\+\38 (111) 111-11-11"
                            iconName="phone"
                            v-model="phone" 
                            inputmode="numeric"
                            placeholder="+38 (___) ___-__-__"/>
                        <Button
                            @click="sendForm" 
                            class="advices__form-button">
                            {{ $t('advices-button') }}
                        </Button>
                    </validation-observer>
                </div>
                <div class="advices__frame">
                    <Logo class="advices__logo" />
                    <picture class="advices__frame-block">
                        <img src="@/static/images/other/105-PORTRAIT 1.jpg" class="advices__frame-image" alt="">
                    </picture>
                </div>
            </div>
        </div>

        <basket-ok-modal 
            @closeModal="closeModal"
            :showModal="showModal"></basket-ok-modal>
    </section>
</template>

<script>
import {
  ValidationProvider,
  ValidationObserver
} from 'vee-validate';
import BasketOkModal from '@/components/BasketOkModal';
import Logo from '@/components/Logo';
import { PHONE } from '@/assets/js/constans';
import Button from '@/components/ui/Button';
import Input from '@/components/ui/Input';

export default {
    data: () => ({
        name: '',
        phone: '',
        phoneError: false,
        showModal: false,
    }),
    methods: {
        async sendForm() {
            const validPhone = this.validateNumber();
            const formValid = await this.$refs.form.validate();
            
            if(validPhone && formValid) {
                this.toggleOverflow();
                this.showModal = !this.showModal;
    
                const { name, phone } = this;
                const data = { name, phone };

                this.$store.dispatch('submitForm', data)
                    .then(() => {
                        this.resetForm();
                    });
            }
        },
        validateNumber() {
            const validate = PHONE.test(this.phone);

            if(validate) {
                this.phoneError = false;
                return validate;
            }

            this.phoneError = true;
            return validate;
        },
        closeModal(value) {
            this.showModal = value;
            this.toggleOverflow();
        },
        toggleOverflow() {
            const body = document.querySelector('body');
            body.classList.toggle('overflow');
        },
        resetForm() {
            this.name = '';
            this.phone = '';
            this.$refs.form.reset();
        }
    },
    components: {
        Input,
        Button,
        Logo,
        ValidationObserver,
        ValidationProvider,
        BasketOkModal,
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

.advices {
    padding-top: 20px;
    padding-bottom: 40px;
    &__input {
        border: 1px solid white;
        transition: all .3s;
        &--error {
            border-color: red;
        }
    }
    &__faq {
        padding-left: 20px;
        position: relative;
        &:before {
            content: "";
            position: absolute;
            top: -30px;
            left: 0;
            width: 10px;
            height: 223px;
            background: #CDDBDD;
        }
        &-title {
            font-weight: 800;
            font-size: 18px;
            line-height: 22px;
            text-transform: uppercase;
            color: #FFFFFF;
            text-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
            margin-bottom: 10px;
        }
        &-sub-title {
            display: block;
            font-size: 14px;
            line-height: 17px;
            color: #FFFFFF;
            margin-bottom: 30px;
        }
        &-icon {
            position: absolute;
            top: -50px;
            right: 0px;
            width: 167px;
            height: 100px;
            img {
                max-width: 100%;
            }
        }
    }
    &__content {
        padding: 90px 15px 90px 15px;
        margin: 0 -15px 25px -15px;
        background-image: url('~static/images/sprite-original/faq-bg.svg');
        background-size: cover;
        background-repeat: no-repeat;
        position: relative;
    }
    &__form {
        display: flex;
        flex-direction: column;
        align-items: center;
        &-button {
            max-width: 270px;
            width: 100%;
            padding: 0 20px;
        }
    }
    &__input {
        margin-bottom: 10px;
        width: 200px;
        &:last-child {
            margin-bottom: 20px;
        }
    }
    &__frame {
        position: relative;
        max-width: 285px;
        margin: -80px auto 20px auto;
        &-block {
            width: 100%;
        }
        &-image {
            width: 100%;
        }
    }

    &__logo {
        position: absolute;
        right: -70px;
        bottom: 100px;
        transform: rotate(-90deg);
        width: 270px;
        height: 67px;
    }
}

@media #{$screen-min-360} {
    .advices {
        &__faq {
            &-title {
                font-size: 20px;
                line-height: 24px;
            }
            &-sub-title {
                font-size: 16px;
                line-height: 19px;
            }
        }
        &__input {
            max-width: 240px;
        }
    }
}

@media #{$screen-min-420} {
    .advices {
        &__faq {
            max-width: 360px;
            margin: 0 auto;
        }
    }
}

@media #{$screen-min-768} {
    .advices {
        .container {
            padding: 0 15px;
        }
        &__wrapper {
            background-image: url('~static/images/sprite-original/faq-bg-md.svg');
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            padding: 0 15px;
            position: relative;
        }
        &__content {
            margin: 0 0 25px 0;
            background-image: none;
            padding: 55px 0 60px 0;
            flex-grow: 2;
            position: initial;
        }
        &__frame {
            margin: 0;
        }
        &__faq {
            margin: 0;
            padding: 0;
            max-width: 420px;
            &:before {
                top: -10px;
                left: initial;
                right: 0;
            }
            &-title {
                font-size: 24px;
                line-height: 28px;
            }
            &-icon {
                top: initial;
                right: initial;
                bottom: -37px;
                left: -19px;
                width: 200px;
                height: 130px;
            }
        }
        &__form {
            max-width: 420px;
        }
    }
}

@media #{$screen-min-992} {
    .advices {
        &__faq {
            margin-right: 15px;
            &:before {
                display: block;
            }
        }
        &__content {
            display: flex;
            align-items: center;
            margin-right: 15px;
            padding: 55px 0 30px 0;
            margin-bottom: 0;
        }
        &__form-button {
            min-width: 270px;
        }
    }
}

@media #{$screen-min-1200} {
    .advices {
        &__wrapper {
            padding-left: 30px;
        }
        &__faq {
            max-width: 425px;
            width: 100%;
            margin-right: 75px;
            &:before {
                right: -40px;
            }
        }
        &__faq-title {
            font-size: 28px;
            line-height: 34px;
            margin-bottom: 21px;
        }
        &__faq-sub-title {
            font-size: 14px;
            line-height: 17px;
            max-width: 210px;
            margin-left: auto;
            margin-right: 15px;
        }
        &__faq-icon {
            width: 264px;
            height: 158px;
            display: flex;
            justify-content: center;
            align-items: center;
            left: -15px;
            bottom: -25px;
            transform: rotate(-8deg);
            img {
                width: 100%;
            }
        }
        &__frame {
            margin-right: 40px;
        }
        &__form {
            width: 100%;
        }
    }
}

@media #{$screen-min-1560} {
    .advices {
        background-image: url('~static/images/sprite-original/faq-bg-md.svg');
        background-repeat: no-repeat;
        background-size: cover;
        padding: 0;
        margin: 20px 0 40px 0;

        &__wrapper {
            background-image: none;
        }
        &__faq {
            max-width: 475px;
            margin-right: 100px;
            &:before {
                right: -70px;
            }
        }
        &__faq-title {
            font-size: 32px;
            line-height: 36px;
        }
        &__faq-sub-title {
            max-width: 240px;
            font-size: 16px;
            line-height: 18px;
        }
        &__frame {
            top: 22px;
        }
    }
}
</style>