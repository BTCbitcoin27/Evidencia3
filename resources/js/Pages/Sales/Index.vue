<template>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                            <ApplicationLogo
                                class="block h-9 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </NavLink>
                        <NavLink :href="route('admin.index')" :active="route().current('chirps.index')">
                            Admin Panel
                        </NavLink>
                        <NavLink :href="route('orders.index')" :active="route().current('orders.index')">
                            Ordenes
                        </NavLink>
                        <NavLink :href="route('sales.index')" :active="route().current('sales.index')">
                            Sales
                        </NavLink>
                        <nav-link :href="route('warehouse.index')" :active="route().current('warehouse.index')">
                            Warehouse
                        </nav-link>
                        <nav-link :href="route('ruta.index')" :active="route().current('ruta.index')">
                            Ruta
                        </nav-link>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <h1 class="header">Sales Panel</h1>

        <!-- Botón para crear una nueva orden -->
        <div class="text-center mb-4">
            <button @click="goToCreateOrder" class="btn-primary">
                Create Order
            </button>
        </div>

        <!-- Lista de órdenes -->
        <div v-if="orders.length">
            <table class="table-auto">
                <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Invoice Number</th>
                    <th class="px-4 py-2">Customer Name</th>
                    <th class="px-4 py-2">Customer Number</th>
                    <th class="px-4 py-2">Order Date</th>
                    <th class="px-4 py-2">Delivery Address</th>
                    <th class="px-4 py-2">Notes</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td class="border px-4 py-2">{{ order.id }}</td>
                    <td class="border px-4 py-2">{{ order.invoice_number }}</td>
                    <td class="border px-4 py-2">{{ order.customer_name }}</td>
                    <td class="border px-4 py-2">{{ order.customer_number }}</td>
                    <td class="border px-4 py-2">{{ order.order_date }}</td>
                    <td class="border px-4 py-2">{{ order.delivery_address }}</td>
                    <td class="border px-4 py-2">{{ order.notes }}</td>
                    <td class="border px-4 py-2">{{ order.status }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-else>
            <p>No orders found.</p>
        </div>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'SalesIndex',
    components: {Link, ApplicationLogo, Dropdown, DropdownLink, NavLink},
    methods: {
        goToCreateOrder() {
            // Navigate to the order creation form
            this.$inertia.visit('/sales/create');
        }
    },
    props: {
        orders: Array,
    },
    // Tu lógica de componente aquí
};
</script>

<style scoped>
/* Header styles */
.header {
    color: #ffffff;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* Button styles */
.btn-primary {
    padding: 10px 20px;
    background-color: #0073E6;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Table styles */
.table-auto {
    width: 100%;
    margin-bottom: 1rem;
}

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.border {
    border: 1px solid #ddd;
}
</style>
