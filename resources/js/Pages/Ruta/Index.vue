<!-- resources/js/Pages/Route/Index.vue -->

<!-- resources/js/Pages/Route/Index.vue -->

<script setup>
import { ref } from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

// Define props
const props = defineProps(['orders']);

// Define form for each order
const forms = props.orders.map(order => {
    return {
        form: useForm({
            status: order.status,
            image1: null,
            image2: null,
        }),
        editing: ref(false),
    };
});

// Define uploadImage method
const uploadImage = async (order, form, imageNumber) => {
    if (form && form[`image${imageNumber}`]) {
        let formData = new FormData();
        formData.append('image', form[`image${imageNumber}`]);
        try {
            await axios.post(`/ruta/${order.id}/upload${imageNumber}`, formData);
            order.status = imageNumber === 1 ? 'In route' : 'Delivered';
        } catch (error) {
            console.error(error);
        }
    }
};
</script>

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
        <h1 class="text-center">Route Panel</h1>
        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Upload Image 1</th>
                <th>Upload Image 2</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(order, index) in orders" :key="order.id">
                <td>{{ order.id }}</td>
                <td>{{ order.invoice_number }}</td>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.status }}</td>
                <td>
                    <input type="file" @change="forms[index].form.image1 = $event.target.files[0]">
                    <button @click="uploadImage(order, forms[index].form, 1)">Upload Image 1</button>
                </td>
                <td>
                    <input type="file" @change="forms[index].form.image2 = $event.target.files[0]">
                    <button @click="uploadImage(order, forms[index].form, 2)">Upload Image 2</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
/* Estilos CSS para el titulo */
h1 {
    color: #333;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
</style>
