<template>
    <div>
        <Link :href="route('runs.editRunResult', {'RunResult_id': testCase.id})">
    <div v-if="isForRegress" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">

        <div style="float: left; width: fit-content; display: block;" class="form-check">
            <input @click="$emit('update:checked-run-cases', testCase.Task_id)"
                   :checked="checkboxChecked"
                   :value="testCase.Task_id" class="form-check-input appearance-none h-4 w-4 border border-gray-300
                rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200
                mt-1.5 align-top bg-no-repeat bg-center bg-contain float-left ml-2 mr-2 cursor-pointer"
                   type="checkbox" value="" >
        </div>

        <div class="caseRunResultIcon">
            <img v-bind:src="findArrayElementById(runResultsLinks, testCase.RunStatus_id, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
        </div>

        <div class="taskCardName border-gray-300 text-gray-900" >
            <p>{{testCase.Task_Name}}</p>
        </div>

        <div class="taskPriorityInRun">
            <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
        </div>

    </div>
        </Link>

    <div v-if="!isForRegress" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">
        <Link :href="route('runs.editRunResult', {'RunResult_id': testCase.id})">
            <div style="float: left; width: fit-content; display: block;" class="form-check">
                <input @click="$emit('update:checked-run-cases', testCase.Task_id)"
                       :checked="checkboxChecked"
                       :value="testCase.Task_id" class="form-check-input appearance-none h-4 w-4 border border-gray-300
                    rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200
                    mt-1.5 align-top bg-no-repeat bg-center bg-contain float-left ml-2 mr-2 cursor-pointer"
                       type="checkbox" value="" >
            </div>

            <div class="caseRunResultIcon">
                <img v-bind:src="findArrayElementById(runResultsLinks, testCase.RunStatus_id, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
            </div>

            <div class="taskCardNumber border-gray-300 text-gray-900">
                <a v-bind:href="jiraLink+testCase.Task_JiraProject+'-'+testCase.Task_Number" target="_blank" class="text-blue-600 hover:text-blue-900 my-5 ">
                    <p style="margin-left: 6px">{{ testCase.Task_JiraProject}}-{{testCase.Task_Number}}</p>
                </a>
            </div>

            <div class="taskCardName border-gray-300 text-gray-900">
                <p>{{testCase.Task_Name}}</p>
            </div>

            <div class="taskPriorityInRun">
                <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
            </div>
        </Link>
    </div>
    </div>

</template>

<script>
import {mapGetters} from "vuex";
import * as myMethods from "../methods";
import {Link} from "@inertiajs/inertia-vue3";

export default {
    name: "CaseLine",
    props: {
        testCase: Object,
        isForRegress: Number,
        checkboxChecked: Boolean
    },
    components : {
        Link
    },
    data:() => ({
        jiraLink: "https://jira.is-mis.ru/browse/"
    }),
    computed : {
        ...mapGetters ([
            'prefProject',
            'caseStatuses',
            'priorityImagesLinks',
            'runResultsLinks'
        ]),
    },
    methods: {
        findArrayElementById(array, id, element) {
            return myMethods.findArrayElementById(array, id, element);
        },
    }
}
</script>

<style scoped>
    .taskPriorityInRun {
        float: right;
        height: 30px;
        min-width: 25px;
        width: 2%;
    }

    .caseRunResultIcon {
        float: left;
        height: 30px;
        min-width: 25px;
        width: 2%;
    }
</style>
