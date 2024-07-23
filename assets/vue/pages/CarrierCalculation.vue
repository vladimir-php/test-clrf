<template>
    <h1 class="header">Carrier Calculation</h1>
    <br />

    <div class="px-4 py-2 rounded-lg shadow-lg text-center">

        <div class="flex space-x-4">
            <div class="w-full px-4 py-2">
                <input-field placeholder="Cargo weight"></input-field>
            </div>
        </div>


        <div class="flex space-x-4">
            <div class="w-full px-4 py-2">
                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a carrier</option>
                    <option v-for="(name, key) in this.carriers" :value="name">{{ name }}</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end space-x-4 px-4 py-2">
            <submit-button @submit="submitRequest" :loading="loading" />
        </div>

        <!--


        <response-output :success="responseSuccess" :output="responseOutput" />
        -->

    </div>

</template>
<script>

import axios from 'axios'
import InputField from "../components/form/base/InputField.vue";
import SubmitButton from "../components/form/base/SubmitButton.vue";
import Query from "../../js/query/Query";

export default {
    computed: {
    },
    components: {
        InputField,
        SubmitButton
    },
    props: {
    },
    name: "Carrier Calculation",
    data() {
        return {
            response: null,
            responseSuccess: false,
            responseOutput: '',
            carriers: [],
            loading: false
        }
    },
    async mounted() {
        const response = await (new Query).query({
            method: 'get',
            url: '/api/v1/carrier',
        });
        this.carriers = response.data().list;
    },
    created() {
    },
    methods: {
        async submitRequest() {
            this.loading = true;

            /*
            let query = new Query();
            this.response = await query.queryRequest(this.request);

            let outputData = this.response.success() ? this.response.data() : this.response.rawData();
            this.responseOutput = JSON.stringify(outputData, null, 2);
            this.responseSuccess = this.response.success();

             */
            // this.loading = false;

            this.$emit('onResponse', outputData, this.responseSuccess);
        },
    }
}
</script>
