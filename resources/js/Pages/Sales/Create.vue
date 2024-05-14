<template>
    <div>
        <h1>New Order</h1>
        <form @submit.prevent="submitOrder">
            <input v-model="form.invoice_number" placeholder="Invoice Number" required>
            <input v-model="form.customer_name" placeholder="Customer Name" required>
            <input v-model="form.customer_number" placeholder="Customer Number" required>
            <input type="date" v-model="form.order_date" placeholder="Order Date" required>
            <textarea v-model="form.delivery_address" placeholder="Delivery Address" required></textarea>
            <textarea v-model="form.notes" placeholder="Notes"></textarea>
            <button type="submit">Create Order</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                invoice_number: '',
                customer_name: '',
                customer_number: '',
                order_date: '',
                delivery_address: '',
                notes: '',
            }
        };
    },
    methods: {
        submitOrder() {
            this.$inertia.post('/sales', this.form);
        }
    }
};
</script>

<style scoped>
h1 {
    color: #333;
    font-size: 2rem;
    margin-bottom: 1rem;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 500px;
    margin: 0 auto;
}

form input, form textarea {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
}

form button {
    background-color: #45a049;
    color: white;
    padding: 0.5rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition-duration: 0.4s;
}

form button:hover {
    background-color: #34a344;
}
</style>
