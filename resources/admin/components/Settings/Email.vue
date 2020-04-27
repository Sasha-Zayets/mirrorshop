<template>
  <v-card class="mb-3">
    <v-card-title class="subtitle-2 pb-0">E-mail</v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="6" lg="6">
          <v-text-field
            v-model="emailValue"
            :rules="emailRules"
            label="E-mail"
            class="mb-2"
            required
            prepend-icon="far fa-envelope"
          ></v-text-field>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>

export default {
  props: {
    email: {
      type: String,
      default: '',
    }
  },
  data: () => ({
    emailRules: [
      v => !!v || 'Поле не може бути порожнім',
      v => /.+@.+\..+/.test(v) || 'E-mail неправильний',
    ],
  }),
  computed: {
    emailValue: {
      get() {
        return this.email;
      },
      set(v) {
        const { commit } = this.$store;
        commit('setEmail', v);
      }
    }
  },
}
</script>
