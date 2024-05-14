<template>
    <div class="container">
        <div class="header">
            <h1>Admin Dashboard</h1>
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
            <button @click="goToCreateUser">Create New User</button>
        </div>
        <div>
            <h1>Registered Users</h1>
            <ul>
                <li v-for="user in users" :key="user.id">
                    {{ user.name }} - {{ user.email }} - {{ user.role }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import NavLink from "@/Components/NavLink.vue";

export default {
    name: 'AdminIndex',
    components: {NavLink},
    methods: {
        goToCreateUser() {
            // Navigate to the user creation form
            this.$inertia.visit('/admin/create');
        }
    },

    props: {
        users: Array,
    },
}
</script>

<style scoped>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

h1 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    justify-content: center;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
}

.header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 20px;
    background-color: #f5f5f5;
}

ul {
    list-style-type: none;
    padding: 0;
    width: 100%;
}

ul li {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    transition: background-color 0.3s ease;
}

ul li:hover {
    background-color: #f5f5f5;
}

button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    transition-duration: 0.4s;
}

button:hover {
    background-color: #45a049;
}
</style>
