<template>
    <div 
        :class="['stages-item', {'stages-item--reverse': reverse}]">
         <picture class="stages-item__frame">
            <source :srcset="require(`../../assets/images/stages/${data.imgMd}.jpg`)" media="(min-width: 768px)">
             <source 
                :srcset="require(`../../assets/images/stages/${data.imgMd_webp}.webp`)" 
                media="(min-width: 768px)"
                type="image/webp">
              <source 
                :srcset="require(`../../assets/images/stages/${data.imgSm_webp}.webp`)" 
                type="image/webp">
            <img :src="require(`../../assets/images/stages/${data.imgSm}.jpg`)" class="stages-item__image" alt="">
        </picture>
        <div class="stages-item__cart cart">
            <time class="cart__date">
                {{ data.date }}
            </time>
            <div class="cart__header">
                <svg-icon :name="icon" class="cart__icon"></svg-icon>
                <h2 class="cart__title">{{ data.title }}</h2>
            </div>
            <div class="cart__content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        reverse: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
        },
        data: {
            type: [Object, String],
            default: () => {}
        }
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

$stage: '.stages-item';
.stages-item {
    &__frame {
        width: 100%;
        height: 163px;
        display: block;
        z-index: 2;
    }
    &__image {
        width: 100%;
        object-fit: cover;
    }
    &__cart {
        width: calc(100% - 16px);
        margin: -10px auto 0 auto;
        z-index: 2;
        position: relative;
        transform: rotateY(90deg);
        transition: all .3s;
        &--active {
            transform: none;
        }
    }
}

.cart {
    background: #FFFFFF;
    box-sizing: border-box;
    box-shadow: 0px 20px 25px rgba(0, 0, 0, 0.15);
    padding: 16px 22px 42px 24px;
    &__date {
        font-size: 12px;
        line-height: 15px;
        color: #A8A9AA;
        display: block;
        text-align: right;
        margin-bottom: 20px;
    }
    &__header {
        display: flex;
        margin-bottom: 22px;
    }
    &__icon {
        width: 46px;
        min-width: 46px;
        height: 46px;
        margin-top: auto;
        margin-right: 15px;
    }
    &__title {
        font-size: 18px;
        font-weight: bold;
        line-height: 22px;
        text-transform: uppercase;
    }
    &__content {
        font-size: 14px;
        line-height: 17px;
        color: #424141;
        p {
            margin-bottom: 15px;
            &:last-child {
                margin-bottom: 0;
            }
        }
    }
}

@media #{$screen-min-360} {
    .cart {
        &__date {
            font-size: 14px;
            line-height: 17px;
        }
        &__icon {
            width: 50px;
            min-width: 50px;
            height: 50px;
        }
        &__title {
            font-size: 20px;
            line-height: 24px;
        }
        &__content {
            font-size: 16px;
            line-height: 19px;
        }
    }
}

@media #{$screen-min-768} {
    .stages-item {
        display: flex;
        justify-content: center;
        align-items: center;
        &--reverse {
            flex-direction: row-reverse;
        }
        &__frame {
            height: 250px;
            width: 50%;
        }
        &__image {
            height: 100%;
        }
        &__cart {
            margin: 0;
            width: 50%;
        }
    }

    .cart {
        position: relative;
        padding: 15px 25px 20px 25px;
        &__icon {
            width: 55px;
            min-width: 55px;
            height: 55px;
        }
        &__title {
            font-size: 20px;
            line-height: 24px;
        }
        &__content {
            font-size: 14px;
            line-height: 17px;
        }
        &__date {
            margin-bottom: 0;
            position: absolute;
            bottom: -25px;
            left: 55%;
            transform: translateX(-50%);
        }
    }
}

@media #{$screen-min-992} {
    .stages-item {
        &__frame {
            position: relative;
            height: 320px;
        }
        &__cart {
            min-width: 420px;
            z-index: 2;
        }
    }

    .cart {
        &__date {
            bottom: -35px;
        }
    }
}

@media #{$screen-min-1200} {
    .stages-item {
         &__frame {
            width: 570px;
            min-width: 570px;
        }
        &__cart {
            max-width: 470px;
            width: 100%;
            min-width: 470px;
            left: -70px;
        }
        &--reverse {
            #{$stage} {
                &__cart {
                    left: initial;
                    right: -70px;
                }
            }
        }
    }

    .cart {
        padding: 15px 10px 25px 45px;
        &__content {
            padding-right: 40px;
        }
    }
}

@media #{$screen-min-1560} {
    .stages-item {
        &__frame {
            width: 670px;
            min-width: 670px;
        }
        &__cart {
            min-width: 550px;
        }
    }

    .cart {
        padding: 25px 20px 30px 50px;
        &__title {
            font-size: 22px;
            line-height: 26px;
        }
        &__content {
            font-size: 16px;
            line-height: 20px;
        }
    }
}
</style>