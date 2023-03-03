<template>
    <li class="ddLi hover:bg-gray-100"
        :class="{'bg-blue-100 hover:bg-blue-100': version===selected}"
    >
        <div style="display: block; height: 40px; width: 100%">
            <a @click="select()" style="text-decoration:none; height: auto; display: block"
               class="dropdown-item text-sm  px-4 font-normal block w-full whitespace-nowrapbg-transparent text-gray-700 hover:bg-gray-100 "
               href="#"
            >
                <div style="width: 100%; height: 20px; float: left; display: block">
                    Версия #{{version}}
                </div>
                <div style="width: 100%; height: 20px; float: left; display: block">
                    <div style="width: 50%; height: 20px; float: left; display: block">
                        Создан: {{ createDate }}
                    </div>
                    <div style="width: 50%; height: 20px; float: left; display: block">
                        Автор: {{ author }}
                    </div>
                </div>
            </a>
        </div>
    </li>
</template>

<script>
export default {
    /**
     * Для дропдаунов в 2 строки версии
     */
    name: "TwoLineOption",
    props: {
        createDate: String,
        author: String,
        version: Number,
        selected: Number
    },
    methods: {
        select: function() {
            if (this.version !== this.selected) {
                this.$emit('select-version', this.version)
            }
        },
    }
}
</script>

<style scoped>
    .ddLi {
        min-height: 20px;height: 40px; display: block; width: 100%
    }
</style>
