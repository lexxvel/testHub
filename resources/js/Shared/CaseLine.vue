<template>
    <div>
    <div v-if="isForRegress && isLinked" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">

        <Link :href="route('tasks.edit', {'Task_id':testCase.Task_id})">
            <div class="taskPriority">
                <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
            </div>

            <div class="taskCardName border-gray-300 text-gray-900" style="width: 82%">
                <p>{{testCase.Task_Name}}</p>
            </div>
            <div class="taskStage border-gray-300 text-gray-900" style="float: right;">
                <p style="height: 30px; overflow: hidden;">{{findArrayElementById(caseStatuses, testCase.Task_Stage, 'status')}}</p>
            </div>
        </Link>
    </div>


    <div v-if="!isForRegress && isLinked" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">
        <div class="taskCardNumber border-gray-300 text-gray-900">
            <a v-bind:href="jiraLink+testCase.Task_JiraProject+'-'+testCase.Task_Number" target="_blank" class="text-blue-600 hover:text-blue-900 my-5 ">
                <p style="margin-left: 6px">{{ testCase.Task_JiraProject}}-{{testCase.Task_Number}}</p>
            </a>
        </div>

        <Link :href="route('tasks.edit', {'Task_id':testCase.Task_id})">
            <div class="taskPriority">
                <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
            </div>

            <div class="taskCardName border-gray-300 text-gray-900">
                <p>{{testCase.Task_Name}}</p>
            </div>
            <div class="taskStage border-gray-300 text-gray-900">
                <p style="height: 30px; overflow: hidden;">{{findArrayElementById(caseStatuses, testCase.Task_Stage, 'status')}}</p>
            </div>
        </Link>
    </div>


    <div v-if="isForRegress && !isLinked" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">
        <div style="float: left; width: fit-content; display: block;" class="form-check">
            <input @click="$emit('update:checked-cases', testCase.Task_id)"
                   :checked="checkboxChecked"
                   class="form-check-input appearance-none h-4 w-4 border border-gray-300
                rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200
                mt-1.5 align-top bg-no-repeat bg-center bg-contain float-left ml-2 mr-2 cursor-pointer"
                   type="checkbox" value="" id="flexCheckDefault">
        </div>

        <div class="taskPriority">
            <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
        </div>

        <div class="taskCardName border-gray-300 text-gray-900" >
            <p>{{testCase.Task_Name}}</p>
        </div>
        <div class="taskStage border-gray-300 text-gray-900" style="float: right;">
            <p style="height: 30px; overflow: hidden;">{{findArrayElementById(caseStatuses, testCase.Task_Stage, 'status')}}</p>
        </div>
    </div>


    <div v-if="!isForRegress && !isLinked" class="taskCard border-solid border border-grey-100 rounded-sm block hover:bg-gray-100">
        <div style="float: left; width: fit-content; display: block;" class="form-check">
            <input @click="$emit('update:checked-cases', testCase.Task_id)"
                   :checked="checkboxChecked"
                   :value="testCase.Task_id" class="form-check-input appearance-none h-4 w-4 border border-gray-300
                rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200
                mt-1.5 align-top bg-no-repeat bg-center bg-contain float-left ml-2 mr-2 cursor-pointer"
                   type="checkbox" value="" >
        </div>

        <div class="taskCardNumber border-gray-300 text-gray-900">
            <p style="margin-left: 6px">{{ testCase.Task_JiraProject}}-{{testCase.Task_Number}}</p>
        </div>

        <div class="taskPriority">
            <img v-bind:src="findArrayElementById(priorityImagesLinks, testCase.Task_Priority, 'link')" alt="" style="height: 20px; width: 20px; margin-top: 5px; margin-bottom: 5px">
        </div>

        <div class="taskCardName border-gray-300 text-gray-900">
            <p>{{testCase.Task_Name}}</p>
        </div>

        <div class="taskStage border-gray-300 text-gray-900">
            <p style="height: 30px; overflow: hidden;">{{findArrayElementById(caseStatuses, testCase.Task_Stage, 'status')}}</p>
        </div>
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
        isLinked: Boolean,
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
            'priorityImagesLinks'
        ]),
    },
    methods: {
        findArrayElementById(array, id, element) {
            return myMethods.findArrayElementById(array, id, element);
        }
    }
}
</script>

<style scoped>

</style>
