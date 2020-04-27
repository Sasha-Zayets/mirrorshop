<template>
  <v-card class="mb-3">
    <v-card-title class="subtitle-2 pb-0">Телефони</v-card-title>
    <v-card-text>
      <v-row>
		<v-col
			v-for="(phone, index) in phones"
			:key="phone.id"
			cols="6"
			lg="6"
			class="mb-2"
		  >
		  <v-row>
			  	<v-col 
				  	cols="1" 
					align-self="center">
					<v-icon 
						color="red" 
						size="16"
						@click="removeNumber(index)">fa-times</v-icon>
				</v-col>
				<v-col cols="5">
					<v-text-field
						label="Номер телефону"
						v-model="phone.number"
						v-mask="`+38 (###) ###-##-##`"
						placeholder="+38 (___) ___-__-__"
						:rules="[rules.phoneValidate]"
						return-masked-value
						></v-text-field>
				</v-col>
				<v-col cols="6" align-self="center">
					<div class="box-social">
						<check-social 
							v-model="phone.is_viber"
							icon="icon-viber"
							:id="phone.id" 
							class="box-social__item"
							></check-social>
						<check-social 
							v-model="phone.is_telegram"
							icon="icon-telegram"
							:id="phone.id + '1'" 
							class="box-social__item"
							></check-social>
						<v-text-field
							v-if="phone.is_telegram"
							v-model="phone.telegram_name"
							placeholder="Telegram"
							prefix="@"
						></v-text-field>
					</div>
				</v-col>
		  </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
import { mask } from 'vue-the-mask';
import CheckSocial from '../UI/CheckSocial';
export default {
	props: {
		phones: {
			type: Array,
			default: []
		}
	},
	data: () => ({
		rules: {
			phoneValidate: value => {
				const pattern = /^(\+{0,})(\d{0,})\s([(]{1}\d{1,3}[)]{0,}){0,}(\s?\d+|\+\d{2,3}\s{1}\d+|\d+){1}[\s|-]?\d+([\s|-]?\d+){1,2}(\s){0,}$/
				return pattern.test(value) || 'Не коректний номер телефону'
			},
		},
		viber: true,
		telegram: false,
	}),
	methods: {
		removeNumber(index) {
			this.$store.commit('removePhone', index);
		}
	},
	components: {
		CheckSocial
	},
	directives: {
		mask
	}
}
</script>
