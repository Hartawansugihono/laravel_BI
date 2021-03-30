<template>
    <ul class="flex list-reset border border-grey-light rounded w-auto font-sans">
        <li v-if="pagination.current_page > 1">
            <inertia-link :href="pagination.prev_page_url" 
                class="block hover:text-white hover:bg-blue text-blue border-r border-grey-light px-3 py-2"
                @click.prevent="change(pagination.current_page -1)">
                Previous
            </inertia-link>
        </li>
        <li v-for="page in pages" :key="page" >
            <inertia-link :href="pagination.path + '?page=' + page" 
            :class="[page == pagination.current_page ? 'text-white bg-blue border-r border-blue':'hover:text-white hover:bg-blue text-blue border-r border-grey-light', 'block px-3 py-2']"
            @click.stop="change(page)">
                {{ page }}
            </inertia-link>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <inertia-link :href="pagination.next_page_url" 
            class="block hover:text-white hover:bg-blue text-blue px-3 py-2" 
            @click.prevent="change(pagination.current_page + 1)">
                Next
            </inertia-link>
        </li>
    </ul>
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
        methods: {
            change: function(page) {
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        }
    }
</script>