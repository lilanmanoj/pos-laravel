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
                    <div class="flex flex-grow flex-col gap-4">
                        <el-input placeholder="Search" v-model="product">
                            <template #prepend>Product</template>
                            <template #append>
                                <el-button icon="el-icon-plus"> Add</el-button>
                            </template>
                        </el-input>

                        <el-input placeholder="Barcode" v-model="barcode">
                            <template #prepend>Scan</template>
                        </el-input>
                    </div>

                    <div class="flex flex-none flex-col flex-wrap gap-6">
                        <button type="button" class="flex-1 p-2 border rounded-md text-sm font-normal tracking-wide border-gray-300 bg-gray-100 text-gray-500"><i class="el-icon-document"></i> New</button>

                        <el-select v-model="value" placeholder="Select">
                            <el-option
                                v-for="item in options"
                                :key="item.value"
                                :label="item.label"
                                :value="item.value">
                            </el-option>
                        </el-select>

                        <button type="button" class="flex-1 p-2 border rounded-md text-sm font-normal tracking-wide border-yellow-300 bg-yellow-100 text-yellow-500"><i class="el-icon-present"></i> Discount</button>

                        <button type="button" class="flex-1 p-2 border rounded-md text-sm font-normal tracking-wide border-blue-300 bg-blue-100 text-blue-500"><i class="el-icon-money"></i> Paid</button>

                        <button type="button" class="flex-1 p-2 border rounded-md text-sm font-normal tracking-wide border-green-300 bg-green-100 text-green-500"><i class="el-icon-printer"></i> Print</button>
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
        data() {
            return {
                options: [
                    {
                        value: 'cash',
                        label: 'Cash'
                    }, 
                    {
                        value: 'card',
                        label: 'Card'
                    }
                ],
                value: '',
                product: '',
                barcode: ''
            }
        }
    }
</script>