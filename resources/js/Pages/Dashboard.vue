<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                    <h2 class="mt-4 ml-2 font-semibold text-gray-500 text-xl">Shortcuts</h2>
                    <hr>
                    <div class="grid grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
                        <inertia-link :href="route('sales.create')" class="bg-blue-400 py-8 px-2 rounded-lg text-white font-black text-2xl text-center shadow-md"><i class="el-icon-shopping-cart-1"></i> Sell</inertia-link>
                        <inertia-link :href="route('products.index')" class="bg-blue-400 py-8 px-2 rounded-lg text-white font-black text-2xl text-center shadow-md"><i class="el-icon-box"></i> Products</inertia-link>
                        <inertia-link :href="route('dashboard')" class="bg-blue-400 py-8 px-2 rounded-lg text-white font-black text-2xl text-center shadow-md"><i class="el-icon-truck"></i> Inventory</inertia-link>
                        <inertia-link :href="route('dashboard')" class="bg-blue-400 py-8 px-2 rounded-lg text-white font-black text-2xl text-center shadow-md"><i class="el-icon-user"></i> Users</inertia-link>
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
    }
</script>
