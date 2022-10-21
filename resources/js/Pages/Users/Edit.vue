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
            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Логин</label>
            <input 
                v-model="form.User_Name"
                :class="{'border-red-500': form.errors.User_Name}"
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
            
            <div v-if="form.errors.User_Name" class="text-red-500 mt-2"> {{form.errors.User_Name}}</div>
            </div>
            
            <div class="form-group mb-6">
            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Пароль</label>
            <input 
                v-model="form.User_Password"
                :class="{'border-red-500': form.errors.User_Password}"
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
                placeholder="Пароль">
            
            <div v-if="form.errors.User_Password" class="text-red-500 mt-2"> {{form.errors.User_Password}}</div>
            </div>

            <div class="form-group mb-6">
            <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Роль</label>
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
export default {
    components: {
        Link, Head, 
    },
    props: {
        title: String,
        user: Object
    },
    created() {
        Inertia.on('start', (event) => {  //Слушатель не выключа
            if (this.form.isDirty) {
                if (!confirm('Изменения не сохранены. Выйти?')) {
                    event.preventDefault()
                    document.removeEventListener('inertia:start', this)
                } else (
                    event.
                    document.removeEventListener('inertia:start', this)
                )
            }
        })
    },
    setup(props) {
        const form = useForm({
            User_Name: props.user.User_Name,
            User_Password: props.user.User_Password,
            User_Role: props.user.User_Role,
            User_id: props.user.User_id
        });

        function update() {
            form.post(route('users.update', props.user.User_id))
        }

        return {form, update};

    }
}
</script>

<style>
.userEditForm {
    height: 30%;
    width: 30%;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -125px 0 0 -125px;
  }
    
</style>