import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { createStore } from 'vuex'
import { VueCookieNext } from 'vue-cookie-next'

import Layout from './Shared/Layout';

const store = createStore({
    state: {
        preferProject: localStorage.getItem('prefProject') || '',
        preferProjectId: localStorage.getItem('prefProjectId') || '',
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
        prefProject(state) {
            return state.preferProjectId
        },
        prefProjectName(state) {
            return state.preferProject
        },
      }
  })
  

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
