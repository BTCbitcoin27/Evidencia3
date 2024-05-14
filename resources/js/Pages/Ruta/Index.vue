<!-- resources/js/Pages/Route/Index.vue -->

<!-- resources/js/Pages/Route/Index.vue -->

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
