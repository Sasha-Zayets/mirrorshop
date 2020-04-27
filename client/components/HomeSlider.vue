<template>
    <section class="home-slider">
        <div class="home-slider__container swiper-container" ref="slider">
            <div class="swiper-wrapper">
                <div 
                    v-for="(slide, index) in dataSlider"
                    :key="index"
                    class="swiper-slide home-slider__item">
                    <div class="slider-cart home-slider__cart">
                        <h2 v-if="slide"
                            class="slider-cart__title">
                            {{ slide[`title_${locale}`] }}
                        </h2>
                        <p 
                            v-if="slide[`description_${locale}`]"
                            class="slider-cart__description">
                            {{ slide[`description_${locale}`] }}
                        </p>
                    </div>
                    <picture class="home-slider__frame">
                        <source :srcset="slide.desktop_webp" media="(min-width: 992px)" type="image/webp">
                        <source :srcset="slide.desktop" media="(min-width: 992px)">
                        <source :srcset="slide.tablet_webp" media="(min-width: 768px)" type="image/webp">
                        <source :srcset="slide.tablet" media="(min-width: 768px)">
                        <source :srcset="slide.mobile_webp" media="(min-width: 768px)">
                        <img :src="slide.mobile" class="home-slider__image" alt="">
                    </picture>
                </div>
            </div>
            <div class="swiper-pagination" ref="pagination"></div>
        </div>
    </section>
</template>

<script>
import Swiper from 'swiper';

export default {
    props: {
        dataSlider: {
            type: Array,
            default: []
        },
        locale: {
            type: String
        }
    },
    mounted () {
        const slider = this.$refs.slider;
        const pagination = this.$refs.pagination;

        const swiper = new Swiper(slider, {
            speed: 500,
            pagination: {
                el: pagination,
                clickable: true,
            }
        });
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

$home: '.home-slider';
.home-slider {
    margin-bottom: 40px;
    &__item {
        height: 325px;
        width: 100%;
        position: relative;
        &.swiper-slide-active {
            #{$home} {
                &__cart {
                    transition-delay: .3s;
                    opacity: 1;
                    transform: translateX(-50%) translateY(0%);
                }
                &__frame {
                    opacity: 1;
                }
            }
        }
    }
    &__image {
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    &__cart {
        position: absolute;
        top: 50px;
        left: 50%;
        transform: translateX(-50%) translateY(50%);
        opacity: 0;
        width: calc(100% - 30px);
        transition: all .5s;
    }
    &__frame {
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: all .5s;
    }

    .swiper-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 4px;
        margin-top: 20px;
        &-bullet {
            display: block;
            width: 15px;
            height: 2px;
            background-color: #A8A9AA;
            margin-right: 10px;
            transition: all .3s;
            &:last-child {
                margin-right: 0;
            }
        }
        &-bullet-active {
            height: 3px;
            background-color: #343536; 
        }
    }
}

.slider-cart {
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
    padding: 30px 5px 25px 15px;
    &:before, &:after {
        content: "";
        position: absolute;
        background: rgba(255, 255, 255, 0.5);
        
    }
    &:before {
        bottom: -60px;
        right: 30px;
        width: 10px;
        height: 100px;
    }
    &:after {
        width: 100px;
        height: 10px;
        right: 0;
        bottom: -25px;
    }
    &__title {
        font-weight: 800;
        font-size: 20px;
        line-height: 24px;
        text-align: center;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    &__description {
        font-size: 14px;
        line-height: 17px;
        text-align: center;
        letter-spacing: 0.05em;
        color: #424141;
    }
}

@media #{$screen-min-360} {
    .home-slider {
        &__item {
            height: 350px;
        }
    }
    .slider-cart {
        &__title {
            font-size: 22px;
            margin-bottom: 15px;
        }
        &__description {
            font-size: 16px;
        }
    }
}

@media #{$screen-min-576} {
    .home-slider {
        &__cart {
            width: 70%;
        }
    }
}

@media #{$screen-min-768} {
    .home-slider {
        &__item {
            display: flex;
            justify-content: flex-end;
            &.swiper-slide-active {
                 #{$home} {
                    &__cart {
                        transform: translateX(0%) translateY(-50%);
                    }
                 }
            }
        }
        &__frame {
            width: 70%;
        }
        &__cart {
            max-width: 350px;
            width: 100%;
            top: 50%;
            left: 15px;
            transform: translateX(0%);
        }

        .swiper-pagination {
            width: 30%;
            position: relative;
            top: -5px;
            margin-top: 0;
            z-index: 2;
        }
    }

    .slider-cart {
        &:before {
            height: 130px;
            right: -23px;
            bottom: -53px;
        }
        &:after {
            width: 130px;
            bottom: -23px;
            right: -53px;
        }
    }
}

@media #{$screen-min-992} {
    .home-slider {
        margin-bottom: 87px;
        &__item {
            height: 400px;
        }
        &__frame {
            width: 60%;
        }
        &__cart {
            max-width: 500px;
            width: 100%;
        }
        .swiper-pagination {
            width: 40%;
            height: 16px;
            top: -15px;
            .swiper-pagination-bullet {
                width: 24px;
                height: 16px;
                position: relative;
                background-color: transparent;
                &:before {
                    content: "";
                    position: absolute;
                    top: 50%;
                    left: 0;
                    transform: translateY(-50%);
                    height: 3px;
                    width: 100%;
                    background-color: #A8A9AA;
                    transition: all .3s;
                }
                &.swiper-pagination-bullet-active {
                    &:before {
                        background-color: $black;
                        height: 4px;
                    }
                }
            }
        }
    }
    .slider-cart {
        padding: 25px 20px 20px 60px;
        &__title {
            font-size: 30px;
            line-height: 34px;
            text-align: left;
        }
        &__description {
            font-size: 18px;
            line-height: 22px;
            text-align: left;
        }
    }
}

@media #{$screen-min-1200} {
    .home-slider {
        &__item {
            height: 450px;
        }
        &__frame {
            max-width: 882px;
            width: 100%;
        }
        &__cart {
            max-width: 580px;
        }
        .swiper-pagination {
            &-bullet {
                cursor: pointer;
                width: 20px;
                height: 2px;
            }
        }
    }

    .slider-cart {
        padding: 27px 20px 30px 70px;
        &__title {
            font-weight: 800;
            font-size: 36px;
            line-height: 44px;
            margin-bottom: 20px;
        }
    }
}

@media #{$screen-min-1560} {
    .home-slider {
        &__container {
            max-width: 1530px;
        }
        &__frame {
            max-width: 1060px; 
        }
    }
}
</style>