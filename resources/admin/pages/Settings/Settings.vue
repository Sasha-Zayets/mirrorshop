<template>
    <div class="settings">
      <div class="headline">Налаштування</div>
      <v-row>
        <v-col cols="12" xl="6" lg="10" md="10">
          <phone :phones="phones"></phone>
          <email :email="email"></email>
          
          <location :location="location"></location>
          <socials :socials="socials"></socials>
          <schedule :schedule="schedule"></schedule>
          
          <v-btn
            :loading="saveLoading"
            :disabled="false"
            color="green"
            class="ma-2 white--text"
            @click="saveSettings"
          >
            <v-icon small left dark>fa-save</v-icon>
            Зберегти
          </v-btn>
        </v-col>
      </v-row>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

import Phone from "../../components/Settings/Phone";
import Email from "../../components/Settings/Email";
import Location from "../../components/Settings/Location";
import Socials from "../../components/Settings/Socials";
import Schedule from "../../components/Settings/Schedule";

export default {
  created () {
    this.fetchSettings();
  },
  methods: {
    ...mapActions([
      'fetchSettings',
      'saveSettings'
    ])
  },
  computed: {
    ...mapGetters([
      'phones', 
      'email', 
      'location', 
      'socials', 
      'schedule', 
      'pageLoading', 
      'saveLoading'
    ]),
  },
  components: {
    Schedule,
    Email, 
    Location, 
    Socials, 
    Phone 
  }
}
</script>

