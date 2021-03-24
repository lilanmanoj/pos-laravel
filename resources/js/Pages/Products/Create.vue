<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Product
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <el-form ref="form" :model="form" label-width="160px">
                        <el-form-item label="Code">
                            <el-input placeholder="Enter product code" name="code" v-model="form.code"></el-input>
                        </el-form-item>

                        <el-form-item label="Name">
                            <el-input placeholder="Enter product name" name="name" v-model="form.name"></el-input>
                        </el-form-item>

                        <el-form-item label="Note">
                            <el-input type="textarea" :rows="2" placeholder="Enter product note" name="note" v-model="form.note"></el-input>
                        </el-form-item>

                        <el-form-item label="Product Type">
                            <el-select v-model="form.product_type_id" placeholder="Select product type">
                                <el-option
                                v-for="type in product_types"
                                :key="type.id"
                                :label="type.name"
                                :value="type.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="Measurable">
                            <el-switch v-model="form.is_measurable"></el-switch>
                        </el-form-item>

                        <el-form-item label="Barcode Prefix">
                            <el-input placeholder="Enter barcode prefix" name="barcode_prefix" v-model="form.barcode_prefix"></el-input>
                        </el-form-item>

                        <el-form-item label="Unit">
                            <el-select v-model="form.unit_id" placeholder="Select unit">
                                <el-option
                                v-for="unit in units"
                                :key="unit.id"
                                :label="unit.name"
                                :value="unit.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="Unit Price">
                            <el-input placeholder="Enter unit price" name="unit_price" v-model="form.unit_price"></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="warning" @click="cancel"><i class="el-icon-close el-icon-left text-red-500"></i> Cancel</el-button>
                            <el-button type="primary" @click="submit"><i class="el-icon-check el-icon-left text-green-300"></i> Create</el-button>
                        </el-form-item>
                    </el-form>
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
            product_types: Array,
            units: Array
        },
        data() {
            return {
                form: {
                    code: '',
                    name: '',
                    note: '',
                    product_type_id: 1,
                    is_measurable: true,
                    barcode_prefix: '',
                    unit_id: 1,
                    unit_price: ''
                }
            }
        },
        methods: {
            submit() {
                this.$inertia.post(route('products.store'), this.form);
            },
            cancel() {
                this.$inertia.get(route('products.index'));
            }
        }
    }
</script>