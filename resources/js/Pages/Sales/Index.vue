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
        <h1 class="text-center">Sales Panel</h1>

        <!-- Botón para crear una nueva orden -->
        <div class="text-center mb-4">
            <button @click="goToCreateOrder" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Order
            </button>
        </div>

        <!-- Lista de órdenes -->
        <div v-if="orders.length">
            <table class="table-auto w-full">
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

export default {
    name: 'SalesIndex',
    components: {NavLink},
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
/* Estilos CSS para el titulo */
h1 {
    color: #333;
    font-size: 2rem;
    margin-bottom: 1rem;
}

/* Estilos CSS para la tabla */
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
