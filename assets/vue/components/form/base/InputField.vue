<template>
    <div>
        <input
            type="text"
            :class="!errors.length ? 'field' : 'field-error'"
            :value="value"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
        >
        <field-errors :errors="errors"></field-errors>
    </div>
</template>

<script>

import FieldErrors from "./FieldErrors.vue";

export default {
    components: {FieldErrors},
    props: {
        errors: {
            type: Array,
            required: false,
            default: [],
        },
        value: {
            type: String,
            required: false,
            default: '',
        },
        placeholder: {
            type: String,
            required: false,
            default: '',
        },
    },
    name: "Field",
    data() {
        return {
        }
    },
    created() {
    },
    methods: {}
}
</script>
