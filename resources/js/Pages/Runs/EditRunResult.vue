<template>


    <Head :title="title" />
    <div class="FormTitle">
        <h2>{{title}}</h2>
        <Link :href="route('runs.edit', {Run_id: run.Run_id})" class="text-blue-600 hover:text-blue-900 my-5 block" style="width: 130px">
            Вернуться назад
        </Link>
    </div>

    <spin v-if="loading"></spin>
    <div v-if="!loading" class="RunResultForm">

        <div class="block p-6 ">
            <form >
                <div class="formCaseTitle">
                    <div v-if="run.Task_isForRegress < 1" class="formCaseTitleProject">
                        <div class="flex">
                            <div class="mb-3 xl:w-96">
                                <select
                                    disabled
                                    v-model="run.Task_JiraProject"
                                    class="form-select appearance-none block w-full
                                px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300 rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                                    <option disabled>Выберите проект</option>
                                    <option v-for="project in jiraProjects" :value="project.project">{{project.project}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div v-if="run.Task_isForRegress < 1" class="formCaseTitleNumber">
                        <div class="flex">
                            <div class="mb-3 xl:w-96">
                                <input
                                    disabled
                                    v-model="run.Task_Number"
                                    class=" form-control block w-full px-3 py-1.5 text-base
                                font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="exampleNumber0"
                                    placeholder="Номер задачи"
                                />
                            </div>
                        </div>
                    </div>

                    <div class="formCaseTitleName">
                        <div class="flex">
                            <div class="mb-3" style="width: 100%">
                                <input
                                    v-model="run.Task_Name"
                                    type="text"
                                    disabled
                                    class="form-control block
                                w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                                border border-solid border-gray-300 rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput125"
                                    placeholder="Название задачи">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formCaseBody">

                    <div class="formCaseBodySteps mb-5">
                        <p class="mb-1" >Шаги:</p>
                        <div class="formCaseBodyStepsContainer">

                            <div v-if="!loading" v-for="step in steps" class="stepContainer border border-solid border-gray-300 rounded">
                                <div class="stepInfo">
                                    <div class="stepNumber">
                                        <p>{{step.Step_Number}}</p>
                                    </div>
                                </div>

                                <div class="stepAction border-l border-r">
                                    <QuillEditor :readOnly="true" v-model:content="step.Step_Action" theme="snow" v-bind:toolbar="minimalToolbar" v-bind:contentType="'html'" />
                                </div>

                                <div class="stepResult">
                                    <QuillEditor :readOnly="true" v-model:content="step.Step_Result" theme="snow" v-bind:toolbar="minimalToolbar" v-bind:contentType="'html'" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="formCaseBodyAdditionalFields ">

                        <div style="display: block; justify-content: center; align-items: center" class="formCaseVerions">

                            <Dropdown :type="'versions'"
                                      :name="'Версия '+run.Task_Version"
                                      :caseVersions="null"
                                      :selected="run.Task_Version"
                            >
                            </Dropdown>

                        </div>

                        <div class="flex ">
                            <div class="mb-3 xl:w-96">
                                <label for="exampleNumber0" class="form-label inline-block mb-2 text-gray-700">
                                    Приоритет
                                </label>
                                <select
                                    v-model="run.Task_Priority"
                                    disabled
                                    class="form-select appearance-none
                                block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300 rounded transition ease-in-out m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">

                                    <option disabled>Выберите приоритет</option>
                                    <option v-for="priority in taskPriorities" :value="priority.id">{{priority.priority}}</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div style="display: block; height: 100px; position: relative">
                            <a @click="setResult(1)">
                                <div class="runResultButton runResultButtonSuccess"
                                     :class="{runResultButtonSuccessPicked : form.RunStatus_id === 1}"
                                     >
                                    Положительный
                                </div>
                            </a>

                            <a @click="setResult(3)">
                                <div class="runResultButton runResultButtonBlocked"
                                    :class="{runResultButtonBlockedPicked : form.RunStatus_id === 3}">
                                    Блокируется
                                </div>
                            </a>

                            <a @click="setResult(4)">
                                <div class="runResultButton runResultButtonNegative"
                                    :class="{runResultButtonNegativePicked : form.RunStatus_id === 4 }">
                                    Отрицательный
                                </div>
                            </a>
                            <a @click="setResult(2)">
                                <div class="runResultButton runResultButtonSkipped"
                                     :class="{runResultButtonSkippedPicked : form.RunStatus_id === 2 }">
                                   Пропущено
                                </div>
                            </a>
                        </div>


                        <div class="flex justify-center">
                            <div class="mb-3 xl:w-96">
                                <label for="testRunAbout" class="form-label inline-block mb-2 text-gray-700">
                                    Комментарий
                                </label>
                                <textarea
                                    v-model="form.RunResult_Comment"
                                    class="
                                        form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700
                                        bg-white bg-clip-padding border border-solid border-gray-300 rounded
                                        transition ease-in-out m-0
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    id="testRunAbout"
                                    rows="3"
                                    placeholder="Введите описание..."
                                ></textarea>
                            </div>
                        </div>

                        <div style="display: block;">
                            <label for="exampleNumber0" class="form-label inline-block mb-2 text-gray-700">
                                Времени затрачено
                            </label>
                            <div style="display: block; height: auto; width: 100%">
                            <input
                                v-model="hoursSpent"
                                style="float: left"
                                @keypress="isNumber($event)"
                                class="
                                form-control
                                block
                                w-1/2
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
                                id="hoursSpentInput"
                                placeholder="часов"
                            />
                            <input
                                v-model="minutesSpent"
                                style="float: left"
                                @keypress="isNumber($event)"
                                :class="{'border-red-500': form.errors.Task_Number}"
                                class="
                                form-control
                                block
                                w-1/2
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
                                id="minutesSpentInput"
                                placeholder="минут"
                            />
                            </div>
                        </div>



                    </div>


                </div>

                <div class="form-group form-check text-center mb-6 ">
                </div>
                <button v-if="buttonSave"
                        @click="this.clickedSave()"
                        type="submit"
                        class="
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

                <button v-if="!buttonSave"
                        disabled
                        type="submit"
                        class="w-full px-6 xl:w-96 py-2.5 bg-gray-300 text-white
                                font-medium text-xs leading-tight uppercase rounded shadow-md
                                transition duration-150 ease-in-out"
                >Сохранить</button>
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
import axios from "axios";
import {forEach} from "lodash";
import Spin from "../../Elements/Spin";
import {Inertia} from "@inertiajs/inertia";
import Dropdown from "../../Shared/dropdown/Dropdown";
import * as MyMethods from "../../methods"

export default {
    components: {
        Link, Head, QuillEditor, axios, forEach, Spin, Dropdown
    },
    name: "Edit",
    props: {
        title: String,
        run: Object
    },
    computed : {
        ...mapGetters ([
            'prefProject',
            'prefProjectName',
            'jiraProjects',
            'taskPriorities',
            'caseStatuses'
        ]),
        buttonSave() {
            return this.buttonSaveEnabled
        }
    },
    created() {
    },
    data:() => ({
        buttonSaveEnabled: false,
        steps: [],
        loading: false,
        userClickedSave : false,
        minimalToolbar: [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'size': ['small', false, 'large'] }],  // custom dropdown
        ],
        minutesSpent: null,
        hoursSpent: null
    }),
    setup(props) {
        const form = useForm({
            id: props.run.id,
            User_id: null,
            RunStatus_id: props.run.RunStatus_id,
            RunResult_Comment: props.run.RunResult_Comment,
            RunResult_TimeSpent: props.run.RunResult_TimeSpent,
        });

        function update() {
            window.removeEventListener('beforeunload', this.controlExit);
            form.post(route('tasks.update'))
        }
        return {form, update};
    },
    mounted() {
        //парсим шаги и помещаем в data
        this.steps = JSON.parse(this.$props.run.steps);
        this.loading = false;
        window.removeEventListener('beforeunload', this.controlExit);
        this.form.Task_Project = this.prefProject
        setTimeout(() => {
        },  1000)
        window.addEventListener('beforeunload', this.controlExit);
    },
    unmounted() {
        window.removeEventListener('beforeunload', this.controlExit);
    },
    methods: {
        changeLoading() {
            setTimeout(() => {
                this.loading = !this.loading
            },  1000)

        },
        controlExit(e) {
            if (this.buttonSaveEnabled === false) {
                return;
            }
            e.preventDefault();
            e.returnValue = '';
        },
        logger(msg) {
            console.log(msg)
        },
        setDataInForm() {
            this.form.User_id = this.$attrs.user.id
            let mins = 0;
            let hours = 0;
            if (this.minutesSpent) {
                mins = Number.parseInt(this.minutesSpent);
            }
            if (this.hoursSpent) {
                hours = Number.parseInt(this.hoursSpent)
            }
            this.form.RunResult_TimeSpent = mins + (hours * 60)
        },
        clickedSave() {
            this.buttonSaveEnabled=false;
            this.loading=true;
            this.setDataInForm();
            this.update();
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
        setResult: function (result) {
            this.form.RunStatus_id = result;
        }
    }
}
</script>

<style scoped>
.formCaseVerions {
    height: auto;
    margin-bottom: 10px;
}

.RunResultForm {
    height: auto;
    width: 100%;
}

.runResultButton {
    width: 49%;
    height: 50%;
    float: left;
    display: block;
    border-radius: 10px;
    border: solid black 1px;
    color: #1a202c;
    text-align:center;
    vertical-align: middle;
}

.runResultButtonSuccess {
    background-color: #00B42C20
}

.runResultButtonSuccessPicked, .runResultButtonSuccess:hover {
    background-color: rgba(7, 206, 58, 0.7);
}

.runResultButtonBlocked {
    background-color: #CBCBCBD3;
}

.runResultButtonBlocked:hover, .runResultButtonBlockedPicked {
    color: #cbd5e0;
    background-color: rgba(110, 106, 106, 0.99);
}

.runResultButtonNegative {
    background-color: rgba(255, 215, 215, 0.85);
}

.runResultButtonNegative:hover, .runResultButtonNegativePicked {
    background-color: #ff7a7a;
}

.runResultButtonSkipped {
    background-color: rgba(255, 255, 217, 0.89);
}

.runResultButtonSkipped:hover, .runResultButtonSkippedPicked {
    background-color: #ffff53;
}
</style>
