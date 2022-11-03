<template>

<Head :title="title" />
<div class="FormTitle">
    <h2>{{title}}</h2>
    <Link :href="route('tasks', {Project_id: prefProject})" class="text-blue-600 hover:text-blue-900 my-5 block">
        Вернуться назад
    </Link>
</div>

<div class="AddCaseForm">

    <div class="block p-6 ">
        <form @submit.prevent="store">

            <div class="formCaseTitle">
                <div class="formCaseTitleProject">
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <select
                                v-model="form.Task_JiraProject"
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
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                <option disabled>Выберите проект</option>
                                <option v-for="project in jiraProjects" :value="project.project">{{project.project}}</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="formCaseTitleNumber">
                    <div class="flex">
                        <div class="mb-3 xl:w-96">
                            <input
                                v-model="form.Task_Number"
                                @keypress="isNumber($event)"
                                :class="{'border-red-500': form.errors.Task_Number}"
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
                                id="exampleNumber0"
                                placeholder="Номер задачи"
                            />
                            <div v-if="form.errors.Task_Number" style="font-size: 13px; margin: 0" class="text-red-500"> {{form.errors.Task_Number}}</div>
                        </div>
                    </div>
                </div>
                <div class="formCaseTitleName">
                    <div class="flex">
                        <div class="mb-3" style="width: 100%">
                            <input
                                v-model="form.Task_Name"
                                :class="{'border-red-500': form.errors.Task_Name}"
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
                                placeholder="Название задачи">
                            <div v-if="form.errors.Task_Name" style="font-size: 13px; margin: 0;" class="text-red-500"> {{form.errors.Task_Name}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="formCaseBody">

                <div class="formCaseBodySteps mb-5">
                    <p class="mb-1" >Шаги:</p>
                        <div class="formCaseBodyStepsContainer">
                            <spin v-if="loading"></spin>
                            <div v-if="!loading" v-for="step in steps" class="stepContainer border border-solid border-gray-300 rounded">
                                <div class="stepInfo">
                                    <div class="stepNumber">
                                        <p>{{step.Step_Number}}</p>
                                    </div>
                                    <div class="stepDelete">
                                        <div class="btnDeleteStep">
                                            <a @click="deleteStep(step.Step_Number)">
                                                <img src="/trash.svg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="stepAction border-l border-r" >
                                    <QuillEditor v-model:content="step.Step_Action" theme="snow" v-bind:toolbar="minimalToolbar" v-bind:contentType="'html'"/>
                                </div>

                                <div class="stepResult">
                                    <QuillEditor v-model:content="step.Step_Result" theme="snow" v-bind:toolbar="minimalToolbar" v-bind:contentType="'html'"/>
                                </div>
                            </div>
                        </div>
                    <div class="btnAddStep">
                        <a @click="addStep">
                            <img src="/plus.svg" alt="">
                        </a>
                    </div>
                </div>

                <div class="formCaseBodyAdditionalFields">
                    <div class="flex ">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleNumber0" class="form-label inline-block mb-2 text-gray-700">
                                Приоритет
                            </label>
                            <select
                                v-model="form.Task_Priority"
                                :class="{'border-red-500': form.errors.Task_Priority}"
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
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                <option disabled>Выберите приоритет</option>
                                <option v-for="priority in taskPriorities" :value="priority.id">{{priority.priority}}</option>
                            </select>
                        </div>
                        <div v-if="form.errors.Task_Priority" class="text-red-500 mt-2"> {{form.errors.Task_Priority}}</div>
                    </div>


                    <div class="flex ">
                        <div class="mb-3 xl:w-96">
                            <label for="exampleNumber0" class="form-label inline-block mb-2 text-gray-700">
                                Статус кейса
                            </label>
                            <select
                                v-model="form.Task_Stage"
                                :class="{'border-red-500': form.errors.Task_Stage, 'bg-red-100': form.Task_Stage == '0', 'bg-yellow-100': form.Task_Stage == '1', 'bg-green-100': form.Task_Stage == '2'}"
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
                             focus:outline-none" aria-label="Default select example">
                                <option class="bg-white" disabled>Выберите приоритет</option>
                                <option v-for="caseStatus in caseStatuses" :class="caseStatus.class" :value="caseStatus.id">{{caseStatus.status}}</option>
                            </select>
                        </div>

                        <div v-if="form.errors.Task_Stage" class="text-red-500 mt-2"> {{form.errors.Task_Stage}}</div>
                    </div>
                </div>


            </div>






            <div class="form-group form-check text-center mb-6 ">
            </div>
            <button
                @click="this.userClickedSave = true; this.setStepsInForm()"
                type="submit" class="
            w-full
            px-6
            xl:w-96
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
            ease-in-out">Сохранить</button>
        </form>
    </div>
</div>

</template>

<script>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import {mapGetters} from 'vuex';

import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
import {Inertia} from "@inertiajs/inertia";
import Spin from "../../Elements/Spin";
export default {
    components: {
        Link, Head, QuillEditor, Spin
    },
    props: {
        title: String
    },
    computed : {
        ...mapGetters ([
            'prefProject',
            'prefProjectName',
            'jiraProjects',
            'taskPriorities',
            'caseStatuses'
        ])
    },
    data:() => ({
        steps: [],
        loading : false,
        userClickedSave : false,
        minimalToolbar: [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'align': [] }]
        ]
    }),
    setup() {
        let removeBeforeEventListener = Inertia.on('before', (event) => {
            if (form.isDirty) {
                if (!confirm('Кейс не сохранен. Выйти?')) {
                    event.preventDefault()
                } else {
                    removeBeforeEventListener();
                }
            }
        });

        const form = useForm({
            Task_JiraProject: "PROMEDWEB",
            Task_Number: null,
            Task_Name: null,
            Task_Priority: "1",
            Task_Stage: "0",
            Task_Project: "",
            steps: [],
        });


        function store() {
            this.userClickedSave = true;
            removeBeforeEventListener();
            form.post(route('tasks.store'))
            removeBeforeEventListener =  Inertia.on('before', (event) => {
                if (form.isDirty && this.userClickedSave == false) {
                    if (!confirm('Кейс не сохранен. Выйти?')) {
                        event.preventDefault()
                    } else {
                        removeBeforeEventListener();
                    }
                }
            });
            this.userClickedSave = false;
        }

        return {form, store};
    },
    mounted() {
        this.form.Task_Project = this.prefProject

        window.addEventListener('beforeunload', this.controlExit);
    },
    unmounted() {
        window.removeEventListener('beforeunload', this.controlExit);
    },
    methods: {
        controlExit(e) {
            if (this.userClickedSave === true) {
                return;
            }
            e.preventDefault();
            e.returnValue = '';
        },
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        addStep() {
            this.steps.push({Step_Action: "", Step_Result: "", Step_Number: this.steps.length + 1})
        },
        deleteStep(id) {
            let formattedArray = []; //новый массив для временного хранения измененного массива шагов
            let length = this.steps.length;
            let i = 0;
            let step = 1; //id-шник для нового записываемого шага
            while (i < length) {
                if (this.steps[i].Step_Number !== id) {
                    formattedArray.push({Step_Action: this.steps[i].Step_Action, Step_Result: this.steps[i].Step_Result, Step_Number: step})
                    step = ++step;
                }
                i = ++i;
            }
            this.loading = true;
            this.steps = [];
            setTimeout(() => {
                this.steps = formattedArray
                this.loading = false
            },  250)
        },
        setStepsInForm() {
            this.form.steps = this.steps;
        },
    }
}
</script>

<style>

</style>
