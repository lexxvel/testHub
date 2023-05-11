<template>

<Head :title="title" />
<div class="FormTitle">
    <h2>{{title}}</h2>
    <Link :href="route('users')" class="text-blue-600 hover:text-blue-900 my-5 block">
        Вернуться назад
    </Link>
</div>

<div class="userEditForm">

    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <form @submit.prevent="update">
            <div class="form-group mb-6">
            <label for="emailInput" class="form-label inline-block mb-2 text-gray-700">Логин</label>
            <input
                id="emailInput"
                v-model="form.email"
                :class="{'border-red-500': form.errors.email}"
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
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                placeholder="Имя пользователя">

            <div v-if="form.errors.email" class="text-red-500 mt-2"> {{form.errors.email}}</div>
            </div>

            <div class="flex">
                <div class="form-check">
                    <input v-model="wantToChangePwd" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="2" id="flexCheckDefault">
                    <label class="form-check-label inline-block text-gray-800" for="flexCheckDefault">
                        Сменить пароль
                    </label>
                </div>
            </div>

            <br>

            <div v-if="wantToChangePwd" class="form-group mb-6">
                <input
                    v-model="form.password"
                    :class="{'border-red-500': form.errors.password}"
                    type="password" class="form-control block
                w-full px-3 py-1.5 text-base font-normal text-gray-700
                bg-white bg-clip-padding border border-solid border-gray-300
                rounded transition ease-in-out m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput126"
                    placeholder="Новый пароль">

                <div v-if="form.errors.password" class="text-red-500 mt-2"> {{form.errors.password}}</div>
            </div>

            <div class="form-group mb-6">
            <label for="roleCmb" class="form-label inline-block mb-2 text-gray-700">Роль</label>
                <select
                    id="roleCmb"
                    v-model="form.User_Role"
                    :class="{'border-red-500': form.errors.User_Role}"
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
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Роль">
                    <option v-for="role in userRoles" :value="role.id">{{role.role}}</option>
                </select>
            <div v-if="form.errors.User_Role" class="text-red-500 mt-2"> {{form.errors.User_Role}}</div>
            </div>
            <div class="form-group form-check text-center mb-6">

            </div>
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
            ease-in-out">Обновить</button>
        </form>
    </div>
</div>

</template>

<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import {Inertia} from '@inertiajs/inertia'
import {mapGetters} from "vuex";
export default {
    components: {
        Link, Head,
    },
    data: () => ({
       wantToChangePwd: false
    }),
    props: {
        title: String,
        editUser: Object
    },
    created() {
    },
    computed : {
        ...mapGetters ([
            'userRoles',
        ])
    },
    setup(props) {

        let removeBeforeEventListener = Inertia.on('before', (event) => {
            if (form.isDirty) {
                if (!confirm('Изменения не сохранены. Выйти?')) {
                    event.preventDefault()
                } else {
                    removeBeforeEventListener();
                }
            }
        });

        const form = useForm({
            email: props.editUser.email,
            password: props.editUser.password,
            User_Role: props.editUser.User_Role,
            id: props.editUser.id
        });

        function update() {
            removeBeforeEventListener();
            form.post(route('users.update'))
        }

        return {form, update};

    }
}
</script>

<style>

</style>
