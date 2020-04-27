<template>
    <draggable 
        v-model="mySliderList" 
        class="row" 
        group="slider" 
        @start="drag=true" >
		<!-- Картки слайдеру -->
		<v-col 
            cols="12" 
            lg="3"
            md="4"
            sm="6"
            v-for="(slide, index) in mySliderList" 
            :key="index">
			<v-card
                class="mx-auto"
                >
                <v-img
                    class="white--text align-end"
                    height="150"
                    min-height="150"
                    :src="slide.desktop" />

                <v-card-subtitle class="pb-0">{{ slide.title_ua }}</v-card-subtitle>

                <v-card-text class="text--primary">
                    <div>{{ slide.description_ua }}</div>
                </v-card-text>

                <v-card-actions>
                    <v-btn
                    color="orange"
                    text
                    @click="edit(slide)"
                    >
                    Редагувати
                    </v-btn>
                </v-card-actions>
			</v-card>
		</v-col>
	</draggable>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    props: {
        sliderList: {
            type: Array,
            default: () => [],
        }
    },
    computed: {
        mySliderList: {
            get() {
                return this.sliderList;
            },
            set(v) {
                this.$emit('dragable', v);
            }
        }
    },
    data: () => ({
        drag: true,
    }),
    methods: {
        edit(slide) {
            this.$emit('edit', slide);
        }
    },
    components: {
        draggable
    }
}
</script>