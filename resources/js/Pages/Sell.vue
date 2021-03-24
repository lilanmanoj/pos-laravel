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
                                <div class="bg-green-300 text-gray-800 font-extrabold text-center border border-green-500 rounded py-2">{{ payment_method_name }}</div>

                                <div class="col-start-4 col-span-2 text-right">Paid</div>
                                <div class="text-right">{{ paid }}</div>

                                <div class="col-start-4 col-span-2 text-right font-bold text-xl">Balance</div>
                                <div class="text-right font-bold text-xl">{{ update_balance }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-none flex-col flex-wrap gap-6">
                        <button @click="newSale" type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-gray-300 bg-gray-100 text-gray-500"><i class="el-icon-document"></i> New</button>

                        <el-select v-model="payment_method_code" placeholder="Select" @change="changeMethod">
                            <el-option
                                v-for="method in methods"
                                :key="method.value"
                                :label="method.label"
                                :value="method.value">
                            </el-option>
                        </el-select>

                        <button type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-yellow-300 bg-yellow-100 text-yellow-500"><i class="el-icon-present"></i> Discount</button>

                        <button @click="openPayment" type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-blue-300 bg-blue-100 text-blue-500"><i class="el-icon-money"></i> Paid</button>

                        <button type="button" class="flex-none p-2 border rounded-md text-sm font-normal tracking-wide border-green-300 bg-green-100 text-green-500"><i class="el-icon-printer"></i> Print</button>
                    </div>
                </div>

                <el-dialog
                    title="Payment"
                    v-model="open_paid_dialog"
                    width="30%">
                        <el-input placeholder="Enter payment" v-model="paid" ref="payment" @keyup="onEnterPaid"></el-input>
                        <template #footer>
                            <span class="dialog-footer">
                            <el-button type="primary" @click="closePayment">Ok</el-button>
                            </span>
                        </template>
                </el-dialog>
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
            sub_total: String,
            total: String,
            paid: String,
            balance: String
        },
        data() {
            return {
                payment_method_code: 'cash',
                payment_method_name: 'Cash',
                product: '',
                barcode: '',
                open_paid_dialog: false,
                update_balance: this.balance
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
                    'items': this.items,
                    'paid': this.paid,
                    'balance': this.update_balance
                };

                this.$inertia.post(route('sales.products.barcode', this.barcode), data, {
                    onFinish: () => {
                        this.barcode = "";
                    }
                });
            },
            changeMethod() {
                switch (this.payment_method_code) {
                    case "cash":
                        this.payment_method_name = "Cash";
                    break;

                    case "card":
                        this.payment_method_name = "Card";
                    break;
                }
            },
            openPayment() {
                this.open_paid_dialog = true;
            },
            closePayment() {
                this.open_paid_dialog = false;
                this.focusBarcode();
            },
            onEnterPaid() {
                let bal = this.paid - this.total;
                this.update_balance = bal.toFixed(2);
            }
        },
        mounted() {
            this.focusBarcode();
        }
    }
</script>