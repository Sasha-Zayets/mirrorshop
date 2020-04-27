<template>
    <div class="check-social">
        <input 
            type="checkbox" 
            v-model="checkValue"
            class="check-social__input" 
            :id="id" hidden>
        <label :for="id" class="check-social__label">
            <span :class="icon"></span>
        </label>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: [Boolean, Number]
        },
        icon: {
            type: String,
            default: ''
        },
        id: {
            type: [String, Number],
            default: ''
        }
    },
    computed: {
        checkValue: {
            get () {
                return this.value;
            },
            set (v) {
                this.$emit('input', v);
                this.$emit('checked', v);
            } 
        }
    }
}
</script>