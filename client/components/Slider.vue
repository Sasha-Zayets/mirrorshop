<template>
    <div 
        :class="[
            'slider', 
            'swiper-container',
            {'slider--right': direction === 'right'}
        ]" 
        ref="slider" 
        :dir="direction === 'left' ? 'rtl': ''">
        <div class="swiper-wrapper">
            <div 
                class="slider__item swiper-slide" 
                v-for="(item, index) in images"
                :key="index"
                @click="nextSlide">
                <picture class="slider__frame">
                    <source :srcset="require(`../assets/images/sliders/${item.name_webp}.webp`)" type="image/webp">
                    <img :src="require(`../assets/images/sliders/${item.name}.jpg`)" alt="">
                </picture>
            </div>
        </div>
        <div class="swiper-pagination" ref="pagination"></div>
    </div>
</template>

<script>
import Swiper from 'swiper';

export default {
    props: {
        direction: {
            type: String,
            default: 'left'
        },
        images: {
            type: Array,
            default: () => []
        }
    },
    mounted () {
        const slider = this.$refs.slider;
        const direction = this.direction;
        const pagination = this.$refs.pagination;

        this.swiper = new Swiper(slider, {
            loop: true,
            watchOverflow: true,
            slidesPerView: 1,
            swipeHandler: '.swiper-wrapper',
            allowTouchMove: true,
            reverseDirection: direction === 'left' ? true : false,
            pagination: {
                el: pagination,
                clickable: true,
            },
            breakpoints: {
                768: {
                    // allowTouchMove: false,
                }
            }
        });
    },
    methods: {
        nextSlide() {
            // this.swiper.slideNext((item) => {
            //     conso
            // });
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

$slider: '.slider';
.slider {
    width: 100%;
    height: w(320, 320);
    padding-left: w(70, 320);
    padding-bottom: 20px;
    opacity: 0;
    .swiper-wrapper {
        display: flex;
        align-items: center;
    }
    &.swiper-container-initialized {
        opacity: 1;
    }
    &__item {
        display: flex;
        align-items: center;
        transition: all .3s;
        &.swiper-slide-active {
            z-index: 3;
        }
        &.swiper-slide-next {
            z-index: 2;
            transform: scale(0.85) translateX(w(190, 320));
        }
        &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
            transform: scale(0.7) translateX(w(482, 320));
            z-index: 1;
        }
    }
    &__frame {
        border: 10px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        overflow: hidden;
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    &--right {
        padding-left: initial !important;
        padding-right: w(70, 320);

        #{$slider} {
            &__item {
                &.swiper-slide-next {
                    transform: scale(0.85) translateX(w(-190, 320));
                }
                &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                    transform: scale(0.7) translateX(w(-482, 320));
                }
            }
        }

        .swiper-pagination {
            left: initial !important;
            right: 0 !important;
        }
    }

    .swiper-pagination {
        height: 12px;
        display: flex;
        align-items: center;
        position: absolute;
        z-index: 4;
        bottom: 0;
        left: 0;
        .swiper-pagination-bullet {
            position: relative;
            height: 100%;
            width: 12px;
            margin-right: 10px;
            cursor: pointer;
            outline: none;
            &:focus, &:active {
                outline: none;
            }
            &:before {
                content: "";
                height: 2px;
                width: 100%;
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                background-color: #A8A9AA;
                transition: all .3s;
            }
            &-active {
                width: 16px;
                &:before {
                    background-color: $black;
                }
            }
        }
    }
}


@media #{$screen-min-360} {
    .slider {
        padding-left: w(87, 360);
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(w(210, 360));
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(w(527, 360));
            }
        }

        &--right {
            padding-right: w(87, 360);

            #{$slider} {
                &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(w(-210, 360));
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(w(-527, 360));
                    }
                }
            }
        }
    }
}

@media #{$screen-min-576} {
    .slider {
        padding-left: 150px;
        height: 400px;
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(320px);
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(817px);
            }
        }

        &--right {
            padding-right: 150px;

            #{$slider} {
                &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(-320px);
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(-817px);
                    }
                }
            }
        } 
    }
}  

@media #{$screen-min-768} {
    .slider {
        padding-left: 100px;
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(310px);
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(783px);
            }
        }

        &--right {
            padding-right: 100px;

            #{$slider} {
                &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(-310px);
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(-783px);
                    }
                }
            }
        }
    }
}

@media #{$screen-min-992} {
    .slider {
        height: 500px;
        padding-left: 150px;
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(340px);
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(844px);
            }
        }

        &--right {
            padding-right: 150px;

            #{$slider} {
                &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(-340px);
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(-844px);
                    }
                }
            }
        }
    }
}

@media #{$screen-min-1200} {
    .slider {
        margin: 0;
        height: 600px;
        padding-left: 213px;
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(350px);
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(905px);
            }

        }
        &__frame {
            img {
                object-fit: contain;
            }
        }

        &--right {
            padding-right: 213px;

            #{$slider} {
                 &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(-350px);
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(-905px);
                    }
                }
            }
        }
    }
}

@media #{$screen-min-1560} {
    .slider {
        &__frame {
            img {
                object-fit: cover;
            }
        }
        &__item {
            &.swiper-slide-next  {
                transform: scale(0.85) translateX(455px);
            }
            &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                transform: scale(0.7) translateX(1168px);
            }
        }

        &--right {
            #{$slider} {
                &__item {
                    &.swiper-slide-next  {
                        transform: scale(0.85) translateX(-455px);
                    }
                    &.swiper-slide:not(.swiper-slide-next):not(.swiper-slide-active) {
                        transform: scale(0.7) translateX(-1168px);
                    }
                }
            }
        }
    }
}
</style>