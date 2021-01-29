<template>
    <div class="editor" @click="focusEditor">
        <editor-menu-bar
            v-if="!readOnly"
            @update="$toast.open('changed')"
            :editor="editor"
            v-slot="{ commands, isActive }"
            v-model="value"
        >
            <div class="menubar">
                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.bold() }"
                    @click="commands.bold"
                >
                    <icon name="bold" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.italic() }"
                    @click="commands.italic"
                >
                    <icon name="italic" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.strike() }"
                    @click="commands.strike"
                >
                    <icon name="strikethrough" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.underline() }"
                    @click="commands.underline"
                >
                    <icon name="underline" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.code() }"
                    @click="commands.code"
                >
                    <icon name="code" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.paragraph() }"
                    @click="commands.paragraph"
                >
                    <icon name="paragraph" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                    @click="commands.heading({ level: 1 })"
                >
                    <icon name="h1" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                    @click="commands.heading({ level: 2 })"
                >
                    <icon name="h2" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                    @click="commands.heading({ level: 3 })"
                >
                    <icon name="h3" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.bullet_list() }"
                    @click="commands.bullet_list"
                >
                    <icon name="list-ul" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.ordered_list() }"
                    @click="commands.ordered_list"
                >
                    <icon name="list-ol" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.blockquote() }"
                    @click="commands.blockquote"
                >
                    <icon name="quote-right" />
                </button>

                <button
                    class="menubar__button"
                    :class="{ 'is-active': isActive.code_block() }"
                    @click="commands.code_block"
                >
                    <icon name="code" />
                </button>

                <button
                    class="menubar__button"
                    @click="commands.horizontal_rule"
                >
                    <icon name="horizontal-rule" />
                </button>

                <button class="menubar__button" @click="commands.undo">
                    <icon name="undo" />
                </button>

                <button class="menubar__button" @click="commands.redo">
                    <icon name="redo" />
                </button>
            </div>
        </editor-menu-bar>
        <editor-content
            class="editor__content h-64 mt-1 p-1 border rounded overflow-y-scroll"
            :editor="editor"
        ></editor-content>
    </div>
</template>

<script>
import Icon from "./icon";
import ImageUpload from "./plugins/ImageUpload";
import { Editor, EditorContent, EditorMenuBar } from "tiptap";
import {
    Blockquote,
    CodeBlock,
    HardBreak,
    Heading,
    HorizontalRule,
    OrderedList,
    BulletList,
    ListItem,
    TodoItem,
    TodoList,
    Bold,
    Code,
    Italic,
    Link,
    Strike,
    Underline,
    History,
    Placeholder
} from "tiptap-extensions";

export default {
    components: {
        EditorContent,
        EditorMenuBar,
        Icon
    },
    props: {
        value: String,
        readOnly: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            editor: null,
            emitAfterOnUpdate: false,
            maxFileSize: 5,
            imageUploadInProgress: false
        };
    },
    mounted() {
        this.editor = new Editor({
            extensions: [
                new Blockquote(),
                new BulletList(),
                new CodeBlock(),
                new HardBreak(),
                new Heading({ levels: [1, 2, 3] }),
                new HorizontalRule(),
                new ListItem(),
                new OrderedList(),
                new TodoItem(),
                new TodoList(),
                new Link(),
                new Bold(),
                new Code(),
                new Italic(),
                new Strike(),
                new Underline(),
                new History(),
                new Placeholder({
                    emptyEditorClass: "is-editor-empty",
                    emptyNodeClass: "is-empty",
                    emptyNodeText: "Write your message...",
                    showOnlyWhenEditable: true,
                    showOnlyCurrent: true
                }),
                new ImageUpload({
                    uploader: async image => {
                        return this.uploadImage(image);
                    }
                })
            ],
            content: this.value,
            editable: !this.readOnly,
            onUpdate: ({ getHTML }) => {
                this.emitAfterOnUpdate = true;
                this.$emit("input", getHTML());
            }
        });
        this.editor.setContent(this.value);
    },
    beforeDestroy() {
        if (this.editor) this.editor.destroy();
    },
    watch: {
        value(val) {
            if (this.emitAfterOnUpdate) {
                this.emitAfterOnUpdate = false;
                return;
            }
            if (this.editor) this.editor.setContent(val);
        },
        imageUploadInProgress() {
            this.editor.options.editable = !this.imageUploadInProgress;
        }
    },
    methods: {
        focusEditor() {
            this.editor.view.dom.focus();
        },
        async uploadImage(selectedFile) {
            console.log("running uploadImage");
            if (selectedFile.size / 1024 / 1024 > this.maxFileSize) {
                this.$toast.open({
                    message:
                        "You cannot upload images larger than " +
                        this.maxFileSize +
                        "Mb",
                    type: "error"
                });
                return;
            }

            if (
                !["image/jpeg", "image/png", "image/gif"].includes(
                    selectedFile.type
                )
            ) {
                this.$toast.open({
                    message: "Invalid file type, must be jpeg, png or gif",
                    type: "error"
                });
                return;
            }

            this.imageUploadInProgress = true;

            // Handle Upload and return URL
            const config = {
                headers: { "content-type": "multipart/form-data" }
            };

            let formData = new FormData();
            formData.append("image", selectedFile);

            try {
                const response = await axios.post(
                    "/image/upload",
                    formData,
                    config
                );
                console.log("Attempting to post to controller");
                console.log("response:");
                console.log(response);
                
                return response.data.url;
            } catch (e) {
                this.$toast.open({
                    message: "Some error occurred uploading the image",
                    type: "error"
                });
            } finally {
                this.imageUploadInProgress = false;
            }
        }
    }
};
</script>
<style lang="scss">
.editor p.is-editor-empty:first-child::before {
    content: attr(data-empty-text);
    float: left;
    color: #aaa;
    pointer-events: none;
    height: 0;
    font-style: italic;
}
</style>
