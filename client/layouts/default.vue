<template>
    <div class="layout" >
        <header class="header" v-if="show">
            <div class="container">
                <div class="header__wrapper">
                    <Logo class="header__logo" />
                    <BurgerButton @toggle="showContainer" />
                    <div 
                        :class="[
                            'header__container',
                            {'header__container--active': containerShow}
                        ]">
                        <SocialLinks class="header__social-list" />
                        
                        <div class="header__phone">
                            <h2 class="header__title">
                                {{ $t('header-phone-title') }}
                            </h2>

                            <PhoneList class="header__phone-list" />
                        </div>
                        <div class="lang header__lang">
                            <a 
                                v-for="lang in locales" 
                                :href="'/' + lang.title"
                                :key="lang.title"
                                :class="[
                                    'lang__link',
                                    {'lang__link--active': lang.title === locale}
                                ]">{{ lang.title }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <nuxt v-if="show" />

        <footer class="footer" v-if="show">
            <div class="container">
                <Logo class="footer__logo" />
                <div class="footer__wrapper">
                    <picture class="footer__logo-description">
                        <source srcset="@/static/images/footer-descipription.svg" media="(min-width: 768px)">
                        <img src="" alt="">
                    </picture>

                    <PhoneList class="footer__phone-list" />
                    <SocialLinks class="footer__social-list" :iconsShow="true" />
                    
                    <a href="https://webmaestro.com.ua/" target="__blank" class="footer__developer">
                        <picture class="footer__webmaestro">
                            <img src="@/static/images/wm.svg" alt="">
                        </picture>
                        <span class="footer__developer-label">
                            {{ $t('footer-develop-label') }}
                        </span>
                    </a>
                </div>
            </div>
            <div class="footer__copyring">
                {{ year }} © {{ $t('footer-copyring') }}
            </div>
        </footer>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import { loadMessages } from '~/plugins/i18n'
import Logo from '../components/Logo';
import BurgerButton from '../components/BurgerButton';
import PhoneList from '@/components/PhoneList/PhoneList';
import SocialLinks from '../components/SocialLinks';

export default {
    data: () => ({
        containerShow: false,
        show: true
    }),
    mounted() {
        if (process.client) {
            this.secure();
        }
    },
    computed: {
        ...mapGetters([
            'locales', 
            'locale'
        ]),
        year() {
            const date = new Date();
            return date.getFullYear();
        }
    },
    methods: {
        ...mapActions(['setLocale']),
        showContainer (value) {
            this.containerShow = value;
        },
        secure() {
            let value =  prompt('Введіть пароль');
            if(value !== '1111') {
                this.secure();
            } else {
                this.show = true;
                console.log(this.show)
            }
        },
        setLang({ value }) {
            this.setLocale(value);
            loadMessages(value);
            
            const path = value === 'ua' ? '/' : '/' + value;
            this.$router.push(path);
        }
    },
    components: {
        Logo,
        BurgerButton,
        PhoneList,
        SocialLinks
    }
}
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.header {
    padding: 10px 0;
    &__title {
        font-size: 18px;
        font-weight: bold;
        line-height: 20px;
        color: $black;
        text-align: center;
        margin-bottom: 30px;
    }
    &__wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    &__container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: $white;
        padding: 20px 30px;
        display: flex;
        flex-direction: column;
        opacity: 0;
        z-index: -1;
        transform: translateX(-100%);
        transition: all .5s;

        &--active {
            opacity: 1;
            transform: translateX(0%);
            z-index: 10;
        }
    }
    &__phone {
        order: 2;
        margin-bottom: 30px;
    }
    &__phone-list {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    &__social-list {
        order: 3;
    }
    &__lang {
        order: 1;
        margin-bottom: 40px;
    }
}

.lang {
    &__link {
        cursor: pointer;
        font-size: 14px;
        line-height: 17px;
        margin-right: 10px;
        color: $silver;
        text-transform: lowercase;
        &:last-child {
            margin-right: 0;
        }

        &--active {
            color: $black;
        }
    }
}

