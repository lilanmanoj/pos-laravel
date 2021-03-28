<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-start-1">
                            <el-button round type="primary" size="medium" @click="addNew"><i class="el-icon-plus el-icon-left"></i> Add New</el-button>
                        </div>
                        <div class="col-end-7 col-span-2">
                            <el-input
                                placeholder="Search"
                                prefix-icon="el-icon-search"
                                v-model="input2">
                            </el-input>
                        </div>
                    </div>

                    <el-table
                        class="my-4"
                        :data="items.data"
                        stripe
                        style="width: 100%">
                        <el-table-column
                            prop="code"
                            label="Code"
                            width="160">
                        </el-table-column>
                        <el-table-column
                            prop="name"
                            label="Name">
                        </el-table-column>
                        <el-table-column
                            prop="unit_price"
                            label="Unit Price"
                            align="right"
                            width="160">
                        </el-table-column>
                        <el-table-column
                            prop="product_type.name"
                            label="Type"
                            width="180">
                        </el-table-column>
                        <el-table-column
                            fixed="right"
                            label="Actions"
                            width="120">
                                <template #default="scope">
                                    <el-button round size="small"><i class="el-icon-edit el-icon-left"></i> Edit</el-button>
                                    <el-button type="text" size="small"><i class="el-icon-delete text-red-600"></i></el-button>
                                </template>
                        </el-table-column>
                    </el-table>

                    <div class="flex justify-end">
                        <div class="flex-grow-0">
                            <el-pagination
                                background
                                layout="prev, pager, next"
                                :page-size="items.per_page"
                                :total="items.total"
                                :current-page="items.current_page"
                                @current-change="changePage"
                                @prev-click="prevClicked"
                                @next-click="nextClicked">
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },
        props: {
            items: Array,
        },
        methods: {
            addNew() {
                this.$inertia.get(route('products.create'));
            },
            changePage(e) {
                this.$inertia.get(route('products.index'), { page: e });
            },
            prevClicked() {
                this.$inertia.get(this.items.prev_page_url);
            },
            nextClicked() {
                this.$inertia.get(this.items.next_page_url);
            }
        }
    }
</script>
