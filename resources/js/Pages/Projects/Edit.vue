<template>

    <Head :title="title"/>
    <div class="FormTitle">
        <h2>{{ title }}</h2>
        <Link :href="route('projects')" class="text-blue-600 hover:text-blue-900 my-5 block">
            Вернуться назад
        </Link>
    </div>

    <div class="projectEditForm">

        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
            <form @submit.prevent="update">
                <div class="form-group mb-6">
                    <input
                        v-model="form.Project_Name"
                        :class="{'border-red-500': form.errors.Project_Name}"
                        type="text"
                        class="form-control block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
                        placeholder="Название проекта">

                    <div v-if="form.errors.Project_Name" class="text-red-500 mt-2"> {{ form.errors.Project_Name }}</div>
                </div>

                <div class="form-group form-check text-center mb-6">
            <textarea
                v-model="form.Project_About"
                :class="{'border-red-500': form.errors.Project_About}"
                class="
                    form-control
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                "
                id="exampleFormControlTextarea1"
                rows="3"
                placeholder="Описание"
            ></textarea>
                    <div v-if="form.errors.Project_About" class="text-red-500 mt-2"> {{ form.errors.Project_About }}
                    </div>
                </div>
                <div class="form-group form-check text-center mb-6">


                </div>

                <div class="form-check">
                    <input v-model="form.Project_isCommon"
                           class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                           type="checkbox" value="1" id="flexCheckChecked" checked>
                    <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
                        Общий проект
                    </label>
                </div>

                <div v-if="!form.Project_isCommon == 1">

                    <div class="form-group mb-6">
                        <label for="userForProject" class="form-label inline-block mb-2 text-gray-700">Выберите
                            пользователя</label>
                        <select
                            id="userForProject"
                            v-model="selectedUser"
                            :class="{'border-red-500': userAddError}"
                            class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Роль">
                            <option v-for="user in users" :value="user">{{ user.email }}</option>
                        </select>
                        <div v-if="userAddError" class="text-red-500 mt-2"> {{ userAddError }}</div>
                    </div>

                    <button
                        @click="addUser()"
                        type="button"
                        class="
                    w-1/8 px-6 py-2.5
                    bg-green-300  text-black  font-medium text-m
                    leading-tight  uppercase  rounded shadow-md hover:bg-green-700 hover:shadow-lg
                    focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-green-800 active:shadow-lg
                    transition duration-150 ease-in-out"
                    >+
                    </button>
                </div>

                <div v-for="user in form.users">
                    <p style="margin: 0 0 0 0">
                        {{ user.email }}
                    </p>
                </div>

                <br>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="
            w-full
            px-6
            py-2.5
            bg-blue-600
            text-white
            font-medium
            text-xs
            leading-tight
            uppercase
            rounded
            shadow-md
            hover:bg-blue-700 hover:shadow-lg
            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
            active:bg-blue-800 active:shadow-lg
            transition
            duration-150
            ease-in-out">Обновить
                </button>
            </form>
        </div>
    </div>

</template>

<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import {Inertia} from '@inertiajs/inertia'
import axios from "axios";

export default {
    components: {
        Link, Head,
    },
    props: {
        title: String,
        project: Object
    },
    setup(props) {

        const form = useForm({
            Project_Name: props.project.Project_Name,
            Project_About: props.project.Project_About,
            Project_id: props.project.Project_id,
            Project_isCommon: props.project.Project_isCommon,
            users: props.project.users
        });

        function update() {
            // removeBeforeEventListener();
            form.post(route('projects.update', props.project.Project_id))
        }

        // let removeBeforeEventListener = Inertia.on('before', (event) => {
        //     if (form.isDirty) {
        //         if (!confirm('Изменения не сохранены. Выйти?')) {
        //             event.preventDefault()
        //         } else {
        //             removeBeforeEventListener();
        //         }
        //     }
        // });

        return {form, update};
    },
    created() {
        this.getUsers();
    },
    mounted() {
        this.form.Project_isCommon = this.$props.project.Project_isCommon === 1;
    },
    data: () => ({
        users: [],
        selectedUser: null,
        userAddError: null,
    }),
    methods: {
        getUsers: function () {
            axios.get('/api/users').then(res => {
                this.users = res.data
            });
        },
        addUser: function () {
            if (this.selectedUser) {
                this.userAddError = null
                this.form.users.push(this.selectedUser)
                this.selectedUser = null
            } else {
                this.userAddError = "Выберите пользователя чтобы добавить в проект"
            }
        }
    }
}
</script>

<style>
.userAddForm {
    height: 30%;
    width: 30%;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -125px 0 0 -125px;
}

</style>
