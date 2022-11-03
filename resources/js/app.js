import { createApp, h, registerRuntimeCompiler } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { createStore } from 'vuex'
import { VueCookieNext } from 'vue-cookie-next'

import Layout from './Shared/Layout';

const store = createStore({
    state: {
        preferProject: VueCookieNext.getCookie('prefProject'), // localStorage.getItem('prefProject') || '',
        preferProjectId: VueCookieNext.getCookie('prefProjectId'), //localStorage.getItem('prefProjectId') || '',
        taskStages: [
            {'id': 0, 'stage': 'Не готов'},
            {'id': 1, 'stage': 'Требует доработки'},
            {'id': 2, 'stage': 'Готов'}
        ],
        priorityImagesLinks: [
            {'id': 0, 'link': '/lowPriority.svg'},
            {'id': 1, 'link': '/mediumPriority.svg'},
            {'id': 2, 'link': '/highPriority.svg'} ,
            {'id': 3, 'link': '/blockerPriority.svg'}
        ],
        jiraProjects: [
            {'project' : 'PROMEDWEB'},
            {'project' : 'MOBILEDEV'},
            {'project' : 'PROMEDTEST'},
            {'project' : 'PROMEDDEVOPS'},
            {'project' : 'DESIGN'},
            {'project' : 'RM'},
            {'project' : 'PROMEDSKUF'},
        ],
        taskPriorities: [
            {'id': 0, 'priority': 'Низкий'},
            {'id': 1, 'priority': 'Средний'},
            {'id': 2, 'priority': 'Высокий'},
            {'id': 3, 'priority': 'Блокирующий'},
        ],
        caseStatus: [
            {'id': 0, 'status': 'Не готов', 'class': 'bg-red-100'},
            {'id': 1, 'status': 'Требует доработки', 'class': 'bg-yellow-100'},
            {'id': 2, 'status': 'Готов', 'class': 'bg-green-100'},
        ]
    },
    mutations: {
      increment (state) {
        state.count++
      },
      setPreferProject (state, {name, id}) {
        state.preferProjectId = id
        state.preferProject = name
      }
    },
    actions: {
        setPreferProject({commit}, {name, id} ) {
            VueCookieNext.setCookie('prefProject', name)
            VueCookieNext.setCookie('prefProjectId', id)
            localStorage.setItem('prefProject', name)
            localStorage.setItem('prefProjectId', id)
            commit('setPreferProject', {name, id})
        }
    },
    getters: {
        prefProject(state) { return state.preferProjectId },
        prefProjectName(state) { return state.preferProject },
        taskStages(state) { return state.taskStages },
        priorityImagesLinks(state) { return state.priorityImagesLinks },
        jiraProjects(state) { return state.jiraProjects },
        taskPriorities(state) { return state.taskPriorities },
        caseStatuses(state) { return state.caseStatus }
      }
  })

VueCookieNext.config({ expire: '30d', secure: true })

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout = page.layout || Layout

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(VueCookieNext)
            .use(store)
            .mixin({methods: {route: window.route}})
            .mount(el)
    },
})
