<template>
    <div>
        <h1>Create New User</h1>
        <form @submit.prevent="createUser">
            <!-- Form fields for user creation -->
            <input v-model="name" placeholder="Name" required>
            <input v-model="email" placeholder="Email" required>
            <input v-model="password" placeholder="Password" required>
            <input v-model="role" placeholder="Role" required>
            <button type="submit">Create User</button>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            role: '',
        }
    },
    methods: {
        createUser() {
            this.$inertia.post('/admin', {
                name: this.name,
                email: this.email,
                password: this.password,
                role: this.role,
            });
        }
    }
}
</script>

<style scoped>
</style>
