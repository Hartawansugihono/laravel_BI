<template>
    <admin>
        <div class="flex flex-wrap mt-4">
            <div class="w-full mb-12 px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded"
                        :class="[color === 'light' ? 'bg-white' : 'bg-emerald-900 text-white']">
                    <div class="rounded-t mb-0 px-4 py-3 border-0">
                        <div class="flex flex-wrap items-center">
                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                                <h3 class="font-semibold text-lg"
                                    :class="[color === 'light' ? 'text-blueGray-700' : 'text-white']">
                                    Product
                                </h3>
                            </div>
                            <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <!-- Projects table -->
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="Object.entries(errors).length">
                        <div class="flex">
                            <div>
                            <p class="text-sm text-red-500" v-html="errorMessage(errors)"></p>
                            </div>
                        </div>
                        </div>
                        
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">No.</th>
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Name</th>
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Price</th>
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Amount</th>
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Qty</th>
                                    <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left"
                                    :class="[
                                        color === 'light'
                                        ? 'bg-blueGray-50 text-blueGray-500 border-blueGray-100'
                                        : 'bg-emerald-800 text-emerald-300 border-emerald-700',
                                    ]">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in data.data" :key="row.id">
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ row.id }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ row.name }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ row.price }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ row.amount }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">{{ row.qty }}</td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                        <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-1">Edit</button>
                                        <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-1">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :pagination="data" :offset="4" />
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" placeholder="Enter Name" v-model="form.name">
                                        <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" placeholder="Enter Price" v-model="form.price">
                                        <div class="text-red-500" v-if="errors.price">{{ errors.price }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" placeholder="Enter Amount" v-model="form.amount">
                                        <div class="text-red-500" v-if="errors.amount">{{ errors.amount }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Qty:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qty" placeholder="Enter Qty" v-model="form.qty">
                                        <div class="text-red-500" v-if="errors.qty">{{ errors.qty }}</div>
                                    </div>
                                </div>
                                <div class="" v-if="category.data">
                                    <div class="mb-4">
                                        <label for="product_category_id" class="block text-gray-700 text-sm font-bold mb-2">Product Category:</label>
                                        <select id="product_category_id" v-model="form.product_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option v-for="item in category.data" :key="item.id" :value="item.id">{{ item.name }}</option>
                                        </select>
                                        
                                        <!-- <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qty" placeholder="Enter Qty" v-model="form.qty"> -->
                                        <div class="text-red-500" v-if="errors.product_category_id">{{ errors.product_category_id }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">
                                    Save
                                </button>
                                </span>
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">
                                    Update
                                </button>
                                </span>
                                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                
                                <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancel
                                </button>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>

                        </div>
                    </div>
            </div>
            <div class="w-full mb-12 px-4">
            </div>
        </div>

        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product
            </h2>
        </template> -->

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="Object.entries(errors).length">
                      <div class="flex">
                        <div>
                          <p class="text-sm text-red-500" v-html="errorMessage(errors)"></p>
                        </div>
                      </div>
                    </div>
                    <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20">No.</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Qty</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data.data" :key="row.id">
                                <td class="border px-4 py-2">{{ row.id }}</td>
                                <td class="border px-4 py-2">{{ row.name }}</td>
                                <td class="border px-4 py-2">{{ row.price }}</td>
                                <td class="border px-4 py-2">{{ row.amount }}</td>
                                <td class="border px-4 py-2">{{ row.qty }}</td>
                                <td class="border px-4 py-2">
                                    <button @click="edit(row)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <button @click="deleteRow(row)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        
                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                      
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                        <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" placeholder="Enter Name" v-model="form.name">
                                        <div class="text-red-500" v-if="errors.name">{{ errors.name }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" placeholder="Enter Price" v-model="form.price">
                                        <div class="text-red-500" v-if="errors.price">{{ errors.price }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="amount" placeholder="Enter Amount" v-model="form.amount">
                                        <div class="text-red-500" v-if="errors.amount">{{ errors.amount }}</div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="mb-4">
                                        <label for="qty" class="block text-gray-700 text-sm font-bold mb-2">Qty:</label>
                                        <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qty" placeholder="Enter Qty" v-model="form.qty">
                                        <div class="text-red-500" v-if="errors.qty">{{ errors.qty }}</div>
                                    </div>
                                </div>
                                <div class="" v-if="category.data">
                                    <div class="mb-4">
                                        <label for="product_category_id" class="block text-gray-700 text-sm font-bold mb-2">Product Category:</label>
                                        <select id="product_category_id" v-model="form.product_category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            <option v-for="item in category.data" :key="item.id" :value="item.id">{{ item.name }}</option>
                                        </select>
                                        
                                        <div class="text-red-500" v-if="errors.product_category_id">{{ errors.product_category_id }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">
                                    Save
                                </button>
                                </span>
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">
                                    Update
                                </button>
                                </span>
                                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                
                                <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                    Cancel
                                </button>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div> -->
    </admin>
</template>

<script>
    import Admin from '@/Layouts/Admin'
    import Pagination from '@/Components/Pagination'
    import { errorMessage } from "@/helpers";
    
    export default {
        components: {
            Admin,
            Pagination
        },
        props: ['data', 'errors'],
        data() {
            return {
                editMode: false,
                isOpen: false,
                form: {
                    name: null,
                },
                category: {},
            }
        },
        beforeMount() {
            this.getCategory();
        },
        methods: {
            openModal() {
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
                this.reset();
                this.editMode=false;
            },
            reset() {
                this.form = {
                    name: null,
                    body: null,
                }
            },
            save(data) {
                this.$inertia.post('/products', data)
                this.reset();
                this.closeModal();
                this.editMode = false;
                console.log(this.errors)
            },
            edit(data) {
                this.form = Object.assign({}, data);
                this.editMode = true;
                this.openModal();
            },
            update(data) {
                data._method = 'PATCH';
                this.$inertia.post('/products/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            deleteRow(data) {
                if (!confirm('Are you sure want to remove?')) return;
                data._method = 'DELETE';
                this.$inertia.post('/products/' + data.id, data)
                this.reset();
                this.closeModal();
            },
            getCategory() {
                axios.get('/api/product/category').then(response => {
                    this.category = response.data
                });
            },
            errorMessage,
        },
    }
</script>
