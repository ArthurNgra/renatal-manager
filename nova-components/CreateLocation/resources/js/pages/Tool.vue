<template>
    <div>
        <Head title="Locations"/>

        <Heading class="mb-6">Crée une location</Heading>

        <Card class="flex flex-col items-center justify-center m-40 p-6 bg-white shadow-md rounded-lg">
            <form @submit.prevent="submitForm" class="w-full  mt-60">
                <!-- Search Input for Clients -->
                <label class="block text-gray-700 text-sm font-bold m-8" for="rental-info">
                    Client
                </label>
                <div class="space-y-2 md:flex md:flex-row md:space-y-0 py-5">
                    <div class="w-full px-6 md:mt-2 md:px-8 md:w-1/5">
                        <label for="client_search" class="inline-block leading-tight space-x-1">
                            <span>reference</span>
                            <span class="text-red-500 text-sm">*</span>
                        </label>

                    </div>
                    <div class="w-full space-y-2 px-6 md:px-8 md:w-3/5">
                        <SearchInput
                            dusk="search"
                            :data="filteredClients"
                            track-by="id"
                            v-model="selectedClient"
                            :value="selectedClient"
                            value=""
                            @input="searchTerm = $event"
                            @selected="handleClientSelection"
                            @clear="handleClientClear"

                        >
                            <template #option="{ option }">
                                {{ option.firstname }} {{ option.lastname }} - <strong> {{ option.society }}</strong>
                            </template>
                            <template v-if="selectedClient">
                                {{ selectedClient }}
                            </template>
                        </SearchInput>
                    </div>
                </div>

                <!-- Referral Phone and Rental Info Form using Grid -->
                <div class="mb-4 pt-5">
                    <label class="block text-gray-700 text-sm font-bold m-8" for="rental-info">
                        Location
                    </label>

                    <!-- Start of the grid layout for the form -->
                    <div class="space-y-2 md:flex md:flex-row md:space-y-0 py-5 border-b-gray-300 border-t-0">
                        <!-- Rental Address -->
                        <div class="w-full px-6 md:mt-2 md:px-8 md:w-1/5">
                            <label for="address" class="inline-block leading-tight space-x-1">
                                <span>Adresse</span>
                                <span class="text-red-500 text-sm">*</span>
                            </label>
                        </div>
                        <div class="w-full space-y-2 px-6 md:px-8 md:w-3/5">
                            <div class="space-y-1">
                                <Input v-model="form.address"
                                       class="w-full form-control form-input form-control-bordered" id="address"
                                       type="text" placeholder="Rental Address"
                                       required
                                />
                            </div>
                        </div>
                    </div>

                    <!-- From Date and To Date -->
                    <!-- From Date and To Date -->
                    <div class="space-y-2 md:flex md:flex-row md:space-y-0 py-5 border-b-gray-300 border-t-0">
                        <!-- Rental Address -->
                        <div class="w-full px-6 md:mt-2 md:px-8 md:w-1/5">
                            <label for="address" class="inline-block leading-tight space-x-1">
                                <span>Période</span>
                                <span class="text-red-500 text-sm">*</span>
                            </label>
                        </div>

                        <!-- Container for From and To Date -->
                        <div class="w-full space-y-2 md:space-y-0 px-6 md:px-8 md:w-3/5">
                            <div class="flex space-x-4">
                                <!-- From Date -->
                                <div class="w-1/2">
                                    <label for="from" class="block text-sm font-medium text-gray-700">de
                                        <span class="text-red-500 text-sm">*</span></label>
                                    <Input v-model="form.from"
                                           class="w-full form-control form-input form-control-bordered"
                                           id="from"
                                           type="date"
                                           required
                                    />
                                </div>

                                <!-- To Date -->
                                <div class="w-1/2">
                                    <label for="to" class="block text-sm font-medium text-gray-700">à
                                        <span class="text-red-500 text-sm">*</span>
                                    </label>
                                    <Input v-model="form.to"
                                           class="w-full form-control form-input form-control-bordered"
                                           id="to"
                                           type="date"
                                           required

                                    />

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Referral Phone -->
                    <div class="space-y-2 md:flex md:flex-row md:space-y-0 py-5">
                        <div class="w-full px-6 md:mt-2 md:px-8 md:w-1/5">
                            <label for="referal_phone" class="inline-block leading-tight space-x-1">
                                <span>Téléphone sur site</span>
                                <span class="text-red-500 text-sm">*</span>
                            </label>
                        </div>
                        <div class="w-full space-y-2 px-6 md:px-8 md:w-3/5">
                            <div class="space-y-1">
                                <Input v-model="form.referal_phone"
                                       class="w-full form-control form-input form-control-bordered" id="referal_phone"
                                       type="text" placeholder="Referral Phone"
                                       required
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Special Demands -->
                    <div class="space-y-2 md:flex md:flex-row md:space-y-0 py-5">
                        <div class="w-full px-6 md:mt-2 md:px-8 md:w-1/5">
                            <label for="special_demands" class="inline-block leading-tight space-x-1">
                                <span>Demandes spéciales</span>
                            </label>
                        </div>
                        <div class="w-full space-y-2 px-6 md:px-8 md:w-3/5">
                            <div class="space-y-1">
                                <Input v-model="form.special_demands"
                                       class="w-full form-control form-input form-control-bordered" id="special_demands"
                                       type="text" placeholder="Special Demands"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-auto justify-between">
                        <BasicButton :onclick="getFilteredMAteiral" :disabled="!isFormValid" class="bg-primary-500 text-white p-4 ">Materiel
                            disponible
                        </BasicButton>
                        <div class="flex  justify-between space-x-4">
                            <BasicButton :onclick="submit" class="bg-primary-500  text-white   "> create</BasicButton>
                            <BasicButton :onclick="submit" class="bg-primary-500  text-white  "> creer le devis
                            </BasicButton>
                        </div>
                    </div>
                </div>

            </form>
        </Card>
        <divider-line></divider-line>
        <Card>

            <Tab-t
                v-if="materials.length"
                :fields="field"
                :items="materials"
                :should-show-checkboxes="true"
                @update:selected-items="handleSelectedItems"
            />

        </Card>
    </div>
