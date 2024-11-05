<template>
    <FilterContainer class="date-filter-container">
        <span class="filter-label">{{ filter.name }}</span>

        <template #filter>
            <div class="filter-input-container">
                <div class="p-2 date-input-wrapper">
                    <input
                        class="w-full form-control form-input form-input-bordered rounded-l"
                        :disabled="disabled"
                        :class="{'!cursor-not-allowed bg-gray-200': disabled}"
                        v-model="value.from"
                        ref="datePickerFrom"
                        type="date"
                        placeholder="Start Date"
                        @change="handleChange"
                    />
                    <input
                        class="w-full form-control form-input form-input-bordered rounded-r"
                        :disabled="disabled"
                        :class="{'!cursor-not-allowed bg-gray-200': disabled}"
                        v-model="value.to"
                        ref="datePickerTo"
                        type="date"
                        placeholder="End Date"
                        @change="handleChange"
                    />
                </div>
            </div>
        </template>
    </FilterContainer>
</template>

<script>
import debounce from 'lodash/debounce'
import '../../css/filter.css'
export default {
    emits: ['change'],
    props: {
        resourceName: { type: String, required: true },
        filterKey: { type: String, required: true },
        lens: String,
    },
    data: () => ({
        value: { from: null, to: null },
        debouncedEmit: null,
    }),
    created() {
        this.debouncedEmit = debounce(this.emitChange, 500)
        this.setCurrentFilterValue()
    },
    mounted() {
        Nova.$on('filter-reset', this.setCurrentFilterValue)
    },
    beforeUnmount() {
        Nova.$off('filter-reset', this.setCurrentFilterValue)
    },
    watch: {
        value: {
            deep: true,
            handler() {
                this.debouncedEmit()
            },
        },
    },
    methods: {
        handleChange(event) {
            this.$store.commit('updateFilterState', {
                filterClass: this.filterKey,
                value: event.target.value,
            })

            this.$emit('change')
        },
        setCurrentFilterValue() {
            const currentFilter = this.filter?.currentValue || {from: null, to: null};
            this.value = {...currentFilter};
        },
        emitChange() {
            this.$emit('change', {
                filterClass: this.filterKey,
                value: this.value,
            });
        },
    },
    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](this.filterKey);
        },
    },
}
</script>

<style scoped>
.date-filter-container {
    background-color: #f9fafb;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
}

.filter-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
    display: block;
}

.date-input-wrapper {
    display: flex;
    gap: 0.5rem;
}

.form-input {
    transition: all 0.3s ease;
}

.form-input:focus {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

.form-input.form-input-bordered {
    border: 1px solid #d1d5db;
}

.form-input[disabled] {
    background-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

.form-input::placeholder {
    color: #9ca3af;
}

/* Calendar Styling */
.flatpickr-calendar {
    width: 100%;
    max-width: 280px;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    font-family: sans-serif;
}

.flatpickr-weekdays {
    background: #f3f4f6;
    padding: 0.5rem;
    color: #374151;
    font-weight: 600;
    border-bottom: 1px solid #e5e7eb;
}

.flatpickr-day {
    color: #374151;
    transition: background-color 0.2s ease;
    font-weight: 500;
    margin: 0.125rem;
}

.flatpickr-day:hover,
.flatpickr-day:focus,
.flatpickr-day.selected {
    background-color: #3b82f6;
    color: #ffffff;
    border-radius: 50%;
    cursor: pointer;
}

.flatpickr-day.today {
    border: 1px solid #3b82f6;
    color: #3b82f6;
}

.flatpickr-current-month {
    font-size: 1rem;
    color: #374151;
    font-weight: 700;
}

.numInputWrapper span.arrowUp:after,
.numInputWrapper span.arrowDown:after {
    border-color: #374151;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.flatpickr-calendar.open,
.flatpickr-calendar.inline {
    animation: fadeIn 0.3s ease-in-out;
}
</style>
