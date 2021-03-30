<template>
    <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="py-2">
            <nav class="block">
                <ul class="flex pl-0 rounded list-none flex-wrap">
                    <li v-if="pagination.prev_page_url">
                        <inertia-link :href="pagination.prev_page_url" 
                            class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-teal-500 bg-white text-teal-500">
                            Prev
                        </inertia-link>
                    </li>
                    <li v-for="page in pages" :key="page">
                        <inertia-link :href="pagination.path + '?page=' + page" 
                        class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-teal-500"
                        :class="(page == pagination.current_page) ? 'text-white bg-teal-500': 'bg-white text-teal-500'">
                        {{ page }}
                        </inertia-link>
                    </li>
                    <li v-if="pagination.next_page_url">
                        <inertia-link :href="pagination.next_page_url" 
                            class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-teal-500 bg-white text-teal-500">
                            Next
                        </inertia-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        pagination: {
            type: Object,
            required: true
        },
        offset: {
            type: Number,
            default: 4
        }
    },
    computed: {
        pages() {
            if (!this.pagination.to) {
                return null;
            }
            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            let pages = [];
            for (let page = from; page <= to; page++) {
                pages.push(page);
            }
            return pages;
        },
    },
        
}
</script>