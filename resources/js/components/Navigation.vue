<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="15"
                            alt="MDB Logo" loading="lazy" />
                    </a>
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link v-if="auth" class="nav-link" to="/todo">TodoList</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="auth" class="nav-link" to="/example-component">Example</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="!auth" class="nav-link" to="/Register">Register</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link v-if="!auth" class="nav-link" to="/Login">Login</router-link>
                        </li>
                        <button v-if="auth" type="button" class="btn btn-danger" @click="logout()">Logout</button>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        computed: {
            auth: function() {
                let token = localStorage.getItem('token');
                return token ? true : false;
            }
        },

        mounted() {

        },
        methods: {
            logout: function() {
                let vue = this;
                let token = localStorage.getItem('token');
                axios.get('/api/logout', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                }).then(function(response) {
                    if (response.status) {
                        localStorage.removeItem('token');
                        vue.$emit('updateComponent');
                        vue.$router.push('/login');
                    }
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    }

</script>
