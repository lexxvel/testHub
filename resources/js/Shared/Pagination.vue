<template>
    <div v-if="links.length > 3" class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p v-if="from !== total" class="text-sm text-gray-700">
                Отображены
                <span class="font-medium">{{from}}</span>
                -
                <span class="font-medium">{{to}}</span>
                из
                <span class="font-medium">{{total}}</span>
            </p>

            <p v-if="from === total" class="text-sm text-gray-700">
                Отображен
                <span class="font-medium">{{from}}</span>
                из
                <span class="font-medium">{{total}}</span>
            </p>
        </div>
        <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                <Link v-for="(link, k) in links" 
                :key="k" v-html="link.label" 
                :href="link.url" 
                :disabled="link.url === null"
                :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active, 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !(link.active)}"
                aria-current="page" 
                class="relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium focus:z-20"></Link>
            </nav>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link
    },
    props: {
        links: Array, 
        from: Number,
        to: Number,
        total: Number
    }
    
}
</script>

<style>
    a[disabled=true] {
        color: darkgray;
        border-color: darkgray;
    }
</style>