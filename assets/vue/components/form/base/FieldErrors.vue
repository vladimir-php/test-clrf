<template>
    <div>
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
    },
    name: "FieldErrors",
    data() {
        return {
        }
    },
    created() {
    },
    methods: {}
}
</script>
