<template>
    <div :class="['text-field', {'text-field--focus': focusClass == true}]" ref="field">
        <svg-icon 
            v-if="iconName"
            :name="iconName"
            class="text-field__icon" />
        <input 
            :type="type"
            :placeholder="placeholder"
            v-model="val"
            autocomplete="off"
            v-if="!mask"
            @focus="focusClass = true"
            @blur="focusClass = false"
            class="text-field__input">

        <input-mask 
            v-else
            v-model="val"
            class="text-field__input"
            :class="{'test': errors.first('phone')}"
            name="phone"
            autocomplete="off"
            :mask="maskValue"
            inputmode="numeric"
            @focus="focusClass = true"
            @blur="focusClass = false"
            data-vv-validate-on="blur"
            v-validate="'required|phoneNumber'"
            :placeholder="placeholder"
            v-on="$listeners" />

    </div>
</template>

<script>
import MaskedInput from './MaskedInput/MaskedInput';
import { Validator } from 'vee-validate';
import { PHONE } from '@/assets/js/constans';
export default {
    props: {
        type: {
            type: String,
            default: 'text'
        },
        placeholder: {
            type: String,
            default: 'placeholder'
        },
        value: {
            type: String,
            default: ''
        },
        iconName: {
            type: String
        },
        mask: {
            type: Boolean,
            default: false
        },
        maskValue: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        focusClass: false
    }),
    computed: {
        val: {
            get() {
                return this.value;
            },
            set(v) {
                this.$emit('input', v);
            }
        }
    },
    components: {
        InputMask: MaskedInput
    }
}

function validPhone (value) {
    return PHONE.test(value);
}

const phoneNumber = {
  getMessage: field => `${field} is not a valid phone number`,
  validate (value) {
      console.log(value);
    return new Promise(resolve => {
      let phone = validPhone(value);
      resolve({ valid: phone })
    })
  }
}
Validator.extend('phoneNumber', phoneNumber);
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.text-field {
    height: 40px;
    display: flex;
    align-items: center;
    background: #FFFFFF;
    padding: 0 14px;
    &__icon {
        width: 11px;
        min-width: 11px;
        height: 16px;
        margin-right: 6px;
    }
    &__input {
        color: black;
        font-size: 16px;
        width: calc(100% - 17px);
        &::placeholder {
            color: #A8A9AA;
            font-size: 16px;
        }
    }
    &--focus {
        border: 1px solid #86E0ED;
    }
}

@media #{$screen-min-360} {
    .text-field {
        &__icon {
            width: 14px;
            min-width: 14px;
            height: 14px;
        }
        &__input {
            width: calc(100% - 20px);
        }
    }
}

</style>