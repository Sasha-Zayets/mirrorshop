<template>
    <v-dialog 
        v-model="show">
        <v-card>
            <v-card-title>
                Редагування зображення 
                <span v-if="currentOption.label">
                    ({{ currentOption.label }})
                </span>
            </v-card-title>
            <v-col cols="12" lg="12">
                <v-row>
                    <v-col cols="12" lg="12" v-if="!selectedFile">
                       <h3 class="headline text-center mb-0 mt-0" >
                            Завантажте зображення
                        </h3>
                    </v-col>
                    <v-col 
                        cols="12" sm="6" md="6" 
                        v-if="selectedFile">
                        <div class="img-cropper">
                            <!-- 
                                 :minCropBoxWidth="widthCrop"
                                :minCropBoxHeight="heightCrop"
                                :aspect-ratio="16 / 9" -->
                            <vue-cropper 
                                :src="originalImage"
                                :containerStyle="{
                                    'max-width': widthCrop + 'px',
                                    'max-height': heightCrop + 'px'
                                }"
                                :imgStyle="{
                                    'object-fit': 'contain'
                                }"
                                ref="cropper"
                                preview=".preview"
                                alt="Source Image"></vue-cropper>
                        </div>
                    </v-col>

                    <v-col cols="12" sm="6" md="6" 
                        v-if="cropImg">
                        <div class="img-cropper">
                            <v-img 
                                :contain="true"
                                :src="cropImg"
                                alt="Cropped Image" />
                        </div>
                    </v-col>
                </v-row>
                <v-row v-if="uploadProgress > 0">
                    <v-col cols="12">
                        <v-progress-linear
                            :value="uploadProgress"
                            :active="true"
                            :striped="true"
                            height="25"
                        >
                            <strong>{{ Math.ceil(uploadProgress) }}%</strong>
                        </v-progress-linear>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="4" md="4">
                        <v-btn
                            color="primary"
                            class="ma-2"
                            :disabled="!originalImage"
                            dark
                            @click="cropImage"
                        > Обрізати </v-btn>
                    </v-col>
                    <v-col cols="12" sm="4" md="4">
                        <v-file-input
                            :rules="rules"
                            accept="image/png, image/jpeg, image/bmp"
                            placeholder="Виберіть зображення"
                            prepend-icon="fa fa-camera"
                            label="Зображення"
                            clear-icon="fa fa-times"
                            @change="onFileSelected"
                            v-model="nameFile"
                        ></v-file-input>
                    </v-col>
                    <v-col cols="12" sm="4" md="4">
                        <v-btn
                            color="primary"
                            class="ma-2 float-right"
                            :disabled="!cropImg"
                            :loading="uploadProgress > 0 && uploadProgress !== 100"
                            outlined
                            @click="uploadImage"
                        > Завантажити</v-btn>
                    </v-col>
                </v-row>
            </v-col>
        </v-card>
    </v-dialog>
</template>

<script>
import { mapMutations } from 'vuex';
import axios from 'axios';
import VueCropper from 'vue-cropperjs';
import { initCrop } from 'crop';
import 'cropperjs/dist/cropper.css';
export default {
    props: {
        showModal: {
            type: Boolean,
            default: false
        },
        imageData: {
            type: Object,
            default: () => {}
        },
        typeImage: {
            type: String
        },
        currentOption: {
            type: Object
        },
        type: {
            type: Boolean
        }
    },
    computed: {
        show: {
            get() {
                return this.showModal;
            },
            set(v) {
                this.$emit('closeImage', v);
            }
        },
    },
    watch: {
        imageData() {
            this.selectedData();
        },
        typeImage() {
            this.selectedData();
        },
        selectedFile() {
            // на зміну зображення засечуємо поточні настройки кропера
            const cropper = this.$refs.cropper;
            if (cropper != undefined) {
                cropper.setAspectRatio(this.currentOption.crop.width / this.currentOption.crop.height);
            }
        },
        showModal() {
            if (!this.showModal) {
                this.nameFile = null;
                this.cropImg = null;
                this.selectedFile = null;
                this.uploadProgress = 0;
            } else {
                this.selectedData();
            }
        },
        currentOption() {
            if(this.currentOption.crop.width !== undefined) {
                this.widthCrop = this.currentOption.crop.width;
                this.heightCrop = this.currentOption.crop.height;
            }
        }
    },
    data: () => ({
        cropImg: '',
        originalImage: '',
        selectedFile: null,
        nameFile: null,
        widthCrop: 0,
        heightCrop: 0,
        uploadProgress: 0,
        rules: [
            value => !value || value.size < 5000000 || 'Розмір зображення повинен бути менше 5MB',
        ],
    }),
    methods: {
        ...mapMutations([
            'setNewSlideImageName'
        ]),
        selectedData() {
            this.originalImage = this.imageData[this.typeImage];
            this.selectedFile = this.imageData[this.typeImage];
        },
        cropImage() {
            this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
        },
        onFileSelected(event) {
            this.selectedFile = false;
            this.originalImage = null;
            const reader = new FileReader();
            reader.onload = ({target}) => {
                this.originalImage = target.result;
                this.selectedFile = true;
            };
            reader.readAsDataURL(this.nameFile);
        },
        uploadImage() {
            this.$refs.cropper.getCroppedCanvas().toBlob(function(blob) {
                const formData = new FormData();
                formData.append('croppedImage', blob);
                axios.post('/api/admin/load-image', formData, {
                    onUploadProgress: progressEvent => {
                        this.$data.uploadProgress = (progressEvent.loaded / progressEvent.total) * 100;
                    }
                })
				.then(({ data }) => {
                    // url save file
                    this.cropImg = '/img/temp/'  + data.fileName;
                    
                    this.setNewSlideImageName({
                        [this.typeImage]: data.fileName
                    });

                    setTimeout(() => {
                        this.$emit('uploadImage', {[this.typeImage]: data.fileName});
                    }, 500);
				})
            }.bind(this));
        },
    },
    components: {
        VueCropper
    }
}
</script>

<style lang="scss">
// .cropper-bg {
//     background-size: contain !important;
// }
</style>