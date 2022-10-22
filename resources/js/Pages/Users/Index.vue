<template>

<Head :title="title" />
<spin v-if="loading"></spin>
<div class="FormTitle">
    <h2>{{title}}</h2>
</div>

<div class="UserForm" v-if="!loading">
    <div class=" items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        
        <Link :href="route('users.create')" class="text-blue-600 hover:text-blue-900 my-5 block">
            Добавить пользователя
        </Link>

        <div class="flex-col" style="width: 100%">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                    <thead class="bg-white border-b">
                        <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Логин
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Роль
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Команда
                        </th>
                        </tr>
                    </thead>
                    <tbody v-if="users.total > 0">
                        <tr v-for="user in users.data" class="bg-gray-100 border-b" :key="user.id">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{user.email}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            {{user.User_Role}}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                            Команда
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap flex justify-end items-center">
                            <Link :href="route('users.edit', {'id': user.id})" class="text-indigo-600 hover:text-indigo-900" style="margin-right: 10px">Изменить</Link>
                            <Link @click="deleteUser(user.id)" class="text-red-600 hover:text-red-900 cursor-pointer">Удалить</Link>
                        </td>
                        </tr>
                    </tbody>
                    </table>

                    <Pagination :links="users.links" :from="users.from" :to="users.to" :total="users.total" />
                </div>
                </div>
            </div>
        </div>



        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        
    </div>
</div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Pagination from '../../Shared/Pagination.vue'
import { default as Spin} from '../../Elements/Spin.vue'
import axios from 'axios'
export default {
    data:() => ({
        loading: false,
    }),
    components: {
        Head, Pagination, Link, Spin
    },
    created() {
    
        if (this.$page.props.errors.error_msg !== "" && this.$page.props.errors.error_msg) {
                let msg = this.$page.props.errors.error_msg;
                this.$page.props.errors.error_msg = "";
                UIkit.notification({message: msg, status: 'danger'});
        }

        if (this.$page.props.errors.msg !== "" && this.$page.props.errors.msg) {
                let msg = this.$page.props.errors.msg;
                this.$page.props.errors.msg = "";
                UIkit.notification({message: msg, status: 'success'});
        }        
        
        this.$watch('$page.props.errors.msg', (newValue) => {
            
            if (this.$page.props.errors.msg !== "" && this.$page.props.errors.msg) {
                let msg = this.$page.props.errors.msg;
                this.$page.props.errors.msg = "";
                UIkit.notification({message: msg, status: 'success'});
            }
        });

        this.$watch('$page.props.errors.error_msg', (newValue) => {

            if (this.$page.props.errors.error_msg !== "" && this.$page.props.errors.error_msg) {
                let msg = this.$page.props.errors.error_msg;
                this.$page.props.errors.error_msg = "";
                UIkit.notification({message: msg, status: 'danger'});
                }
        });
    },
    props: {
        title: String,
        users: Object
    },
    methods: {
        async deleteUser(id) {
            this.loading = true;
            if (confirm("Вы уверены?")) {
                await this.$inertia.post(this.route('users.destroy', {'id': id}));
                this.loading = false;

                setTimeout(() => {  //** TODO: заменить костыль на ожидание ответа */
                if (this.users.data.length === 0 && this.users.total > 0) {
                    this.$inertia.get(this.route('users'))
                }
                },  1500)  
                
            }
        },
        closeAlert() {
            this.$page.props.errors.msg = "";
            this.$page.props.errors.error_msg = "";
        }, 
        slowAlertClose() {
            setTimeout(() => {
                this.closeAlert();
            },  1500)  
        }
    },
    beforeRouteLeave: function(to, from, next) {
    confirm('Are you sure')
    next();
}
}
</script>

<style>

</style>