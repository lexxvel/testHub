<template>

<Head :title="title" />
<div class="FormTitle">
    <h2>{{title}}</h2>
    <Link :href="route('users')" class="text-indigo-600 hover:text-indigo-900 my-5 block">
        Вернуться назад
    </Link>
</div>

<div class="userAddForm">

    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
        <form @submit.prevent="store">
            <div class="form-group mb-6">
            <input 
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
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
                placeholder="Имя пользователя">
            
            <div v-if="form.errors.email" class="text-red-500 mt-2"> {{form.errors.email}}</div>
            </div>
            
            <div class="form-group mb-6">
            <input 
                v-model="form.password"
                :class="{'border-red-500': form.errors.password}"
                type="password" class="form-control block
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
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput126"
                placeholder="Пароль">
            
            <div v-if="form.errors.password" class="text-red-500 mt-2"> {{form.errors.password}}</div>
            </div>

            <div class="form-group form-check text-center mb-6">
            <input 
                v-model="form.User_Role"
                :class="{'border-red-500': form.errors.User_Role}"
                type="text" class="form-control block
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
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput126"
                placeholder="Роль">
            <div v-if="form.errors.User_Role" class="text-red-500 mt-2"> {{form.errors.User_Role}}</div>
            </div>
            <div class="form-group form-check text-center mb-6">
            
            </div>
            <button type="submit" class="
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
            ease-in-out">Добавить</button>
        </form>
    </div>
</div>

</template>

<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link, Head, 
    },
    props: {
        title: String
    },
    setup() {
        const form = useForm({
            email: null,
            password: null,
            User_Role: null
        });

        function store() {
            form.post(route('users.store'))
        }

        return {form, store};

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