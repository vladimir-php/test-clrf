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
                <field-errors :errors="errors.carrier_id ?? []"></field-errors>
            </div>
        </div>

        <div class="flex justify-center">
            <div><div class="px-4 py-4 text-center text-2xl font-bold">Price: {{ price ? price + ' EUR' : '' }}</div></div>
        </div>
        <div class="flex justify-end">
            <div><submit-button @submit="submitRequest" :loading="loading" /></div>
        </div>

    </div>

</template>
<script>

import InputField from "../components/form/base/InputField.vue";
import SubmitButton from "../components/form/base/SubmitButton.vue";
import Query from "../../js/query/Query";
import FieldErrors from "../components/form/base/FieldErrors.vue";

export default {
    computed: {
    },
    components: {
        FieldErrors,
        InputField,
        SubmitButton,
    },
    props: {
    },
    name: "Carrier Calculation",
    data() {
        return {
            carriers: [],
            carrier_id: null,
            weight: null,
            price: null,
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
            }
            else {
                this.price = response.data().price;
            }

            this.loading = false;
        },
    }
}
</script>
