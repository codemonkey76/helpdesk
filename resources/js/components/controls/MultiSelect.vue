<template>
    <div class="relative">
        <div v-show="selected" @click="selected = false" class="fixed inset-0 z-30 opacity-20 bg-gray-900"></div>
        <label id="listbox-label" class="block text-sm font-medium text-gray-700" v-text="label"/>
        <input type="hidden" :value="selectedValues" :name="name">

        <div class="mt-1 relative z-40">
            <button @click="selected = !selected" type="button" aria-haspopup="listbox" aria-expanded="true"
                    aria-labelledby="listbox-label"
                    class="bg-white relative w-full border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <span class="block truncate" v-text="selectedText"/>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor"
                         aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                </span>
            </button>

            <transition
                leave-active-class="transition ease-in duration-100"
                leave-class="opacity-100"
                leave-to-class="opacity-0">
                <div v-show="selected" class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
                    <ul role="listbox"
                        aria-labelledby="listbox-label"
                        @keydown.up="selectPrev()"
                        @keydown.down="selectNext()"
                        @keydown.esc="selected = false"
                        @keydown.space="toggleItem()"
                        class="no-hover max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">

                        <a href="#" @mouseenter="selectOption(key)"
                           ref="items"
                           @click="toggleOption(option)"
                           v-for="(option, key) in options"
                           :id="'listbox-option-' + key"
                           role="option"
                           class="block cursor-default select-none relative py-2 pl-3 pr-9 text-gray-900 focus:text-white focus:bg-indigo-600 hover:no-underline">
                            <span class="block truncate"
                                  :class="optionIsSelected(option)? 'font-semibold':'font-normal'"
                                  v-text="option.label"/>
                            <span v-show="optionIsSelected(option)"
                                  class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor"
                                     aria-hidden="true">
                                  <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </a>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    name: "MultiSelect",
    props: ['value', 'options', 'name', 'label'],

    data() {
        return {
            selectedIndex: -1,
            selected: false,
            selectedOptions: this.value,
        }
    },
    computed: {
        selectedText() {
            if (this.selectedOptions.length === 0) return "No selection";
            return this.selectedOptions.map((option) => option.label).join(',')
        },
        selectedValues() {
            return this.selectedOptions.map((option) => option.value);
        }
    },
    methods: {
        selectOption(key) {
            this.selectedIndex = key;
            this.$refs.items[key].focus();
        },
        toggleOption(option) {
            let index = this.selectedOptions.indexOf(option);

            if (index !== -1) {
                this.selectedOptions.splice(index, 1);
            } else {
                this.selectedOptions.push(option);
            }
            this.$emit('input', this.selectedValues);
        },
        selectNext() {
            this.selectedIndex += 1;
            if (this.selectedIndex >= this.$refs.items.length) {
                this.selectedIndex = 0;
            }
            this.$refs.items[this.selectedIndex].focus();
        },
        selectPrev() {
            this.selectedIndex -= 1;
            if (this.selectedIndex < 0) {
                this.selectedIndex = this.$refs.items.length - 1;
            }
            this.$refs.items[this.selectedIndex].focus();
        },
        toggleItem() {
            this.toggleOption(this.options[this.selectedIndex]);
        },
        optionIsSelected(option) {
            return this.selectedOptions.indexOf(option) !== -1;
        }
    }
}
</script>
<style lang="sass">
.no-hover > a:hover
    text-decoration: none
    color: unset
</style>
