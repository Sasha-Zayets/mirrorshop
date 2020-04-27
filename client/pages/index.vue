<template>
    <main ref="homePage">
        <home-slider 
            v-if="dataSlider"
            :locale="locale"
            :dataSlider="sliders" />
        
        <section class="choise">
            <div class="container">
                <Title class="choise__title">
                    {{ $t('choise-title') }}
                    <template #description>
                        {{ $t('choise-sub-title') }}
                    </template>
                </Title>

                <ChoiseItem 
                    class="choise__item"
                    colorCount="#86E0ED"
                    :title="$t('choiseOneTitle')"
                    :dataAdvantages="oneChoise[locale]"
                    count="01" />
                <ChoiseItem 
                    class="choise__item" 
                    count="02"
                    :title="$t('choiseTwoTitle')"
                    :dataAdvantages="twoChoise[locale]"
                    colorCount="#446DBC"
                    direction="right" /> 
                <ChoiseItem 
                    class="choise__item"
                    :title="$t('choiseThreeTitle')"
                    colorCount="#75B0F4"
                    :dataAdvantages="threeChoise[locale]"
                    count="03" />
            </div>
        </section>

        <Advices />

        <section class="stages">
            <div class="container">
                <Title class="stages__title">
                    {{ $t('stages-title') }}
                    <template #description>
                        {{ $t('stages-description') }}
                    </template>
                </Title>

                <div class="stages__list">
                    <client-only>
                    <StagesItem 
                        class="stages__item" 
                        :reverse="true" 
                        :data="$t('stages-one')"
                        icon="digital-signature">
                            <p>
                                {{ $t('stages-one.description-one') }}
                            </p>
                            <p>
                                {{ $t('stages-one.description-two') }}
                            </p>
                    </StagesItem>
                    <StagesItem 
                        class="stages__item"
                        :data="$t('stages-two')"
                        icon="miter-saw">
                        <p>
                            {{ $t('stages-two.description-one') }}
                        </p>
                        <p>
                            {{ $t('stages-two.description-two') }}
                        </p>
                    </StagesItem>
                    <StagesItem 
                        class="stages__item"
                        :reverse="true" 
                        :data="$t('stages-three')"
                        icon="boxes">
                        <p>
                            {{ $t('stages-three.description-one') }}
                        </p>
                        <p>
                            {{ $t('stages-three.description-two') }}
                        </p>
                    </StagesItem>
                    </client-only>
                </div>
            </div>
        </section>
        
        <section class="feedback">
            <div class="container">
                <Title class="feedback__title">
                    {{ $t('maps-title') }}
                    <template #description>
                        {{ $t('maps_description') }}
                    </template>
                </Title>

                <div class="feedback__wrapper">
                    <div class="feedback__information">
                        <picture class="feedback__frame" @click="showFrame">
                            <img :src="require('../static/images/other/add.jpg')" class="feedback__image" alt="">
                        </picture>

                        <client-only>
                            <AddressAndWork class="feedback__address" />
                        </client-only>
                    </div>
                    <div class="feedback__maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2523.807624387256!2d25.34996291612074!3d50.76060067951938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472597513d24088d%3A0x2170b65ffacfed91!2z0LLRg9C70LjRhtGPINCa0L7QvdGP0LrRltC90LAsIDI00LAsINCb0YPRhtGM0LosINCS0L7Qu9C40L3RgdGM0LrQsCDQvtCx0LvQsNGB0YLRjCwgNDMwMDA!5e0!3m2!1suk!2sua!4v1583334348936!5m2!1suk!2sua" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                </div>
                <CoolLightBox 
                    :items="items" 
                    :index="index"
                    @close="index = null">
                </CoolLightBox>
            </div>
        </section>
    </main>
</template>

<script>
import { mapGetters } from 'vuex';
import HomeSlider from '../components/HomeSlider';
import Title from '../components/ui/Title';
import ChoiseItem from '../components/ChoiseItem/ChoiseItem';
import Advices from '../components/Advices/Advices';
import StagesItem from '@/components/Stages/StagesItem';
import AddressAndWork from '@/components/AddressAndWork';
import CoolLightBox from 'vue-cool-lightbox';
import 'vue-cool-lightbox/dist/vue-cool-lightbox.min.css';
import { choiseOneData, choiseTwoData, choiseThreeData } from '@/assets/json/choiseOne';

export default {
    data: () => ({
        dataSlider: [],
        oneChoise: [],
        twoChoise: [],
        threeChoise: [],
        isShowFrame: false,
        items: [
            require(`../static/images/other/location.jpg`)
        ],
        index: null,
    }),
    computed: {
        ...mapGetters([
            'locale',
            'sliders'
        ])
    },
    created () {
        this.oneChoise = choiseOneData();
        this.twoChoise = choiseTwoData();
        this.threeChoise = choiseThreeData();
    },
    mounted () {
        console.log('mount');
        this.addActiveClassSection();
    },
    async asyncData ({store}) {
        await store.dispatch('getSlides');
    },
    methods: {
        showFrame() {
            this.index = 0;
        },
        addActiveClassSection() {
            if(process.browser) {
                 window.onNuxtReady((app) => {
                    const main = this.$refs.homePage;
                    const section = main.querySelectorAll('section');
                    let stagesItem = main.querySelectorAll('.stages-item__cart');
                    const titles = document.querySelectorAll('.slider-title'); // Всі заголовки для блоку зі слайдером
                    const advantages = document.querySelectorAll('.advantages');
                    this.heightWindow = document.documentElement.clientHeight; 
                    console.log(this.heightWindow);
                    // Виклик функції з додаванням активного класу
                    const addActive = (position) => {
                        let stagesItem = main.querySelectorAll('.stages-item__cart');
                        this.addActiveElement(titles, position, 'slider-title--active');
                        this.addActiveElement(advantages, position, 'advantages--active');
                        this.addActiveElement(stagesItem, position, 'stages-item__cart--active');
                    };
                    addActive(window.pageYOffset);

                    let scroll;
                    window.addEventListener('scroll', function () {
                        addActive(this.pageYOffset);
                    });
                });
            }
        },
        addActiveElement(elements, windowPosition, className) {
            let position;

            elements.forEach(element => {
                position = this.positionYElement(element);
                if ((windowPosition + this.heightWindow) > position) {
                    element.classList.add(className);
                }
            });
        },
        positionYElement(elem) {
            const box = elem.getBoundingClientRect();

            return box.top + pageYOffset;
        }
    },
    components: {
        HomeSlider,
        Title,
        ChoiseItem,
        Advices,
        StagesItem,
        CoolLightBox,
        AddressAndWork,
    }
}
</script>

<style lang="scss">
@import '~assets/sass/variables';
@import '~assets/sass/pages/home.scss';

</style>
