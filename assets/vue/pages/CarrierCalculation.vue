<template>
    <h1 class="header">Carrier Calculation</h1>
    <br />

    <div class="px-4 py-2 rounded-lg shadow-lg text-center">

        <div class="flex space-x-4">
            <div class="w-full px-4 py-2 text-center">
                <input-field placeholder="Cargo weight"></input-field>
            </div>
        </div>

        <!--
        <div class="flex space-x-4">
            <submit-button @submit="submitRequest" :loading="loading" />
        </div>

        <response-output :success="responseSuccess" :output="responseOutput" />
        -->

    </div>

</template>
<script>

import axios from 'axios'
import InputField from "../components/form/base/InputField.vue";

export default {
    computed: {
    },
    components: {
        InputField
    },
    props: {
    },
    name: "Carrier Calculation",
    data() {
        return {
        }
    },
    async mounted() {
        const response = await axios({
            method: 'get',
            url: '/api/v1/tag?type=interest',
        });
        console.error(response);
    },
    created() {
    },
    methods: {
    }
}
</script>
