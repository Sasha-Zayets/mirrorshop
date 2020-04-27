<template>
  <v-card class="mb-3" v-if="schedule">
    <v-card-title class="subtitle-2 pb-0">Розклад</v-card-title>
    <v-card-text>
      <v-row v-if="schedule.monday != undefined">
        <v-col cols="2">
          <v-subheader>Понеділок</v-subheader>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.monday.holiday"
            v-model="schedule.monday.from"
            label="З:"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.monday.holiday"
            v-model="schedule.monday.to"
            label="До:"
          ></v-text-field>
        </v-col>
        <v-col cols="4">
          <v-checkbox
            off-icon="far fa-square"
            on-icon="far fa-check-circle"
            v-model="schedule.monday.holiday"
            :label="`вихідний`"
          ></v-checkbox>
        </v-col>
      </v-row>
      <v-row v-if="schedule.weekdays != undefined">
        <v-col cols="2">
          <v-subheader>Вт-Пт</v-subheader>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.weekdays.holiday"
            v-model="schedule.weekdays.from"
            label="З:"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.weekdays.holiday"
            v-model="schedule.weekdays.to"
            label="До:"
          ></v-text-field>
        </v-col>
        <v-col cols="4">
          <v-checkbox
            off-icon="far fa-square"
            on-icon="far fa-check-circle"
            v-model="schedule.weekdays.holiday"
            :label="`вихідний`"
          ></v-checkbox>
        </v-col>
      </v-row>
      <v-row v-if="schedule.saturday != undefined">
        <v-col cols="2">
          <v-subheader>Субота</v-subheader>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.saturday.holiday"
            v-model="schedule.saturday.from"
            label="З:"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.saturday.holiday"
            v-model="schedule.saturday.to"
            label="До:"
          ></v-text-field>
        </v-col>
        <v-col cols="4">
          <v-checkbox
              off-icon="far fa-square"
              on-icon="far fa-check-circle"
              v-model="schedule.saturday.holiday"
              :label="`вихідний`"
            ></v-checkbox>
        </v-col>
      </v-row>
      <v-row v-if="schedule.sunday != undefined">
        <v-col cols="2">
          <v-subheader>Неділя</v-subheader>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.sunday.holiday"
            v-model="schedule.sunday.from"
            label="З:"
          ></v-text-field>
        </v-col>
        <v-col cols="2">
          <v-text-field
            :disabled="schedule.sunday.holiday"
            v-model="schedule.sunday.to"
            label="До:"
          ></v-text-field>
        </v-col>
        <v-col cols="4">
          <v-checkbox
              off-icon="far fa-square"
              on-icon="far fa-check-circle"
              v-model="schedule.sunday.holiday"
              :label="`вихідний`"
            ></v-checkbox>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
    props: {
        schedule: {
            type: Object,
        }
    }
}
</script>
