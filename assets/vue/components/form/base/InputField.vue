<template>
    <div>
        <input
            type="text"
            :class="!errors.length ? 'field' : 'field-error'"
            :value="value"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
        >
        <p v-for="(error, index) in errors" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ error }}</p>
    </div>
</template>

<script>

export default {
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
