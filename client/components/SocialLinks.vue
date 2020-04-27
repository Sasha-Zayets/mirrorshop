<template>
    <div class="social-list">
        <template v-if="!iconsShow">

            <a 
                v-for="phone in socialLink"
                :key="phone.id"
                :href="phone.link"
                target="__blank"
                :class="[
                    'social-list__link',
                    `social-list__link--${phone.name}`
                ]">
                {{ phone.name }}
            </a>
        </template>
        <template v-else>
            <a 
                v-for="phone in socialLink"
                :key="phone.id"
                :href="phone.link"
                target="__blank"
                class="social-list__link-icon">
                <svg-icon 
                    v-if="phone.name !== 'instagram'"
                    :name="phone.name" 
                    class="social-list__icon" />
                <img 
                    v-else 
                    src="@/static/images/sprite-original/instagram.svg" 
                    class="social-list__icon" 
                    alt="instagram link">
            </a> 
        </template>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    props: {
        iconsShow: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        ...mapGetters(['socialLink'])
    },
    mouted () {
        console.log(this.socialLink)
    }
}
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.social-list {
    display: flex;
    flex-direction: column;
    align-items: center;
    &__link {
        font-size: 16px;
        text-transform: lowercase;
        margin-bottom: 20px;
        &:last-child {
            margin-bottom: 0;
        }

        &--facebook {
            color: $blue-light;
        }
        &--instagram {
            background: linear-gradient(45deg, #FFC107 9.15%, #F44336 50.57%, #9C27B0 90.03%);
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        &--youtube {
            color: $red;
        }
    }
    &__link-icon {
        margin-right: 20px;
        &:last-child {
            margin-right: 0;
        }
    }
    &__icon {
        width: 30px;
        height: 30px;
    }
}

@media #{$screen-min-360} {
    .social-list {
        &__link {
            font-size: 18px;
        }
        &__icon {
            width: 35px;
            height: 35px;
        }
    }
}

@media #{$screen-min-768} {
    .social-list {
        flex-direction: row;
        &__link {
            font-size: 16px;
            margin-bottom: 0;
            margin-right: 10px;
            &:last-child {
                margin-right: 0;
            }
        }
    }
}

@media #{$screen-min-992} {
    .social-list {
        &__link {
            margin-right: 20px;
        }
    }
}


@media #{$screen-min-1200} {
    .social-list {
        &__link {
            cursor: pointer;
            position: relative;
            margin-right: 35px;
            &:before, &:after {
                content: "";
                position: absolute;
                height: 1px;
                width: 46px;
                background: #CDDBDD;
                opacity: 0;
                transition: all .3s;
            }
            &:before {
                left: 0;
                top: -5px;
                transform: translateX(-100%);
            }

            &:after {
                right: 0;
                bottom: -5px;
                transform: translateX(100%);
            }

            &:hover {
                &:before, &:after {
                    opacity: 1;
                    transform: none;
                }
            }
        }
        &__icon {
            width: 40px;
            height: 40px;
            cursor: pointer;
            transition: all .5s;
            &:hover {
                transform: rotateY(360deg) scale(1.15);
            }
        }
    }
}

@media #{$screen-min-1560} {
    .social-list {
        &__link {
            font-size: 18px;
        }
    }
}
</style> 