</template>


<script>

import {Input} from "laravel-nova-ui";
import DividerLine from "../components/DividerLine.vue";
import FieldWrapper from "../components/FieldWrapper.vue";
import ResourceTable from "../components/ResourceTable.vue";
import TabT from "../components/twicked/Tab-t.vue";
import BasicButton from "../components/Buttons/BasicButton.vue";
import axios from "axios";
import IconBoolean from "../components/Icons/IconBoolean.vue";

export default {
    components: {IconBoolean, BasicButton, TabT, ResourceTable, FieldWrapper, DividerLine, Input},
    props: {
        clients: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            form: {
                client_id: '',
                referal_phone: '',
                address: '',
                from: '',
                to: '',
                special_demands: '',
            },
            searchTerm: '', // To hold the current search term
            filteredClients: this.clients, // Initially, show all clients
            selectedClient: null,
            selectedItem: [],
            field: [
                {indexName: 'id', uniqueKey: 'id', textAlign: 'left'},
                {indexName: 'category_id', uniqueKey: 'category_id', textAlign: 'left', wrapping: false},
                {indexName: 'brand', uniqueKey: 'brand', textAlign: 'left', wrapping: false},
                {indexName: 'model', uniqueKey: 'model', textAlign: 'left', wrapping: false},
                {indexName: 'specs', uniqueKey: 'specs', textAlign: 'left', wrapping: false},
                {indexName: 'serial', uniqueKey: 'serial', textAlign: 'left', wrapping: false},
                {indexName: 'has_issue', uniqueKey: 'has_issue', textAlign: 'left', wrapping: false},

            ]
            ,
            materials: []

        };
    },
    watch: {
        searchTerm(val) {
            this.filteredClients = this.handleClientSearch(val); // Filter clients whenever searchTerm changes
        }
    },
    computed: {
        // Validation method to check if the form is valid
        isFormValid() {
            return this.form.client_id && this.form.address && this.form.from && this.form.to && this.form.referal_phone;
        }
    },
    methods: {
        submit() {
            const selectedMaterials = this.materials.filter((material) => {
                return this.selectedItem.includes(material.id);
            });

            axios.post('/create-location/create', {
                ...this.form,
                materials: selectedMaterials
            }).then((response) => {
                console.log('Form submitted successfully:', response.data);
                window.location.href = `/create-location/redirect/locations/${response.data.id}`;

            }).catch((error) => {
                console.error('Error submitting form:', error);
            });
        },
        handleSelectedItems(selectedItems) {
            console.log(selectedItems);
            this.selectedItem = selectedItems


        },
        getFilteredMAteiral() {
            const from = this.form.from;
            const to = this.form.to;

            if (!from || !to) {
                // Add validation to ensure both 'from' and 'to' dates are filled
                alert("Please provide both From and To dates.");
                return;
            }

            // Ensure axios sends a valid request with proper parameters
            axios.get('/create-location/materials', {
                params: {from, to},  // Pass the dates as query parameters
                withCredentials: true
            }).then((response) => {
                // Handle the response and update the UI with available materials
                console.log('Available materials:', response.data);
                // Add logic here to display the available materials in the TabT component
                this.materials = response.data;
            }).catch((error) => {
                // Handle any errors from the request
                console.error('Error fetching materials:', error);
            });
        },
        handleClientSearch(searchTerm) {
            // If searchTerm is empty, return all clients
            if (!searchTerm) {
                return this.clients;
            }

            // Otherwise, filter clients based on the search term
            return this.clients.filter((client) => {
                return (
                    client.firstname.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    client.lastname.toLowerCase().includes(searchTerm.toLowerCase())
                );
            });
        },
        handleClientSelection(selectedClient) {

            // Update form fields with selected client's info
            this.form.client_id = selectedClient.id;
            this.selectedClient = `${selectedClient.firstname} ${selectedClient.lastname} - ${selectedClient.society}`;

        },
        handleClientClear() {
            // Clear the client fields in the form
            this.form.client_id = '';
            this.selectedClient = null;
        }
    }
};

</script>

<style scoped>
/* Add any styles here to match your UI needs */
</style>
