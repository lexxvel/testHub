<template>
    <Head :title="title" />
    <div class="FormTitle">
        <!-- <Link :href="route('runs', {Project_id : prefProject})" class="text-blue-600 hover:text-blue-900 my-5 block">
            Вернуться назад
        </Link> -->
        <h3 style="margin-top: 0px">{{title}}</h3>
    </div>
    <spin v-if="loading"></spin>
    <div v-if="!loading" class="runForm">
        <div style="display: grid">
            <div style="display: block; min-width: 100%; max-width: 100%;">
                <div class="runFormInfoEndDate" >
                    <img src="/calendar_small.png" alt="" style="width: 30px; height: 30px; float: left; margin: 0 5px 0 0">
                    {{formatDateToRussian(run.Run_EndDt)}}
                </div>
                <div class="runFormInfoStatus">Статус: {{findArrayElementById(testrunStatuses, run.Run_Status, 'status')}}</div>
                <div class="runFormInfoType">Тип: {{findArrayElementById(testrunTypes, run.Run_Type, 'type')}}</div>
                <div class="runFormInfoProject">Проект: {{run.Project_Name}}</div>
            </div>
            <div style="display: block; width: 100%; float: left">
                <div class="runFormInfoDesc">
                    Описание:
                    <p>{{run.Run_Desc}}</p>
                </div>
            </div>

            <div id="treeAndCases" style="display: block; width: 100%; float: left">
                <div style="width: 30%; height: auto;     float: left;    margin: 0 0 0 0;">
                    <div class="runFormTree">

                        <tree-item
                            class="item"
                            :item="treeData"
                            :selected="selected"
                            :viewOnly="false"
                            @select-item="selectItem"
                            @item-is-selected="itemIsSelected"
                        ></tree-item>


                    </div>
                    <div style="width: 100%; display: block; float:left">
                        <Donut :data="this.statistic.data" :labels="this.statistic.labels" />
                    </div>
                </div>

                <div id="modalAddCases" uk-modal>
                    <div class="modalAddCases uk-modal-dialog">

                        <button class="uk-modal-close-default" type="button" uk-close></button>

                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title">Добавить кейсы</h2>
                        </div>

                        <div class="uk-modal-body" uk-overflow-auto>

                            <div style="width: 30%; height: auto;     float: left;    margin: 0 0 0 0;">
                            <div class="runFormTree">

                                <tree-item
                                    class="item"
                                    :item="modalTreeData"
                                    :selected="modalSelected"
                                    :viewOnly="true"
                                    @select-item="selectModalFolder"
                                    @item-is-selected="modalFolderIsSelected"
                                    @rename-folder="renameFolder"
                                    @delete-folder="deleteFolder"
                                ></tree-item>

                            </div>

                            </div>
                            <div class="ModalRunFormCases">
                                <div style="display: grid;">
                                    <div class="grid" style="width: 100%;">

                                        <div class="taskCard">
                                            <div class="taskCardNumber border-gray-300 text-gray-300">
                                                <p style="margin-left: 6px">Задача</p>
                                            </div>

                                            <div class="taskPriority">

                                            </div>

                                            <div class="taskCardName border-gray-300 text-gray-300" style="text-align:left">
                                                <p>Название</p>
                                            </div>
                                            <div class="taskStage border-gray-300 text-gray-300">
                                                <p>Статус</p>
                                            </div>
                                        </div>

                                        <case-line
                                            v-for="task in modalCases"
                                            :key="task.Task_id"
                                            :testCase="task"
                                            v-model="this.selectedCasesToAddInRun"
                                            :isForRegress="task.Task_isForRegress"
                                            :isLinked="false"
                                            :checkboxChecked="isCaseSelected(task.Task_id)"
                                            @update:checked-cases="updateCheckedCases"
                                        >
                                        </case-line>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="uk-modal-footer uk-text-right">
                            <button style="margin-right: 10px" class="uk-button uk-button-default uk-modal-close" type="button">Отмена</button>
                            <button @click="addCasesToRun" class="uk-button uk-button-primary uk-modal-close" type="button">Сохранить</button>
                        </div>

                    </div>
                </div>

                <div class="runFormCases">


                    <div style="display: grid;">
                        <div class="grid" style="width: 100%;">

                            <case-line-for-run
                                v-for="task in tasksList"
                                :key="task.Task_id"
                                :testCase="task"
                                v-model="this.selectedCasesToAddInRun"
                                :isForRegress="task.Task_isForRegress"
                                :checkboxChecked="isCaseInRunSelected(task.Task_id)"
                                @update:checked-run-cases="updateCheckedCasesInRun"
                            >
                            </case-line-for-run>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div v-if="selected !== 0" class="addCaseInRun">
        <a href="#modalAddCases" uk-toggle>
            <img src="/plus.svg" alt="">
        </a>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {default as Spin} from "../../Elements/Spin";
import {mapGetters} from "vuex";
import * as myMethods from "../../methods";
import TreeItem from "../../Shared/TreeItem";
import axios from "axios";
import CaseLine from "../../Shared/CaseLine";
import CaseLineForRun from "../../Shared/CaseLineForRun";
import {forEach} from "lodash";
import Donut from "../../Shared/Donut";

