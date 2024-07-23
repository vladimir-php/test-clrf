<template>
    <div :class="`text-sm text-left ${success ? 'bg-green-300' : 'bg-red-300'}`">
        <pre>{{ output }}</pre>
    </div>
</template>

<script>

export default {
    props: {
        success: {
            type: Boolean,
            required: false,
            default: false,
        },
        output: {
            type: String,
            required: false,
            default: '',
        },
    },
    name: "ResponseOutput",
    data() {
        return {
        }
    },
    created() {
    },
    methods: {}
}
</script>
