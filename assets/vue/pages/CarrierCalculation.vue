<template>
    <h1 class="header">Carrier Calculation</h1>
    <br />

    <div class="px-4 py-2 rounded-lg shadow-lg text-center">

        <div class="flex space-x-4">
            <div class="w-full px-4 py-2">
                <input-field v-model="weight" :value="weight" :errors="errors.weight" placeholder="Cargo weight"></input-field>
            </div>
        </div>

        <div class="flex space-x-4">
            <div class="w-full px-4 py-2">
                <select v-model="carrier_id" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a carrier</option>
                    <option v-for="(carrier, key) in this.carriers" :value="carrier.id">{{ carrier.name }}</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end space-x-4 px-4 py-2">
            <submit-button @submit="submitRequest" :loading="loading" />
        </div>

        <response-output :success="responseSuccess" :output="responseOutput" />

    </div>

</template>
<script>

import axios from 'axios'
import InputField from "../components/form/base/InputField.vue";
import SubmitButton from "../components/form/base/SubmitButton.vue";
import ResponseOutput from "../components/form/base/ResponseOutput.vue";
import Query from "../../js/query/Query";

export default {
    computed: {
    },
    components: {
        InputField,
        SubmitButton,
        ResponseOutput,
    },
    props: {
    },
    name: "Carrier Calculation",
    data() {
        return {
            responseSuccess: false,
            responseOutput: '',
            carriers: [],
            carrier_id: null,
            weight: null,
            loading: false,
            errors: {},
        }
    },
    async mounted() {
        const response = await (new Query).query({
            method: 'get',
            url: '/api/v1/carrier',
        });
        if (response.success() ) {
            this.carriers = response.data().carriers;
        }
        else {
            this.responseOutput = response;
        }
    },
    created() {
    },
    methods: {
        async submitRequest() {
            this.errors = {};
            this.loading = true;

            const response = await (new Query).query({
                method: 'post',
                url: '/api/v1/carrier/calculate-price',
                data: {
                    weight: this.weight,
                    carrier_id: this.carrier_id,
                }
            });

            if (!response.success() ) {
                for(const error in response.errors() ) {
                    this.errors[error['field']] = error['messasge'];
                }
            }

            this.responseOutput = response.success() ? response.data() : response.errors();
            this.responseSuccess = response.success();

            this.loading = false;
        },
    }
}
</script>
