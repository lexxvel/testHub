<template>

    <Head :title="title" />
    <div class="FormTitle">
        <h2>{{title}}</h2>
        <Link :href="route('runs', {Project_id : prefProject})" class="text-blue-600 hover:text-blue-900 my-5 block">
            Вернуться назад
        </Link>
    </div>

    <div class="runAddForm">

        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-md">
            <form @submit.prevent="store">


                <div  class="mb-3 xl:w-96">
                    <label for="testRunProject" class="form-label inline-block mb-2 text-gray-700">
                        Проект
                    </label>
                    <input id="testRunProject" disabled
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
                                    disabled
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           v-bind:value="prefProjectName">
                    <div v-if="form.errors.Run_Name" class="text-red-500 mt-2"> {{form.errors.Run_Name}}</div>
                </div>




                <div class="form-group mb-6">
                    <label for="testRunName" class="form-label inline-block mb-2 text-gray-700">
                        Название тест-рана
                    </label>
                    <input
                        id="testRunName"
                        v-model="form.Run_Name"
                        :class="{'border-red-500': form.errors.Run_Name}"
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
                        placeholder="Введите название...">

                    <div v-if="form.errors.Run_Name" class="text-red-500 mt-2"> {{form.errors.Run_Name}}</div>
                </div>


                <div class="flex ">
                    <div class="mb-3 xl:w-96">
                        <label for="testRunType" class="form-label inline-block mb-2 text-gray-700">
                            Тип тест-рана
                        </label>
                        <select
                            id="testRunType"
                            v-model="form.Run_Type"
                            aria-label="Default select example"
                            placeholder="Тип тест-рана"
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
                                focus:outline-none
                            ">
                            <option class="bg-white" disabled>Выберите тип:</option>
                            <option v-for="testrunType in testrunTypes" :value="testrunType.id">{{testrunType.type}}</option>
                        </select>
                    </div>

                    <div v-if="form.errors.Task_Stage" class="text-red-500 mt-2"> {{form.errors.Task_Stage}}</div>
                </div>



                <div class="flex justify-center">
                    <div class="mb-3 xl:w-96">
                        <label for="testRunAbout" class="form-label inline-block mb-2 text-gray-700">
                            Описание тест-рана
                        </label>
                        <textarea
                            v-model="form.Run_Desc"
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
                            id="testRunAbout"
                            rows="3"
                            placeholder="Введите описание..."
                        ></textarea>
                    </div>
                </div>


                <div class="flex items-center justify-center">
                    <div class="datepicker relative form-floating mb-3 xl:w-96">
                        <label for="testRunEndDate" class="text-gray-700">Дата окончания тест-рана</label>
                        <input type="date"
                               v-model="form.Run_EndDate"
                               id="testRunEndDate"
                               class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                               placeholder="Введите дату окончания" />

                    </div>
                </div>



                <button
                    type="submit"
                    @click="this.setProjectIdInForm()"
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
                            ease-in-out"
                >Добавить</button>
            </form>
        </div>
    </div>

</template>

<script>
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import {mapGetters} from "vuex";

export default {
    name: "Create",
    components: {
        Link, Head,
    },
    props: {
        title: String
    },
    setup() {
        const form = useForm({
            Project_id: null,
            Run_Name: null,
            Run_Type: null,
            Run_Status: null,
            Run_Desc: null,
            Run_EndDate: null,
        });

        function store() {
            form.post(route('runs.store'))
        }

        return {form, store};

    },
    computed : {
        ...mapGetters ([
            'prefProject',
            'prefProjectName',
            'caseStatuses',
            'testrunTypes'
        ])
    },
    methods: {
        setProjectIdInForm() {
            this.form.Project_id = this.prefProject;
        }
    }
}
</script>


<style scoped>
.runAddForm {
    height: 30%;
    width: 30%;
    position: absolute;
    top: 38%;
    left: 50%;
    margin: -125px 0 0 -125px;
}
</style>
