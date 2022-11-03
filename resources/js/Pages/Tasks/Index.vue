<template>
    <Head :title="title" />
    <spin v-if="loading"></spin>
    <div class="FormTitle">
        <h2>{{title}}</h2>
    </div>

    <Link :href="route('tasks.create')" class="text-blue-600 hover:text-blue-900 my-5 block">
        Добавить задачу
    </Link>

    <div class="tasksForm">
        <div style="display: grid;">
            <div class="grid" style="width: 100%;">

                <div class="taskCard">
                    <div class="taskCardNumber border-gray-300 text-gray-900">
                        <p style="margin-left: 6px">Задача</p>
                    </div>

                    <div class="taskPriority">
                        Приоритет
                    </div>

                    <div class="taskCardName border-gray-300 text-gray-900" style="text-align:center">
                        <p>Название</p>
                    </div>
                    <div class="taskStage border-gray-300 text-gray-900">
                        <p>Статус</p>
                    </div>
                </div>

                <div v-for="task in tasks" :key="task.Task_id" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">

                    <div class="taskCardNumber border-gray-300 text-gray-900">
                        <a v-bind:href="jiraLink+task.Task_JiraProject+'-'+task.Task_Number" target="_blank" class="text-blue-600 hover:text-blue-900 my-5 ">
                            <p style="margin-left: 6px">{{ task.Task_JiraProject}}-{{task.Task_Number}}</p>
                        </a>
                    </div>

                    <Link :href="route('tasks.edit', {'Task_id':task.Task_id})">
                        <div class="taskPriority">
                            <img v-bind:src="priorityImagesLinks[task.Task_Priority].link" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
                        </div>

                        <div class="taskCardName border-gray-300 text-gray-900">
                            <p>{{task.Task_Name}}</p>
                        </div>
                        <div class="taskStage border-gray-300 text-gray-900">
                            <p style="height: 30px; overflow: hidden;">{{taskStages[task.Task_Stage].stage}}</p>
                        </div>
                    </Link>

                </div>


            </div>
        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import { default as Spin} from '../../Elements/Spin.vue'
import { Inertia } from '@inertiajs/inertia'
import {mapGetters} from 'vuex';

export default {
    props: {
        title: String,
        tasks: Array
    },
    components : {
        Head, Spin, Link
    },
    data:() => ({
        loading: false,
        jiraLink: "https://jira.is-mis.ru/browse/"
    }),
    mounted() {
        if (this.prefProject == null || !this.prefProject) {
            UIkit.notification({message: 'Требуется выбрать проект для доступа к проектам', status: 'danger'});
            Inertia.visit('/projects', {
                method: 'get',
                data: {
                    status: 'false',
                    error_msg: 'Требуется выбрать проект для доступа к проектам',
                },
            })
        }

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
    computed : {
        ...mapGetters ([
          'prefProject',
          'taskStages',
          'priorityImagesLinks'
        ])
    },
    сreated() {
    },

}
</script>

<style>
    .tasksForm {
        width: 100%;
        height: auto;
    }

    .taskCard {
        min-width: 100%;
        max-width: 100%;
        height: auto;
        float: left;
        display: block;

    }

    .taskCardNumber {
        min-width: 15%;
        max-width: 15%;
        height: 30px;
        float: left;
        display: block;
    }

    .taskCardName {
        min-width: 70%;
        max-width: 70%;
        height: 30px;
        float: left;
        display: block;
        overflow: hidden;
    }

    .taskPriority {
        float: left;
        height: 30px;
        width: 30px;
        width: 2%;
    }

    .taskStage {
        float: left;
        height: 30px;
        width: 13%;
    }
</style>
