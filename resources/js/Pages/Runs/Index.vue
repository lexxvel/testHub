<template>
    <Head :title="title" />
    <div class="FormTitle">
        <h2>{{title}}</h2>
    </div>
    <spin v-if="loading"></spin>
    <div v-if="!loading" class="runsForm">
        <h3 v-if="this.runsList.length < 1">Опаньки... не найдено ни одного тест-рана</h3>
        <Link v-if="$attrs.user.User_Role > 1" :href="route('runs.create')" class="text-blue-600 hover:text-blue-900 my-5 block" style="width: 50px">
            Добавить
        </Link>

        <div v-if="this.runsList.length > 0" class="runsGrid">
            <div v-for="run in runsList" :key="run.Run_id" class="runCard rounded-lg shadow-lg bg-white">
                <div class="runCardStatus">
                    <div class="uk-inline">
                        <a href="">статус: {{ findArrayElementById(testrunStatuses, run.Run_Status, 'status')}}</a>
                        <!-- https://tailwind-elements.com/docs/standard/components/popover/
                            или https://tailwind-elements.com/docs/standard/components/dropdown/ -->
                        <div  class="uk-card uk-card-body uk-card-default top-center	" uk-drop="mode: click; pos: top-left" style="padding: 5px 5px 5px 5px; min-width: 200px; width: auto">
                            Выберите новый статус:
                            <div v-if="$attrs.user.User_Role !== 0" v-for="status in testrunStatuses">
                                <a @click="this.changeRunStatus(run.Run_id, status.id)">{{status.status}}</a> <br>
                            </div>

                        </div>
                    </div>
                </div>

                <Link :href="route('runs.edit', {Run_id: run.Run_id})" style="color: black">

                <div class="runCardTitle">
                    <p class=" runCardTitleText cut-text transition duration-150 ease-in-out"
                       data-bs-toggle="tooltip" :title="run.Run_Name">{{run.Run_Name}}</p>
                </div>
                <div class="runCardRunsStatuses">

                </div>
                <div class="runCardEndDate">
                    Окончание: {{formatDateToRussian(run.Run_EndDt)}}
                </div>
                <div class="runCardType">
                    Тип: {{findArrayElementById(testrunTypes, run.Run_Type, 'type')}}
                </div>
                </Link>
            </div>


        </div>

    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {default as Spin} from "../../Elements/Spin";
import {mapGetters} from "vuex";
import moment from 'moment'
import axios from "axios";
import * as myMethods from "../../methods";

export default {
    name: "Index",
    props: {
        title: String,
        runs: Array
    },
    components : {
        Head, Spin, Link
    },
    data: () => ({
        loading: false,
        runsList: [],
    }),
    computed : {
        ...mapGetters ([
            'testrunStatuses',
            'testrunTypes',
            'prefProject'
        ])
    },
    mounted() {

        this.runsList = this.runs;

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
        findArrayElementById(array, id, element) {
            return myMethods.findArrayElementById(array, id, element);
        },
        formatDateToRussian(value){
            return myMethods.formatDateToRussian(value)
        },
        changeRunStatus(run, status) {
            axios.post('/api/run/changeStatus', {
                'Run_id': run,
                'Run_Status': status
            }).then(res => {
                    if (res.data === '' ||res.data === null || !res.data ) {
                        UIkit.notification({message: "Произошла ошибка. Обратитесь к администратору", status: 'danger'});
                    } else {
                        if (res.data.status == false) {
                            UIkit.notification({message: res.data.error_msg, status: 'danger'});
                        } else {
                            this.$data.runsList = [];
                            this.loading = true;
                            axios.post('api/runs/byProject', {'Project_id': this.prefProject}).then(
                                res => {
                                    if (res.data === '' ||res.data === null || !res.data ) {
                                        UIkit.notification({message: "Произошла ошибка. Обратитесь к администратору", status: 'danger'});
                                    } else {
                                        if (res.data.status == false) {
                                            UIkit.notification({message: res.data.error_msg, status: 'danger'});
                                        } else {
                                            this.$data.runsList = res.data;
                                        }
                                    }
                                }
                            )
                            setTimeout(() => {
                                this.loading = false;
                            },  100)
                        }
                    }

                })
                .catch(err => {
                    if (err.response) {
                        this.$router.push('/').catch(()=>{})
                        UIkit.notification({message: 'Сессия истекла!', status: 'danger'});
                    } else if (err.request) {
                        this.$router.push('/').catch(()=>{})
                        UIkit.notification({message: 'Сессия истекла!', status: 'danger'});
                    } else {
                        // anything else
                    }
                })
        }
    }
}
</script>

<style scoped>
.runsForm {
    width: 100%;
    min-height: 100%;
    height: auto;
}

.runsGrid {
    width: 100%;
    min-height: 800px;
    height: auto;
}

.runCard {
    float: left;
    min-height: 180px;
    height: 30%;
    min-width: 250px;
    width: 32%;
    display: block;

    margin-left: 3px;
    margin-right: 7px;
    margin-bottom: 3px;
}

.runCard:hover {
    background-color: rgb(233, 233, 233);
}

.runCardStatus {
    display: block;
    float: left;
    width: 100%;
    min-height: 20px;
    height: 20px;
    margin-left: 5px;
    margin-right: 5px;
}

.runCardTitle {
    display: block;
    float: left;
    width: 100%;
    min-height: 30px;
    height: 30px;
    margin-left: 5px;
    margin-right: 5px;
    overflow: hidden;
}

.runCardTitleText {
    font-size: large;
    font-weight: bold;
}

.runCardRunsStatuses {
    display: block;
    float: left;
    width: 100%;
    min-height: 100px;
    height: auto;
}

.runCardEndDate {
    display: block;
    float: left;
    width: 50%;
    min-height: 20px;
    height: auto;
    padding-left: 5px;
    padding-right: 5px;
    overflow: hidden;
}

.runCardType {
    display: block;
    float: left;
    width: 50%;
    min-height: 20px;
    height: auto;
    padding-left: 5px;
    padding-right: 5px;
    overflow: hidden;
    text-align: right;
}

</style>
