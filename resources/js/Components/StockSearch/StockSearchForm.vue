<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Datepicker from '@vuepic/vue-datepicker'
import { format, compareDesc } from 'date-fns'

let props = defineProps({
    filters: Object
})

console.log()
let selectedStartDate = ref(new Date(usePage().props.value.filters.startDate ?? null))
let selectedEndDate = ref(new Date(usePage().props.value.filters.endDate ?? null))

let searchForm = useForm({
    email: usePage().props.value.filters.email ?? null,
    startDate: format(selectedStartDate.value, 'yyyy-MM-dd'),
    endDate: format(selectedEndDate.value, 'yyyy-MM-dd'),
    companySymbol: usePage().props.value.filters.companySymbol ?? null
})



const requestData = () => {
    let hasErrors = false
    searchForm.clearErrors()

    // Check if a company symbol has been selected
    if(!searchForm.companySymbol) {
        searchForm.errors.companySymbol = 'The company symbol field is required.'
        hasErrors = true
    }

    // Check if start date is after end date
    if (compareDesc(selectedStartDate.value, selectedEndDate.value) < 0) {
        searchForm.errors.startDate = 'Start date needs to be before or equal to end date'
        hasErrors = true
    }

    if (!hasErrors) {
        searchForm.startDate = format(selectedStartDate.value, 'yyyy-MM-dd')
        searchForm.endDate = format(selectedEndDate.value, 'yyyy-MM-dd')

        searchForm.get(route('stock-search.find'), {
            preserveScroll: true,
            preserveState: true
        })
    }
}
</script>
<script>
export default {}
</script>

<template>
    <FormSection @submitted="requestData">
        <template #title>
            Stock search
        </template>

        <template #description>
            Fill in the fields to generate a history for the specific stock
        </template>

        <template #form>

            <!-- Company Symbol -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="symbols" value="Company Symbols" />
                <VSelect id="symbols" v-model="searchForm.companySymbol" :options="$page.props.companies" :reduce="company => company.symbol" label="symbol" :close-on-select="true" />
                <InputError :message="searchForm.errors.companySymbol" class="mt-2" />
            </div>

            <!-- Start Date -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="startDate" value="Start Date" />
                <Datepicker id="startDate" :enable-time-picker="false" v-model="selectedStartDate" :auto-apply="true" :max-date="selectedEndDate" format="yyyy-MM-dd" :required="true"/>
                <InputError :message="searchForm.errors.startDate" class="mt-2" />
            </div>

            <!-- End Date -->
            <div class="col-span-6 sm:col-span-4">
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="endDate" value="End Date" />
                    <Datepicker id="endDate" :enable-time-picker="false" v-model="selectedEndDate" :auto-apply="true" :max-date="new Date()" format="yyyy-MM-dd" :required="true"/>
                    <InputError :message="searchForm.errors.endDate" class="mt-2" />
                </div>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="searchForm.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
                <InputError :message="searchForm.errors.email" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="searchForm.recentlySuccessful" class="mr-3">
                Searched
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': searchForm.processing }" :disabled="searchForm.processing">
                Search
            </PrimaryButton>
        </template>
    </FormSection>
</template>

<style scoped>

</style>
