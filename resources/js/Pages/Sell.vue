<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sell
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 flex flex-col md:flex-row gap-4">
                    <div class="flex flex-grow flex-col gap-4 shadow p-4">
                        <el-input placeholder="Search" v-model="product">
                            <template #prepend>Product</template>
                            <template #append>
                                <el-button icon="el-icon-plus"> Add</el-button>
                            </template>
                        </el-input>

                        <el-input placeholder="Barcode" v-model="barcode" ref="barcode" @change="scanBarcode">
                            <template #prepend>
                                <el-button icon="el-icon-aim" @click="focusBarcode">Scan</el-button>
                            </template>
                        </el-input>

                        <el-table
                            border
                            stripe
                            :data="items"
                            style="width: 100%">
                                <el-table-column
                                    prop="item_no"
                                    label="Item #"
                                    width="80"
                                    align="center">
                                </el-table-column>
                                <el-table-column
                                    prop="name"
                                    label="Item">
                                </el-table-column>
                                <el-table-column
                                    prop="qty"
                                    label="Qty"
                                    width="120"
                                    align="center">
                                </el-table-column>
                                <el-table-column
                                    prop="unit_price"
                                    label="Unit Price"
                                    width="140"
                                    align="right">
                                </el-table-column>
                                <el-table-column
                                    prop="total"
                                    label="Total"
                                    width="140"
                                    align="right">
                                </el-table-column>
                        </el-table>

                        <div class="w-full border border-blue-300 rounded p-4 tracking-wide">
                            <h2 class="font-bold text-gray-600">Payment</h2>

                            <div class="grid grid-cols-6 gap-2 mt-3 text-gray-700">
                                <div>Total Lines</div>
                                <div>{{ total_lines }}</div>

                                <div class="col-start-4 col-span-2 text-right">Sub Total</div>
                                <div class="text-right">{{ sub_total }}</div>

                                <div class="col-start-4 col-span-2 text-right">Discount</div>
                                <div class="text-right">0.00</div>

                                <div class="col-start-4 col-span-2 text-right font-extrabold">Total</div>
                                <div class="text-right font-extrabold">{{ total }}</div>
                            </div>

                            <hr class="my-5">

                            <div class="grid grid-cols-6 gap-2 mt-3 text-gray-700">
                                <div class="bg-green-300 text-gray-800 font-extrabold text-center border border-green-500 rounded py-2">Cash</div>

                                <div class="col-start-4 col-span-2 text-right">Paid</div>
                                <div class="text-right">1000.00</div>

                                <div class="col-start-4 col-span-2 text-right font-bold text-xl">Balance</div>
                                <div class="text-right font-bold text-xl">30.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-none flex-col flex-wrap gap-6">
                        <button @click="newSale" type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-gray-300 bg-gray-100 text-gray-500"><i class="el-icon-document"></i> New</button>

                        <el-select v-model="payment_method" placeholder="Select">
                            <el-option
                                v-for="method in methods"
                                :key="method.value"
                                :label="method.label"
                                :value="method.value">
                            </el-option>
                        </el-select>

                        <button type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-yellow-300 bg-yellow-100 text-yellow-500"><i class="el-icon-present"></i> Discount</button>

                        <button type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-blue-300 bg-blue-100 text-blue-500"><i class="el-icon-money"></i> Paid</button>

                        <button type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-green-300 bg-green-100 text-green-500"><i class="el-icon-printer"></i> Print</button>
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
            methods: Array,
            total_lines: Number,
            sub_total: Number,
            total: Number
        },
        data() {
            return {
                payment_method: 'cash',
                product: '',
                barcode: ''
            }
        },
        methods: {
            newSale() {
                this.$inertia.get(route('sales.create'));
            },
            focusBarcode() {
                this.$refs.barcode.focus();
            },
            scanBarcode() {
                let data = {
                    'items': this.items
                };

                this.$inertia.post(route('sales.products.barcode', this.barcode), data, {
                    onFinish: () => {
                        this.barcode = "";
                    }
                });
            }
        },
        mounted() {
            this.focusBarcode();
        }
    }
</script>