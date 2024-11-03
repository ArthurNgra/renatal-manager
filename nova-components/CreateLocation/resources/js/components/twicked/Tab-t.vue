<template>
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
        <!-- Table Header -->
        <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
            <th
                v-if="shouldShowCheckboxes"
                class="w-[1%] whitespace-nowrap uppercase text-xxs text-gray-500 tracking-wide pl-5 pr-2 py-2"
            >
                <span class="sr-only">{{ __('Selected Resources') }}</span>
            </th>

            <th
                v-for="(field, index) in fields"
                :key="field.uniqueKey"
                :class="{
            'text-left': field.textAlign === 'left',
            'text-center': field.textAlign === 'center',
            'text-right': field.textAlign === 'right',
            'px-6': index === 0 && !shouldShowCheckboxes,
            'px-2': index !== 0 || shouldShowCheckboxes,
            'whitespace-nowrap': !field.wrapping,
          }"
                class="uppercase text-gray-500 text-xxs tracking-wide py-2"
            >
                {{ field.indexName }}
            </th>

            <th class="uppercase text-gray-500 text-xxs tracking-wide px-2 py-2">
                <span class="sr-only">{{ __('Controls') }}</span>
            </th>
        </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
        <tr
            v-for="(item, index) in items"
            :key="item.id"
            class="hover:bg-gray-100 dark:hover:bg-gray-700"
        >
            <td v-if="shouldShowCheckboxes" class="w-[1%] whitespace-nowrap pl-5 pr-2 py-2">
                <input type="checkbox" v-model="selectedItems" :value="item.id" />
            </td>

            <td
                v-for="(field, fieldIndex) in fields"
                :key="field.uniqueKey"
                :class="{
            'text-left': field.textAlign === 'left',
            'text-center': field.textAlign === 'center',
            'text-right': field.textAlign === 'right',
            'px-6': fieldIndex === 0,
            'px-2': fieldIndex !== 0,
            'whitespace-nowrap': !field.wrapping,
          }"
                class="py-2"
            >
                <!-- Check if the field data is boolean and render IconBoolean -->
                <IconBoolean v-if="typeof item[field.indexName] === 'boolean'" :value="item[field.indexName]" />
                <span v-else>
            {{ item[field.indexName] }}
          </span>
            </td>

            <td class="px-2 py-2">
                <IconButton @click="viewItem(item.id)" class="text-blue-500 mr-2" icon-type="search" />
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
import IconButton from "../Buttons/IconButton.vue";
import IconBoolean from "../Icons/IconBoolean.vue";

export default {
    name: "Tab-t",
    components: { IconButton, IconBoolean },

    props: {
        resourceName: String,
        shouldShowCheckboxes: {
            type: Boolean,
            default: true,
        },
        fields: {
            type: Array, // Array of fields, each containing indexName, textAlign, etc.
            required: true,
        },
        items: {
            type: Array, // Array of data items to be displayed in the table
            required: true,
        },
    },

    data() {
        return {
            selectedItems: [], // Keeps track of selected items
        };
    },

    watch: {
        selectedItems(newItems) {
            // Emit the selected items to the parent
            this.$emit('update:selected-items', newItems);
        },
    },

    methods: {
        viewItem(id) {
            // Logic to view the item
            console.log(`Viewing item with id: ${id}`);
        },
    },
};
</script>

