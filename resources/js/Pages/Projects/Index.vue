<template>
    <Head :title="title" />
    <spin v-if="loading"></spin>
    <div class="FormTitle">
        <h2>{{title}}</h2>
    </div>

    <Link :href="route('projects.create')" class="text-blue-600 hover:text-blue-900 my-5 block">
        Добавить проект
    </Link>

    <div class="projectsForm">
        <div style="display: grid; ">
            <div class="grid justify-center " style="width: 100%;  grid-template-columns: repeat(3, 1fr);">
                <div v-for="project in projects" :key="project.Project_id" :class="{'bg-green-100': project.Project_id == this.$cookie.getCookie('prefProjectId')}" class="block rounded-lg shadow-lg bg-white max-w-sm text-center projectCard">
                    <div class="py-3 px-6 border-b border-gray-300 text-gray-900 text-xl font-medium"  style="height: 25%">
                        <p style="text-overflow: none">{{project.Project_Name}}</p>
                    </div>
                    <div class="p-6" style="height: 60%; overflow: hidden">
                        {{project.Project_About}}
                    </div>
                    <div  style="height: 15%">
                        <Link @click="preferProject(project.Project_Name ,project.Project_id)" class="text-indigo-600 hover:text-indigo-900" style="margin-right: 10px">Выбрать</Link>
                        <Link :href="route('projects.edit', {'Project_id': project.Project_id})" class="text-indigo-600 hover:text-indigo-900" style="margin-right: 10px">Изменить</Link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import { default as Spin} from '../../Elements/Spin.vue'
import { VueCookieNext } from 'vue-cookie-next'
import axios from "axios";

window.csrf_token = "{{ csrf_token() }}"
export default {

    props: {
        title: String,
        projects: Array
    },
    components: {
        Head, Link, Spin
    },
    data:() => ({
        loading: false,
    }),
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
    methods: {
        preferProject(name, id) {
            axios.post('api/projects/setPreferred', {'Project_id': id}, )
            this.$store.dispatch('setPreferProject', {name, id})
        }
    }
}
</script>

<style>
.projectsForm{
    width: 100%;
}
</style>
