<template>
    <h1 class="header">Carrier Calculation</h1>
    <br />

    <div class="px-4 py-2 rounded-lg shadow-lg text-center">

        <div class="flex space-x-4">
            <div class="w-full px-4 py-2">
                <input-field placeholder="Cargo weight"></input-field>
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
            loading: false
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
