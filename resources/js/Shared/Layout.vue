<template>
  <div class="container mx-auto">
    <div class="header">
        <nav class="uk-navbar-container" uk-navbar>
        <Link href="/">
          <img class="logo" src="/mainlogo.png" alt="" href="">
        </Link>
        <div class="uk-navbar-right">
          <ul class="uk-navbar-nav">
            <li v-if="$page.props.user"><Link href="/projects" style="min-height:55px; max-height:55px">{{ prefProjectName }}</Link></li>
            <li v-if="$page.props.user"><Link href="/tasks" :data="{ Project_id: prefProject }" style="min-height:55px; max-height:55px">Задачи</Link></li>
            <li v-if="$page.props.user && $page.props.user.User_Role > 9" ><Link href="/users" style="min-height:55px; max-height:55px">Пользователи</Link></li>
            <li v-if="$page.props.user"><Link href="/testruns" style="min-height:55px; max-height:55px">Тестраны</Link></li>
            <li class="uk-active" v-if="!$page.props.user"><Link href="/login" style="min-height:55px; max-height:55px">Войти</Link></li>
            <li>
              <div class="uk-navbar-right" v-if="$page.props.user">
                <ul class="uk-navbar-nav">
                  <li class="uk-active" v-if="$page.props.user" ><a href="#" id="HeaderUserName" style="min-height:55px; max-height:55px">{{$page.props.user.email}}</a></li>
                  <li><Link @click="logout" id="HeaderLogoutBtn" v-if="$page.props.user" style="color:red; min-height:55px; max-height:55px">Выход</Link></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </nav>
  </div>
    
    <div class="contain">
      <slot />
    </div>

    <div class="footer">

    </div>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'
import {Link} from '@inertiajs/inertia-vue3'
import {mapGetters} from 'vuex';

export default {
    components: {
        Link
    },
    computed : {
        ...mapGetters ([
          'prefProject',
          'prefProjectName'
        ])
    },
    data:() => ({
    }),
    methods: {
      logout() {
        this.$inertia.delete(route('logout'))
      }
    },
    created() {
    }
}
</script>

<style>

    body {
    min-width: 75%;
    max-width: 75%;
    height: 100%;
    margin: 0 auto 0 auto; 
    }

    .header {
        height: auto;
    }

    .logo {
        min-height: 55px;
        max-height: 55px;
    }

    .uk-navbar-container{
    height: 55px;
    background-color: azure;
    }

    .uk-navbar-nav{
    height: 55px;
    }

    .uk-active{
    height: 55px;
    }

    .LIheaderDD{
    height: 55px;
    }

</style>