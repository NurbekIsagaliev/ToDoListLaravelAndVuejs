<template>
    <div class="container m-2">
        <div class="d-flex flex-row-reverse">
            <button class="btn btn-sm btn-success" @click="showModal('create')"><i class="fa-solid fa-plus"></i></button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Дата создания</th>
                            <th scope="col">Дата изменения</th>
                            <th scope="col">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(todo, key) of todos" :key="key">
                            <td>{{ todo.id }}</td>
                            <td>{{ todo.title }}</td>
                            <td>{{ todo.description }}</td>
                            <td>{{ todo.price }}</td>
                            <td>{{ todo.amount }}</td>
                            <td>{{ todo.created_at }}</td>
                            <td>{{ todo.updated_at }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-primary" @click="showModal('edit', todo)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" @click="showModal('delete', todo)"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <MDBModal id="createModal" tabindex="-1" labelledby="createModalLabel" v-model="createModal">
            <MDBModalHeader>
                <MDBModalTitle id="createModalLabel"> Создание продукта </MDBModalTitle>
            </MDBModalHeader>
            <MDBModalBody>
                <form>
                    <div class="form-group">
                        <label for="createTitle">Название</label>
                        <input type="text" class="form-control" id="createTitle" aria-describedby="createTitleHelp"
                            placeholder="Введите название продукта..." v-model="newObject.title">
                        <small id="createTitleHelp" class="form-text text-muted">Название Вашего продукта</small>
                    </div>
                    <div class="form-group">
                        <label for="createDescription">Описание продукта</label>
                        <textarea class="form-control" id="createDescription" rows="3"
                            v-model="newObject.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="createAmount">Количество</label>
                        <input type="number" class="form-control" id="createAmount" aria-describedby="createAmountHelp"
                            placeholder="Введите количество продукта..." v-model="newObject.amount">
                        <small id="createAmountHelp" class="form-text text-muted">Количество Вашего продукта</small>
                    </div>
                    <div class="form-group">
                        <label for="createPrice">Цена</label>
                        <input type="number" class="form-control" id="createPrice" aria-describedby="createPriceHelp"
                            placeholder="Введите цену продукта..." v-model="newObject.price">
                        <small id="createPriceHelp" class="form-text text-muted">Цена Вашего продукта</small>
                    </div>
                </form>
            </MDBModalBody>
            <MDBModalFooter>
                <MDBBtn color="secondary" @click="showModal('create')">Отмена</MDBBtn>
                <MDBBtn color="primary" @click="save('create')">Сохранить</MDBBtn>
            </MDBModalFooter>
        </MDBModal>
        <MDBModal id="editModal" tabindex="-1" labelledby="editModalLabel" v-model="editModal">
            <MDBModalHeader>
                <MDBModalTitle id="editModalLabel"> Создание продукта </MDBModalTitle>
            </MDBModalHeader>
            <MDBModalBody>
                <form>
                    <div class="form-group">
                        <label for="editTitle">Название</label>
                        <input type="text" class="form-control" id="editTitle" aria-describedby="editTitleHelp"
                            placeholder="Введите название продукта..." v-model="editObject.title">
                        <small id="editTitleHelp" class="form-text text-muted">Название Вашего продукта</small>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Описание продукта</label>
                        <textarea class="form-control" id="editDescription" rows="3"
                            v-model="editObject.description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editAmount">Количество</label>
                        <input type="number" class="form-control" id="editAmount" aria-describedby="editAmountHelp"
                            placeholder="Введите количество продукта..." v-model="editObject.amount">
                        <small id="editAmountHelp" class="form-text text-muted">Количество Вашего продукта</small>
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Цена</label>
                        <input type="number" class="form-control" id="editPrice" aria-describedby="editPriceHelp"
                            placeholder="Введите цену продукта..." v-model="editObject.price">
                        <small id="editPriceHelp" class="form-text text-muted">Цена Вашего продукта</small>
                    </div>
                </form>
            </MDBModalBody>
            <MDBModalFooter>
                <MDBBtn color="secondary" @click="showModal('edit')">Отмена</MDBBtn>
                <MDBBtn color="primary" @click="save('edit')">Сохранить</MDBBtn>
            </MDBModalFooter>
        </MDBModal>
        <MDBModal id="deleteModal" tabindex="-1" labelledby="deleteModalLabel" v-model="deleteModal">
            <MDBModalHeader>
                <MDBModalTitle id="editModalLabel"> Удаление </MDBModalTitle>
            </MDBModalHeader>
            <MDBModalBody>
                <div>
                    Вы уверены, что хотите удалить запись с id = {{ deleteId }}?
                </div>
            </MDBModalBody>
            <MDBModalFooter>
                <MDBBtn color="secondary" @click="showModal('edit')">Отмена</MDBBtn>
                <MDBBtn color="primary" @click="save('delete')">Удалить</MDBBtn>
            </MDBModalFooter>
        </MDBModal>
    </div>
</template>

<script>
    import {
        MDBModal,
        MDBModalHeader,
        MDBModalTitle,
        MDBModalBody,
        MDBModalFooter,
        MDBBtn,
    } from 'mdb-vue-ui-kit';
    import axios from 'axios';
    export default {
        components: {
            MDBModal,
            MDBModalHeader,
            MDBModalTitle,
            MDBModalBody,
            MDBModalFooter,
            MDBBtn,
        },
        data() {
            return {
                todos: [],
                createModal: false,
                editModal: false,
                deleteModal: false,
                deleteId: null,
                newObject: {
                    title: null,
                    description: null,
                    amount: 0,
                    price: 0
                },
                editObject: {}
            };
        },
        mounted() {
            let vue = this;
            let token = localStorage.getItem('token');
            axios.get('/api/getAll', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            }).then(function (response) {
                if (response.data.status) {
                    vue.todos = response.data.todos;
                }
            });
        },

        methods: {
            showModal: function (modal, todo = null) {
                if (modal == 'create') {
                    this.createModal = !this.createModal;
                } else if (modal == 'edit') {
                    if (todo != null) {
                        this.editObject = todo;
                    }
                    this.editModal = !this.editModal;
                } else {
                    if (todo != null) {
                        this.deleteId = todo.id;
                    }
                    this.deleteModal = !this.deleteModal;
                }
            },

            save: function (modal) {
                let vue = this;
                let token = localStorage.getItem('token');
                if (modal == 'create') {
                    axios.post('/api/create', vue.newObject, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    }).then(function (response) {
                        if (response.data.status) {
                            vue.todos = response.data.todos;
                            vue.newObject = {
                                title: null,
                                description: null,
                                amount: 0,
                                price: 0
                            };
                            vue.showModal(modal);
                        } else {
                            console.log(response);
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (modal == 'edit') {
                    axios.post('/api/edit', vue.editObject, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    })
                    .then(function (response) {
                        if (response.data.status) {
                            vue.todos = response.data.todos;
                            vue.showModal(modal);
                        } else {
                            console.log(response);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                } else {
                    axios.post('/api/delete', {id: vue.deleteId}, {
                        headers: {
                            'Authorization': `Bearer ${token}`
                        }
                    })
                    .then(function (response) {
                        if (response.data.status) {
                            vue.todos = response.data.todos;
                            vue.showModal(modal);
                        } else {
                            console.log(response);
                        }
                    }).catch(function(error) {

                    });
                }
            },
        }
    }

</script>
