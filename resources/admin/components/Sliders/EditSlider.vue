<template>
    <v-dialog 
      v-model="show" 
      fullscreen 
      hide-overlay 
      transition="dialog-bottom-transition">
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="fadeModal">
            <v-icon>fa fa-times</v-icon>
          </v-btn>
          <v-toolbar-title>
            {{ type ? 'Створення слайду': 'Редагування слайдера'}}
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark text @click="saveImage">Зберегти</v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-container>
            <v-form ref="form" v-model="valid">
              <v-row>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field 
                    label="Заголовок UA*" 
                    :rules="rulesRequired"
                    @change="changeData"
                    v-model="infoData.title_ua"
                    required></v-text-field>
                  <v-text-field 
                    label="Підпис UA*" 
                    @change="changeData"
                    v-model="infoData.description_ua"
                    required></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-text-field 
                    label="Заголовок RU*"
                    :rules="rulesRequired"
                    @change="changeData"
                    v-model="infoData.title_ru" 
                    required></v-text-field>
                  <v-text-field 
                    label="Підпис RU*" 
                    @change="changeData"
                    v-model="infoData.description_ru"
                    required></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="4">
                  <v-switch
                    v-model="infoData.active"
                    @change="changeData"
                    label="Показати на сайті"
                  ></v-switch>
                </v-col>

                <v-col cols="12" lg="12">
                  <v-row>
                    <v-col 
                      cols="12" 
                      sm="6" 
                      md="6"
                      lg="4"
                      v-for="cropOption in cropOptions" 
                      :key="cropOption.key">
                      <v-img 
                        v-if="data[cropOption.key]"
                        :src="data[cropOption.key]" 
                        max-width="300" 
                        height="200"
                        max-height="200" />
                      <v-btn
                        color="primary"
                        class="ma-2"
                        dark
                        @click="editImage(cropOption)"
                        >
                        Фото {{cropOption.label}}
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-col>

                <v-col cols="12">
                  <v-btn 
                    v-if="!type"
                    color="error" 
                    class="ma-2 mr-2" 
                    @click="confirm = true">Видалити</v-btn>
                  <v-btn 
                    color="primary" 
                    class="ma-2 float-right" 
                    @click="saveImage">Зберегти</v-btn>
                </v-col>
		        </v-row>
          </v-form>
        </v-container>
      </v-card>

      <confirm-modal 
        :show="confirm"
        @close="confirm = false"
        @confirm="removeSlide" />
    </v-dialog>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import ConfirmModal from './ConfirmModal';

export default {
  props: {
    showModal: {
      type: Boolean,
      default: false
    },
    data: {
      type: Object,
    },
    type: {
      type: Boolean,
    }
  },
  computed: {
    ...mapGetters([
      'newSlideImageName'
    ]),
    show: {
      get() {
        return this.showModal;
      },
      set(v) {
        this.$emit('closeModal', v);
      }
    },
  },
  data: () => ({
    cropOptions: {
        desktop: {
            key: 'desktop',
            label: 'Десктоп',
            fieldName: 'file_name',
            fileUrl: null,
            fileName: null,
            crop: {
                width: 1060,
                height: 450,
            },
        },
        tablet: {
            key: 'tablet',
            label: 'Планшет',
            fieldName: 't_file_name',
            fileUrl: null,
            fileName: null,
            crop: {
                width: 600,
                height: 400,
            },
        },
        mobile: {
            key: 'mobile',
            label: 'Мобільний',
            fieldName: 'm_file_name',
            fileUrl: null,
            fileName: null,
            crop: {
                width: 576,
                height: 350,
            },
        }
    },
    infoData: {},
    valid: true,
    showSlide: false,
    rulesRequired: [
      value => !!value || 'Поле обов\'язкове',
    ],
    confirm: false
	}),
	watch: {
		data() {
			this.infoData = Object.assign({}, this.data);
    }
	},
  methods: {
    ...mapActions([
      'saveInfoSlide',
      'saveSlide',
      'updateSlide',
      'deleteSlide'
    ]),
    editImage(option) {
        //Відкриває модалку редагування зображення
        this.$emit('editImage', {
          showModal: this.showModal,
          images: option.key,
          option
        });
    },
    changeData() {
      this.$emit('changeData', this.infoData);
    },
    fadeModal() {
      this.show = false;
      this.showSlide = false;
      this.valid = true;
      this.$emit('closeModal', false);
    },
    saveImage() {
      const data = {
        ...this.infoData,
        new: {
          ...this.newSlideImageName
        }
      }

      this.saveInfoSlide({
        ...this.infoData,
      });

      if(this.type) {
        this.saveSlide(data);
      } else {
        this.updateSlide(data);
      }

      this.fadeModal();
    },
    saveData() {
      // dispatch save
      this.show = false;
    },
    removeSlide() {
      this.deleteSlide(this.infoData);
      this.fadeModal();
    },
  },
  components: {
    ConfirmModal
  }
}
</script>