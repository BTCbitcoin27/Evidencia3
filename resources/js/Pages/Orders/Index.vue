<template>

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
    <div class="orders">
        <h1>Order Details</h1>

        <!-- Search box -->
        <input type="text" v-model="invoice_number" placeholder="Enter invoice number..." @input="fetchOrder" class="search-box">

        <!-- Display order details -->
        <div v-if="order">
            <div class="order-info">Invoice Number: {{ order.invoice_number }}</div>
            <div class="order-info">Ordered at: {{ order.order_date }}</div>
            <div class="order-info">Customer: {{ order.customer_name }}</div>
            <div class="order-info">Delivery Address: {{ order.delivery_address }}</div>
            <div class="order-info">Status: {{ order.status }}</div>
            <!-- Add more order details here -->
        </div>
        <div v-else>
            <p v-if="invoice_number">No order found for invoice number: {{ invoice_number }}</p>
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
    components: {Link, ApplicationLogo, Dropdown, DropdownLink, NavLink},
    data() {
        return {
            invoice_number: '',
            order: null
        };
    },
    methods: {
        fetchOrder() {
            if (!this.invoice_number) {
                this.order = null;
                return;
            }
            axios.get(`/orders/${this.invoice_number}`)
                .then(response => {
                    this.order = response.data;
                })
                .catch(error => {
                    console.error('Error fetching order:', error);
                    this.order = null;
                });
        }
    }
};
</script>

<style scoped>
.orders {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    color: #333;
}

h1 {
    color: #444;
    text-align: center;
    padding-bottom: 20px;
    font-size: 2.5em;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.search-box {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 20px;
}

.order-info {
    padding: 10px 0;
    font-size: 1.2em;
}

.order-info {
    background-color: #f8f8f8;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

.order-info:nth-child(even) {
    background-color: #e9f6e9;
}

.search-box {
    width: 100%;
    padding: 15px 20px;
    margin: 10px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    transition: 0.3s;
}

.search-box:focus {
    border-color: #4CAF50;
    background-color: #e9f6e9;
}

p {
    color: red;
}

/* Add your additional CSS styles here */
.nav-links {
    display: flex;
    justify-content: space-between;
}
</style>
