<template>
    <div class="form-container">
        <h1>Create New User</h1>
        <form @submit.prevent="createUser" class="form">
            <!-- Form fields for user creation -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input v-model="name" id="name" type="text" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input v-model="email" id="email" type="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input v-model="password" id="password" type="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <input v-model="role" id="role" type="text" placeholder="Role" required>
            </div>
            <button type="submit" class="btn">Create User</button>
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

.form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f3f3f3;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
}

.form-group input[type="text"],
.form-group input[type="email"],
.form-group input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    padding: 10px 20px;
    background-color: #0073E6;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn:hover {
    background-color: #0056b3;
}
</style>
