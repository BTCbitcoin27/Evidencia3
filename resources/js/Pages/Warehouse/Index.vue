<!-- resources/js/Pages/Warehouse/Index.vue -->

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";

// Define props
const props = defineProps(['orders']);

// Define form for each order
const forms = props.orders.map(order => {
    return {
        form: useForm({
            status: order.status,
        }),
        editing: ref(false),
    };
});

// Define updateOrderStatus method
const updateOrderStatus = async (order, form) => {
    const newStatus = 'In Process';
    if (form && form.status) {
        try {
            form.status = newStatus;
            await axios.put(`/warehouse/${order.id}`, { status: newStatus });
            order.status = newStatus;
        } catch (error) {
            console.error(error);
        }
    }
};
</script>

<template>
    <div>
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
        <h1 class="text-center">Warehouse Panel</h1>
        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Invoice Number</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Change Status</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(order, index) in orders" :key="order.id">
                <td>{{ order.id }}</td>
                <td>{{ order.invoice_number }}</td>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.status }}</td>
                <td>
                    <button @click="updateOrderStatus(order, forms[index].form)">Change to In Process</button>
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
