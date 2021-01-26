<template>
    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
        <label for="photo" class="block text-sm font-medium text-gray-700">
            Photo
        </label>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            <div class="flex items-center">
                <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <img :src="value" width="48" height="48">
                </span>
                <input type="file"  ref="file" style="display:none" @change="upload">

                <button type="button" @click="selectFile" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Change
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PhotoField",
    props: ['value'],
    methods: {
        selectFile() {
            this.$refs.file.click();
        },
        upload() {
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }

            let formData = new FormData();
            formData.append('image', this.$refs.file.files[0]);

            axios.post('/profile/image', formData, config).then((response) => {
                this.image = response.data.avatar;
                this.$emit('input', response.data.avatar);
            });
        }
    }
}
</script>
