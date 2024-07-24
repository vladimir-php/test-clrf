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
                <select v-model="carrier_id" id="countries" :class="(!errors.carrier_id || !errors.carrier_id.length) ? 'field' : 'field-error'">
                    <option selected>Choose a carrier</option>
                    <option v-for="(carrier, key) in this.carriers" :value="carrier.id">{{ carrier.name }}</option>
                </select>
                <p v-for="(error, index) in errors.carrier_id ?? []" class="mt-2 text-sm text-red-600 dark:text-red-500">{{ error }}</p>
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
            errors: {
                weight: [],
                carrier_id: [],
            },
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
                for(const field in response.errors() ) {
                    this.errors[field] = response.errors()[field];
                }
                console.error(this.errors[field]);
            }

            this.responseOutput = response.success() ? response.data() : response.errors();
            this.responseSuccess = response.success();

            this.loading = false;
        },
    }
}
</script>
