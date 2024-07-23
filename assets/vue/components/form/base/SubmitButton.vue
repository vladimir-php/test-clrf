<template>
    <div class="w-1/6 px-4 py-2 text-center relative">
        <button @click="$emit('submit')" class="inline-flex btn btn-blue">
            <span v-if="loading" class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
            </span>
            {{ title }}
        </button>
    </div>
</template>

<script>

export default {
    props: {
        title: {
            type: String,
            required: false,
            default: 'Submit',
        },
        loading: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    name: "SubmitButton",
    data() {
        return {
        }
    },
    created() {
    },
    methods: {}
}
</script>
