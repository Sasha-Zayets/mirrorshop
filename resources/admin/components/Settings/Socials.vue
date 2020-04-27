<template>
  <v-card class="mb-3">
    <v-card-title class="subtitle-2 pb-0">Соціальні мережі</v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="8" lg="8">
          <v-text-field
            v-for="(item, index) in socials"
            :key="index"
            v-model="item.link"
            :label="item.name | capitalize"
            :name="item.name"
            class="mb-2"
            required
            :prepend-icon="item.iconName"
          >
            <template v-slot:prepend>
              <img :src="`/static/icons/${item.name}.svg`" class="icon-social" alt="">
            </template>
          </v-text-field>
          <!-- item.iconName -->
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>

export default {
  props: {
      socials: {
          type: Array,
      }
  },
  filters: {
    capitalize(value) {
      if (!value) return '';
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  }
}
</script>

<style lang="scss">
.icon-social {
  width: 25px;
  height: 25px;
}
</style>