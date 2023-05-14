<template>
    <Head :title="title"/>
    <spin v-if="loading"></spin>
    <div class="FormTitle">
        <h2>{{ title }}</h2>
    </div>

    <Link v-if="$attrs.user.User_Role > 0" :href="route('tasks.create', {'selected': selected})" class="text-blue-600 hover:text-blue-900 my-5 block">
        Добавить
    </Link>

    <div class="tasksForm">


        <div style="display: grid">
            <div id="treeAndCases" style="display: block; width: 100%; float: left">
                <div style="width: 30%; height: auto; float: left; margin: 0 0 0 0;">
                    <div class="runFormTree">
                        <tree-item
                            class="item"
                            :item="treeDataFromDb"
                            :selected="selected"
                            :project="prefProject"
                            :User_Role="$attrs.user.User_Role"
                            @make-folder="makeFolder"
                            @add-item="addItem"
                            @select-item="selectItem"
                            @item-is-selected="itemIsSelected"
                            @rename-folder="renameFolder"
                            @delete-folder="deleteFolder"
                        ></tree-item>
                    </div>
                </div>
                    <div class="runFormCases">
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
                                    v-for="task in tasksList"
                                    :key="task.Task_id"
                                    :test-case="task"
                                    :is-for-regress="task.Task_isForRegress"
                                    :is-linked="true"
                                >
                                </case-line>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import {default as Spin} from '../../Elements/Spin.vue'
import {Inertia} from '@inertiajs/inertia'
import {mapGetters} from 'vuex';
import CaseLine from "../../Shared/CaseLine";
import TreeItem from "../../Shared/TreeItem";
import axios from "axios";

export default {
    name: "CasesGridForm",
    props: {
        title: String,
        tasks: Array,
        tree: Object
    },
    components: {
        TreeItem,
        CaseLine,
        Head, Spin, Link
    },
    data: () => ({
        loading: false,
        treeDataFromDb: "",
        tasksList: [],
        selected: 1,
    }),
    mounted() {

        //парсим строку дерева в JSON
        this.treeDataFromDb = this.tree;
        this.treeDataFromDb = JSON.parse(this.treeDataFromDb);

        this.findCasesByFolder();

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
    computed: {
        ...mapGetters([
            'prefProject',
            'prefProjectName',
            'caseStatuses',
            'priorityImagesLinks'
        ])
    },
    сreated() {

    },
    methods: {
        //работа с деревом

        makeFolder: function (item) {
            item.children = [];
            this.addItem(item);
        },
        addItem: function (item) {
            this.loading = true;
            item.children.push({
                id: this.treeDataFromDb.id_counter,
                name: "Новая папка " + this.treeDataFromDb.id_counter
            });
            ++this.treeDataFromDb.id_counter;
            this.saveTree();
        },
        selectItem: function (id) {
            this.selected = id;
            this.findCasesByFolder();
        },
        saveTree: function () {
            axios.post('api/project/updateTree', {
                'Project_id': this.prefProject,
                'tree': JSON.stringify(this.treeDataFromDb)
            }).then(res => {
                if (res.data.tree) {
                    this.treeDataFromDb = res.data
                    this.treeDataFromDb = JSON.parse(this.treeDataFromDb.tree.Project_CasesTree);
                }
                this.loading = false;
            })
        },
        itemIsSelected: function (id) {
            return id === this.selected;
        },
        renameFolder: function (o) {
            o.item.name = o.newName;
            this.saveTree();
        },
        deleteFolder: function (o) {
            let arr = o.parent.children;
            console.log(o.ident)
            //находим индекс удаляемого элемента в массиве children родительского объекта и удаляем
            let i = arr.findIndex(child => child.id === o.ident);
            arr.splice(i, true)
            this.saveTree();
        },

        findCasesByFolder: function () {
            if (this.selected === 0) { //если открыт корень - показываем все задачи
                this.tasksList = this.tasks;
            } else { //иначе показываем только из конкретной папки
                this.tasksList = this.tasks.filter(task => task.Task_Folder === this.selected);
            }
        }
    }

}
</script>

<style>

</style>
