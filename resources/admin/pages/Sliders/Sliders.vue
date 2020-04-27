<template>
  <div class="sliders">
    <div class="headline mb-3">Слайдери</div>
      <v-btn 
        @click="addNewSlide"
        dark 
        small
        color="primary">
        Додати слайд
        <v-icon dark small class="ml-2">fas fa-plus</v-icon>
      </v-btn>
      <dragable-list 
        v-if="sliders.length > 0"
        :sliderList="sliders" 
        @edit="edit"
        @dragable="savePositionSlide" />

    <v-row justify="center">
      <edit-slider 
        :showModal="dialog"
        :type="typeNew"
        :data="editSlide" 
        @changeData="changeData"
        @editImage="showEditImage" 
        @closeModal="closeEditModal" />
      <edit-image
        :type="typeNew"
        :showModal="dialog2" 
        :currentOption="currentOption"
        :typeImage="typeImages"
        :imageData="editSlide"
        @closeImage="dialog2 = false"
        @uploadImage="uploadImage" />
    </v-row>
  </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
import VueCropper from 'vue-cropperjs';
import { VueDraggableDirective } from 'vue-draggable';
import 'cropperjs/dist/cropper.css';
import axios from 'axios';
import DragableList from '../../components/Sliders/DragableList';
import EditImage from '../../components/Sliders/EditImage';
import EditSlider from '../../components/Sliders/EditSlider';

export default {
    created () {
        this.getSlideData();
    },
    data: () => ({
      dialog: false,
      dialog2: false,
      typeNew: false,
      typeImages: 'desktop',
      currentOption: {},
    }),
    methods: {
      ...mapMutations([
        'setSaveLoading', 
        'setEditSlide',
      ]),
      ...mapActions([
        'getSlideData',
        'savePositionSlider'
      ]),
      save() {
          this.setSaveLoading(true);
      },
      edit(slide) {
          this.setEditSlide(slide);
          this.dialog = true;
          this.typeNew = false;
      },
      closeEditModal() {
        this.dialog = false;
        this.setEditSlide({});
      },
      savePositionSlide(sliders) {
        this.savePositionSlider(sliders);
      },
      showEditImage({ showModal, images, option }) {
        this.typeImages = images;
        this.dialog2 = showModal;
        console.log(option);
        this.currentOption = option;
      },
      addNewSlide() {
        this.dialog = true;
        this.typeNew = true;
      },
      uploadImage(payload) {
        const newEditSlide = {
          ...this.editSlide,
          ...payload
        };
        
        newEditSlide[Object.keys(payload)[0]] = '/img/temp/' + payload[Object.keys(payload)[0]];
        this.setEditSlide(newEditSlide);
        this.dialog2 = false;
      },
      changeData(payload) {
        const newData = {
          ...this.editSlide,
          ...payload
        }
        this.setEditSlide(newData);
      }
    },
    computed: {
      ...mapGetters([
        'saveLoading', 
        'sliders',
        'editSlide',
      ])
    },
	directives: {
		dragAndDrop: VueDraggableDirective
	},
	components: { 
		VueCropper, 
		DragableList,
		EditImage,
		EditSlider
	}
}


</script>

<style lang="scss">
// .flip-list-move {
//   transition: transform 0.5s;
// }
// .sliders {
//   position: relative;
//   &__add-button.v-btn {
//     position: absolute;
//     right: 20%;
//     top: 0;
//   }
// }

// .img-cropper {
//   width: 100%;
//   height: 100%;
//   max-height: 300px;
//   overflow: hidden;
// }

.img-cropper img {
  height: 100%;
  width: 100%;
  object-fit: contain;
}
</style>
