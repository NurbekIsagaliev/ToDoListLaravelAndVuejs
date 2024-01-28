<template>
    <div class="container">
        <form>
            <div class="mb-3">
                <label for="registerName" class="form-label">Имя</label>
                <input type="text" class="form-control" id="registerName" aria-describedby="nameHelp"
                placeholder="Введите свое имя..." v-model="name">
                <div id="nameHelp" class="form-text">Имя Вашего пользователя</div>
            </div>
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp"
                placeholder="Введите свой Email..." v-model="email">
                <div id="emailHelp" class="form-text">Email Вашего пользователя. Мы не будем его сообщать третьим лицам</div>
            </div>
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="registerPassword" aria-describedby="passwordHelp"
                placeholder="Придумайте и введите свой пароль..." v-model="password">
                <div id="passwordHelp" class="form-text">Ваш пароль должен содержать не менее 6 символов</div>
            </div>
            <button type="button" class="btn btn-primary" @click="register()">Регистрация</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                name: null,
                email: null,
                password: null
            };
        },
        mounted() {
        },

        methods: {
            register: function() {
                let vue = this;
                axios.post('/api/register', {
                    name: vue.name,
                    email: vue.email,
                    password: vue.password
                }).then(function(response) {
                    if (response.status) {
                        localStorage.setItem('token', response.data.authorisation.token);
                        vue.$emit('updateComponent');
                        vue.$router.push('/todo');
                    }
                }).catch(function(error) {
                    console.log(error);
                });
            }
        }
    }

</script>
