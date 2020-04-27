<template>
    <div class="address">
        <div class="address__item">
            <h2 class="address__name">
                {{ $t('address-title') }}
            </h2>
            <div class="address__value">
                {{ address[locale] }}
            </div>
        </div>
        <div class="address__item">
            <h2 class="address__name">
                {{ $t('address-time') }}
            </h2>
            <div class="address__time-work time-work">
                <div class="time-work__item">
                    <span class="time-work__day">
                        Пн
                    </span>
                    <strong class="time-work__value" v-if="workTime['monday'].holiday === true">
                        {{ $t('holiday') }}
                    </strong>
                    <strong class="time-work__value" v-else>
                        {{ workTime['monday'].from }}
                    </strong>
                </div>
                <div class="time-work__item">
                    <span class="time-work__day">
                        Вт-Пт
                    </span>
                    <strong class="time-work__value" v-if="workTime['weekdays'].holiday === true">
                        {{ $t('holiday') }}
                    </strong>
                     <strong class="time-work__value" v-else>
                        {{  `${workTime['weekdays'].from}-${workTime['weekdays'].to}` }}
                    </strong>
                </div>
                <div class="time-work__item">
                    <span class="time-work__day">
                        Сб
                    </span>
                    <strong class="time-work__value" v-if="workTime['saturday'].holiday === true">
                        {{ $t('holiday') }}
                    </strong>
                     <strong class="time-work__value" v-else>
                        {{  `${workTime['saturday'].from}-${workTime['saturday'].to}` }}
                    </strong>
                </div>
                <div class="time-work__item">
                    <span class="time-work__day">
                        Нд
                    </span>
                    <strong class="time-work__value" v-if="workTime['sunday'].holiday === true">
                        {{ $t('holiday') }}
                    </strong>
                    <strong class="time-work__value" v-else>
                        {{  `${workTime['sunday'].from}-${workTime['sunday'].to}` }}
                    </strong>
                </div>
            </div>
            <a 
                :href="`mailto:${emailContact}`" 
                class="address__name address__name--link">
                {{ emailContact }}
            </a>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters([
            'emailContact', 
            'address', 
            'workTime',
            'locale'
        ])
    }
}
</script>