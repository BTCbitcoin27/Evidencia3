<template>
    <div class="orders">
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
        </div>
        <h1>Order Details</h1>

        <!-- Search box -->
        <input type="text" v-model="invoice_number" placeholder="Enter invoice number..." @input="fetchOrder">

        <!-- Display order details -->
        <div v-if="order">
            <div>Invoice Number: {{ order.invoice_number }}</div>
            <div>Ordered at: {{ order.order_date }}</div>
            <div>Customer: {{ order.customer_name }}</div>
            <div>Delivery Address: {{ order.delivery_address }}</div>
            <div>Status: {{ order.status }}</div>
            <!-- Add more order details here -->
        </div>
        <div v-else>
            <p v-if="invoice_number">No order found for invoice number: {{ invoice_number }}</p>
        </div>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";

export default {
    components: {NavLink},
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

input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 20px;
}

div {
    padding: 10px 0;
    font-size: 1.2em;
}

div div {
    background-color: #f8f8f8;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
}

div div:nth-child(even) {
    background-color: #e9f6e9;
}

input[type="text"] {
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

input[type="text"]:focus {
    border-color: #4CAF50;
    background-color: #e9f6e9;
}

p {
    color: red;
}

/* Add your additional CSS styles here */
</style>
