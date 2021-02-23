<template>
    <div class="pr-3 h-full text-xl overflow-y-scroll">
        <template v-for="(note,index) in notes.data">
            <formatted-date :value="note.created_at" class="italic text-xs mb-1"></formatted-date>
            <div class="relative">
                <div class="editor__content rounded-lg bg-white shadow border px-3 py-2 pt-4 text-sm text-gray-900 mb-4"
                     v-html="note.note"></div>
                <div class="flex absolute top-0 right-0 mt-2 mr-2">
                    <button title="Edit note"
                        class="h-6 w-6 flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-md focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-yellow-500">
                        <i class="fas fa-pencil fa-xs"></i></button>
                    <button title="Delete note"
                        class="h-6 w-6 flex items-center justify-center ml-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-md focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-red-500">
                        <i class="fas fa-trash fa-xs"></i></button>
                </div>
            </div>
        </template>
    </div>
</template>
<script>
export default {
    props: ['notes']
}
</script>
