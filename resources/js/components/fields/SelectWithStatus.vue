<template>
    <div class="w-52">
        <label v-if="label"
               id="listbox-label"
               class="block text-sm font-medium text-gray-700"
               v-text="label">
        </label>
        <div class="mt-1 relative">
            <button @click="show=!show" type="button"
                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <div class="flex items-center">
                    <span aria-label="Online" class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
                          :class="{ 'bg-green-400': online(selectedIndex), 'bg-gray-200': !online(selectedIndex)}"/>
                    <span class="ml-3 block truncate" v-text="selectedOptionLabel()"/>
                </div>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>
<!--            <div v-show="show" class="fixed z-10 inset-0 transition-opacity" aria-hidden="true">-->
<!--                <div class="absolute inset-0 bg-red-500 opacity-75"></div>-->
<!--            </div>-->

            <transition
                leave-active-class="transition ease-in duration-100"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0">
                <div v-show="show" class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
                    <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                        aria-activedescendant="listbox-item-3"
                        class="max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                        <!--
                          Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.
                        -->
                        <li @click="select(key)" @mouseenter="highlight(key)" v-for="(option,key) in options" id="listbox-item-0" role="option"
                            class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-9"
                            :class="{'text-white bg-indigo-600': highlighted(key), 'text-gray-900': !highlighted(key)}">
                            <div class="flex items-center">

                            <span class="flex-shrink-0 inline-block h-2 w-2 rounded-full"
                                  aria-hidden="true"
                                  :class="{'bg-green-400':online(key), 'bg-gray-200':!online(key)}"
                            ></span>

                                <span class="ml-3 block truncate"
                                      :class="{'font-semibold':selected(key), 'font-normal':!selected(key)}">
                                {{ optionLabel(option) }}
                                <span class="sr-only"> is {{ status(option) }}line</span>
                            </span>
                            </div>

                            <span class="absolute inset-y-0 right-0 flex items-center pr-4"
                                  :class="{'text-white': highlighted(key), 'text-indigo-600': !highlighted(key)}">

            <svg v-show="selected(key)" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                 fill="currentColor"
                 aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>

</template>

<script>
import { mapGetters } from 'vuex';

export default {
    props: ['label'],
    data() {
        return {
            show: false,
            selectedIndex: 0,
            highlightedIndex: -1,
            options: [],
        }
    },
    watch: {
        users() {
            this.options = this.users;
            this.$emit('input', this.options[this.selectedIndex].id);
        }
    },
    computed: {
        ...mapGetters('users', ['users']),
        selectedOption() {
            return this.options[this.selectedIndex];
        }
    },
    methods: {
        refresh() {
            this.options = this.users;
        },
        highlight(key) {
            this.highlightedIndex = key;
        },
        select(key) {
            this.selectedIndex = key;
            this.show = false;
            this.$emit('input', this.selectedOption.id)
        },
        highlighted(key) {
            return key === this.highlightedIndex;
        },
        selected(key) {
            return key === this.selectedIndex;
        },
        online(key) {
            return this.options[key]?.status === 'on';
        },
        status(option) {
            return option?.status;
        },
        optionLabel(option) {
            return option?.label;
        },
        selectedOptionLabel() {
            return this.selectedOption?.label;
        }
    }
}
</script>

<style scoped>

</style>
