<template>
  <v-card class="mb-3">
    <v-card-title class="subtitle-2 pb-0">Адреса</v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="6" lg="6">
          <v-text-field
            v-model="location.ru"
            label="Адреса RU"
            name="location_ru"
            class="mb-2"
            required
            prepend-icon="fas fa-map-marker-alt"
          ></v-text-field>

          <v-text-field
            v-model="location.ua"
            label="Адреса UA"
            name="location_ua"
            class="mb-2"
            required
            prepend-icon="fas fa-map-marker-alt"
          ></v-text-field>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>

    export default {
        props: {
            location: {
                type: Object,
                default: function () {
                    return {
                        ru: 'ru',
                        ua: 'ua',
                    }
                }
            }
        },

        methods: {

        }
    }
</script>