export default {
    name: "RunPage",
    components : {
        TreeItem, Head, Spin, Link, CaseLine, CaseLineForRun, Donut
    },
    props: {
        title: String,
        run: Object,
        user: Object,
    },
    data: () => ({
        loading: false,
        selected: 0,
        treeData: {
            id: 0,
            name: "Тест-ран",
            id_counter: 3,
            root: true,
            children: [
                { id: 1, name: "Задачи" },
                { id: 2, name: "Регрессионные кейсы" }
            ]
        },
        tasksList: [],
        tasksListAll: [],
        modalTreeData: {},
        modalSelected: 0,
        modalCasesAll: [],
        modalCases: [],
        selectedCasesToAddInRun: [],
        selectedCasesInRun: [],
        statistic: {
            labels: ['Положительный', 'Пропущен', 'Блокируется', 'Отрицательный', 'Не тестировалось'],
            data: [],
        },
    }),
    computed : {
        ...mapGetters ([
            'prefProject',
            'testrunStatuses',
            'testrunTypes',
            'caseStatuses',
            'priorityImagesLinks'
        ])
    },
    methods: {
        findArrayElementById(array, id, element) {
            return myMethods.findArrayElementById(array, id, element);
        },
        formatDateToRussian(value) {
            return myMethods.formatDateToRussian(value)
        },
        loadCasesInRun() {
            this.tasksList = []
            axios.post('/api/runResults/getCasesInRun', {'Run_id': this.run.Run_id})
            .then(res => {
                this.selectedCasesToAddInRun = [];
                this.tasksListAll = res.data;
                this.tasksList = this.tasksListAll;
                this.filterTaskList();
                forEach (res.data, (value) => {
                    this.selectedCasesToAddInRun.push(value.Task_id)
                })
            });
            this.getStatistic();
        },

        //работа с деревом

        makeFolder: function(item) {
            item.children = [];
            this.addItem(item);
        },
        addItem: function(item) {
            item.children.push({
                id: this.treeData.id_counter,
                name: "Новая папка " + this.treeData.id_counter
            });
            ++this.treeData.id_counter;
        },
        selectItem: function (id) {
            this.selected = id;
            this.filterTaskList();
        },
        filterTaskList: function (id) {
            if(this.selected === 0) { //если открыт корень - показываем все задачи
                this.tasksList = this.tasksListAll;
            } else { //иначе показываем только из конкретной папки
                this.tasksList = this.tasksListAll.filter(task => task.RunResult_SectionId === this.selected);
            }
        },
        itemIsSelected: function (id) {
            return id === this.selected;
        },
        renameFolder: function (o) {
            o.item.name = o.newName;
        },
        deleteFolder: function (o) {
            let arr = o.parent.children;
            console.log(o.ident)
            //находим индекс удаляемого элемента в массиве children родительского объекта и удаляем
            let i = arr.findIndex(child => child.id === o.ident);
            arr.splice(i, true)
        },

        //работа с модалкой

        //Получение дерева проекта
        getProjectTree() {
            this.modalTreeData = {}
            axios.post('/api/project/getProjectTree', {'Project_id': this.run.Project_id}).then(res => {
                this.modalTreeData = res.data
            })
        },

        //получение кейсов по выбранной папке дерева
        getCases() {
            this.modalCasesAll = []
            axios.post('/api/case/getCasesByProject', {'Project_id': this.run.Project_id}).then(res => {
                this.modalCasesAll = res.data
                this.modalCases = this.modalCasesAll
            })
        },

        //работа с деревом в модалке
        selectModalFolder: function (id) {
            this.modalSelected = id;
            this.findCasesByFolder();
        },
        findCasesByFolder: function () {
            if(this.modalSelected === 0) { //если открыт корень - показываем все задачи
                this.modalCases = this.modalCasesAll;
            } else { //иначе показываем только из конкретной папки
                this.modalCases = this.modalCasesAll.filter(task => task.Task_Folder === this.modalSelected);
            }
        },
        modalFolderIsSelected: function (id) {
            return id === this.modalSelected;
        },

        updateCheckedCases(id) {
            if (this.selectedCasesToAddInRun.includes(id)) {
                const index = this.selectedCasesToAddInRun.indexOf(id);
                this.selectedCasesToAddInRun.splice(index, 1);
            } else {
                this.selectedCasesToAddInRun.push(id);
            }
        },

        //метод проверки выбран ли кейс для отображения чекбокса
        isCaseSelected(id) {
            return this.selectedCasesToAddInRun.includes(id)
        },

        //метод проверки выбран ли кейс для отображения чекбокса
        isCaseInRunSelected(id) {
            return this.selectedCasesInRun.includes(id)
        },

        //работа с чекбоксами кейсов в ране
        updateCheckedCasesInRun(id) {
            if (this.selectedCasesInRun.includes(id)) {
                const index = this.selectedCasesInRun.indexOf(id);
                this.selectedCasesInRun.splice(index, 1);
            } else {
                this.selectedCasesInRun.push(id);
            }
        },

        addCasesToRun() {
            this.loading = true;
            axios.post('/api/runResults/addCasesToRun', {
                'selectedCasesToAddInRun': this.selectedCasesToAddInRun,
                'RunResult_SectionId': this.selected,
                'Run_id': this.run.Run_id
            });
            this.loadCasesInRun();
            this.loading = false;
        },
        getStatistic(){
            this.loading = true;
            axios.post('/api/runs/getRunStatistic', {
                'Run_id': this.run.Run_id
            }).then(res => {
                    this.statistic.data = [];
                res.data.forEach(el => {
                    this.statistic.data.push(el.count)
                })
                console.log(res.data)
            })
            this.loading = false;
        }

    },
    mounted() {
        this.loadCasesInRun();
        this.getProjectTree();
        this.getCases();
    }
}
</script>

<style scoped>

.modalAddCases {
    width: 80%;
}
</style>
