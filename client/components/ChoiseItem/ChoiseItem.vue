<template>
    <div class="choise-item">
        <SliderTitle 
            v-if="title"
            :class="[
                'choise-item__title',
                classDirection('title')
            ]">
            {{ title }}
        </SliderTitle>

        <ChoiseCount
            :color="colorCount"
            :class="[
                'choise-item__count',
                classDirection('count')
            ]">{{ count }}</ChoiseCount>

        <div 
            :class="[
                'choise-item__wrapper',
                classDirection('wrapper')
            ]">
            <Slider
                :direction="direction"
                :images="dataAdvantages.images" 
                class="choise-item__slider"/>

            <div class="advantages choise-item__advantages">
                <AdvantagesItem
                    v-for="(item, index) in dataAdvantages.data"
                    :key="index"
                    :nameIcon="item.nameIcon" 
                    class="advantages__list-item">
                    <template>
                        {{ item.title }}
                    </template>
                    <template #description>
                        {{ item.description }}
                    </template>
                </AdvantagesItem>

                <svg-icon name="advantages-bg" class="advantages__bg"></svg-icon>
                <svg-icon name="advantages-bg--md" class="advantages__bg advantages__bg--medium"></svg-icon>
            </div>
        </div>
    </div>
</template>

<script>
import SliderTitle from '../SliderTitle';
import ChoiseCount from './ChoiseCount';
import AdvantagesItem from './AdvantagesItem';
import Slider from '../Slider';

export default {
    props: {
        direction: {
            type: String,
            default: 'left'
        },
        count: {
            type: String,
            default: ''
        },
        colorCount: {
            type: String
        },
        dataAdvantages: {
            type: [Array, Object, String],
            default: () => []
        },
        title: {
            type: String,
            default: ''
        }
    },
    methods: {
        classDirection (nameClass) {
            if (this.direction === 'right') {
                return `choise-item__${nameClass}--right`;
            }
        }
    },
    components: {
        SliderTitle,
        AdvantagesItem,
        Slider,
        ChoiseCount
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';

$item: '.choise-item ';
$ad: '.advantages';

.choise-item {
    display: flex;
    flex-direction: column;
    &__count {
        order: 1;
        justify-content: flex-end;
        margin-bottom: -14px;
        z-index: 4;
        &--right {
            justify-content: flex-start;
        }
    }
    &__title {
        order: 2;
        margin-bottom: -20px;
        z-index: 3;
        &--right {
            margin-left: auto;
            text-align: right;
        }
    }
    &__wrapper {
        order: 3;
        &--right {
            #{$ad} {
                &__bg {
                    transform: translateY(-50%) rotate(180deg);
                }
            }
        }
    }
    &__slider {
        margin-bottom: 25px;
    }
}

.advantages {
    position: relative;
    &__bg {
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: calc(100% + 30px);
        min-height: 440px;
        z-index: -1;
        &--medium {
            display: none;
        }
    }
    &__list-item {
        margin-bottom: 16px;
        position: relative;
        &:last-child {
            margin-bottom: 0;
        }
        &:nth-child(even) {
            padding-left: 50px;
        }
        opacity: 0;
        transition: all .3s;
        &:nth-child(even) {
            transition-delay: .3s;
            transform: translateX(-100%);
        }
        &:nth-child(odd) {
            transition-delay: .6s;
            transform: translateX(100%);
        }
    }

    &--active {
        #{$ad} {
            &__list-item {
                opacity: 1;
                transform: none;
            }
        }
    }
}

@media #{$screen-min-360} {
    .advantages {
        &__bg {
            min-height: 480px;
        }
        &__list-item {
            margin-bottom: 20px;
        }
    }
}

@media #{$screen-min-420} {
    .advantages {
        &__bg {
            min-height: 520px;
        }
    }
}

@media #{$screen-min-460} {
    .advantages {
        &__bg {
            min-height: 580px;
        }
    }
}

@media #{$screen-min-576} {
    .choise-item {
        position: relative;
        &__wrapper {
            &--right {
                #{$ad} {
                    &__bg--medium {
                        transform: rotate(180deg);
                    }
                }
            }
        }
    }

    .advantages {
        position: initial;
        &__bg {
            display: none;
            &--medium {
                display: block;
                top: initial;
                bottom: -40px;
                min-height: 420px;
                transform: none;
            }
        }
    }
}

@media #{$screen-min-768} {
    .choise-item {
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        &__title {
            margin-left: auto;
            margin-right: 40px;
            margin-bottom: 0;

            &--right {
                margin-left: 0;
                margin-right: auto;
            }
        }
        &__count {
            position: absolute;
            bottom: 15px;
            right: 15px;
            margin-bottom: 0;
            &--right {
                right: initial;
            }
        }
        &__wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            &--right {
                flex-direction: row-reverse;

                #{$item} {
                    &__advantages {
                        margin-left: 0;
                        margin-right: 10px;
                    }
                }
            }
        }
        &__slider {
            width: 450px;
        }
        &__advantages {
            width: calc(100% - 460px);
            margin-left: 10px;
        }
    }
}

@media #{$screen-min-992} {
    .choise-item {
        &__title {
            transform: translateY(calc(100% + 25px));
        }
        &__slider {
            width: 550px;
        }
        &__advantages {
            width: calc(100% - 580px);
            margin-left: 30px;
        }
        &__wrapper {
            &--right {
                #{$item} {
                    &__advantages {
                        margin-right: 30px;
                    }
                }
                #{$ad} {
                    &__bg--medium {
                        right: initial;
                        left: 0;
                    }
                }
            }
        }
    }

    .advantages {
        &__bg {
            &--medium {
                width: 740.5px;
                height: 472.5px;
                left: initial;
                right: 0;
                bottom: 60px;
            }
        }
    }
}

@media #{$screen-min-1200} {
    .choise-item {
        // &__title {
        //     transform: translateY(calc(100% + 45px));
        //     margin-bottom: 20px;
        // }
        &__slider {
            width: 650px;
        }
        &__advantages {
            margin-left: 60px;
            width: calc(100% - 710px);
            max-width: 400px;
        }
        &__wrapper {
            &--right {
                #{$item} {
                    &__advantages {
                        margin-left: 75px;
                        margin-right: auto;
                    }
                }
            }
        }
    }
}

@media #{$screen-min-1560} {
    .choise-item {
        &__slider {
            width: 750px;
        }
        &__advantages {
            margin-left: 60px;
            width: calc(100% - 810px);
            max-width: 500px;
        }
        &__title {
            margin-right: 20%;
        }
    }

    .advantages {
        &__list-item {
            margin-bottom: 25px;
        }
        &__bg--medium {
            width: 1000px;
            height: 700px;
            bottom: -38px;
        }
    }
}
</style>