<template>
    <v-row justify="center">
        <v-dialog v-model="show" persistent max-width="460">
            <v-card>
                <v-card-title class="headline">Ви бажаєте видалити даний слайд?</v-card-title>
                <v-card-text>Після підтвердження видалення відновити слайд буде не можливо!</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary mr-3" @click="close">Скасувати</v-btn>
                    <v-btn color="error" @click="confirm">Видалити</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    props: {
        show: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        close() {
            this.$emit('close', false);
        },
        confirm() {
            this.$emit('confirm');
            this.close();
        }
    }
}
</script>