.footer {
    margin-top: 50px;
    padding-top: 20px;
    background-color: #F9F6F6;
    &__logo {
        width: 272px;
        height: 72px;
        margin-left: auto;
        margin-bottom: 44px;
        position: relative;
        &:before, &:after {
            content: "";
            position: absolute;
            right: -15px;
            height: 10px;
            width: 200px;
            background-color: #CDDBDD;
        }
        &:before {
            top: -3px;
        }
        &:after {
            bottom: -3px;
        }
    }
    &__copyring {
        background: $white;
        text-align: center;
        font-size: 12px;
        line-height: 15px;
        color: #e4e4e4;
        padding: 4px 0;
        border-top: 1px solid #f5f5f5;
    }
    &__phone-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 25px;
    }
    &__social-list {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-bottom: 60px;
    }
    &__developer {
        width: 172px;
        margin: 0 auto 25px auto;
        display: flex;
        flex-direction: column;
        &-label {
            font-size: 8px;
            line-height: 10px;
            color: $black;
            margin-left: 40px;
        }
    }
    &__webmaestro {
        max-width: 210px;
        img {
            width: 100%;
        }
    }
}

@media #{$screen-min-360} {
    .header {
        &__title {
            font-size: 22px;
        }
    }

    .lang {
        &__link {
            font-size: 16px;
        }
    }

    .footer {
        &__developer {
            width: 190px;
            &-label {
                font-size: 10px;
            }
        }
        &__copyring {
            font-size: 14px;
        }
    }
}

@media #{$screen-min-576} {
    .header {
        &__container {
            padding: 30px 40px;
        }
    }

    .footer {
        &__logo {
            margin: 0 0 44px 0;
            display: flex;
            align-items: center;
            &:before, &:after {
                display: block;
                right: initial;
                top: 50%;
                transform: translateY(-50%);
            }
            &:before {
                min-width: 120px;
                width: 120px;
                left: -125px;
            }
            &:after {
                left: calc(100% + 5px);
                bottom: initial;
            }
        }
    }
}

@media #{$screen-min-768} {
    .header {
        padding: 10px 15px 0 15px;
        &__container {
            position: relative;
            opacity: 1;
            z-index: 1;
            transform: none;
            padding: 0;
            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: center;
        }
        &__title {
            display: none;
        }
        &__logo {
            margin-right: 15px;
        }
        &__social-list {
            flex-grow: 2;
            justify-content: center;
            order: 1;
            margin-right: 10px;
        }
        &__phone {
            margin-bottom: 0;
            order: 2;
            margin-right: 10px;
        }
        &__lang {
            order: 3;
            margin-bottom: 0;
        }
    }

    .footer {
        &__logo {
            &:before, &:after {
                position: relative;
                transform: none;
                top: initial;
                left: initial;
            }
            &:before {
                min-width: 70px;
                width: 70px;
                margin-right: 10px;
            }
            &:after {
                min-width: 200px;
                width: 200px;
                margin-left: 10px;
            }
        }
        &__wrapper {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding-bottom: 20px;
        }
        &__logo-description {
            order: 1;
            width: 50%;
            display: flex;
            justify-content: center;
            transform: rotate(-6.86deg);
            margin-bottom: 20px;
            img {
                width: 195px;
                height: 64px;
            }
        }
        &__social-list {
            order: 3;
            width: 50%;
            margin-bottom: 0;
        }
        &__phone-list {
            order: 2;
            width: 50%;
        }
        &__developer {
            margin: 0;
            order: 4;
            width: 50%;
            align-items: center;
        }
    }
}

@media #{$screen-min-992} {
    .header {
        &__phone {
            margin-right: 30px;
        }
    }

    .footer {
        &__wrapper {
            flex-wrap: nowrap;
        }
        &__logo-description, &__phone-list {
            margin-bottom: 0;
        }
        &__phone-list {
            order: 3;
        }
        &__social-list {
            order: 2;
        }
        &__developer {
            padding-right: 20px;
            align-items: flex-end;
        }
    }
}

@media #{$screen-min-1200} {
    .header {
        &__logo {
            min-width: 272px;
            height: 71px;
        }
        &__phone {
            margin-right: 45px;
        }
    }

    .lang {
        &__link {
            font-size: 18px;
            transition: all .3s;
            &:hover {
                color: $black;
            }
        }
    }

    .footer {
        &__copyring {
            font-size: 12px;
        }
    }
}

@media #{$screen-min-1560} {
    .header {
        &__logo {
        }
    }
}
</style>