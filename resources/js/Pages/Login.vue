<template>
  <Head :title="title" />

  <div class="title">
    <h2>{{title}}</h2>
  </div>
  <div class="loginFormContain">
    <div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm loginForm">
      <form>
        <div class="form-group mb-6">
          <label for="exampleInputEmail2" class="form-label inline-block mb-2 text-gray-700">Логин</label>
          <input type="text" class="form-control
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
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail2"
            aria-describedby="emailHelp" placeholder="Введите логин" required>
        </div> 
        <div class="form-group mb-6">
          <label for="exampleInputPassword2" class="form-label inline-block mb-2 text-gray-700">Пароль</label>
          <input type="password" class="form-control block
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
            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword2"
            placeholder="Введите пароль" required>
        </div>
        <div class="flex justify-between items-center mb-6">
          <div class="form-group form-check">
            <input type="checkbox"
              class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
              id="exampleCheck2">
            <label class="form-check-label inline-block text-gray-800" for="exampleCheck2">Remember me</label>
          </div>
        </div>
        <button type="submit" @click="login" class="
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
          ease-in-out">Войти</button>
    </form>
    </div>
  </div>
</template>

<script>
import {Head} from '@inertiajs/inertia-vue3'

export default {
    components: {
        Head
    },
    props: {
        title: String
    },
    methods: {
      login() {
        //Описание логина
      }
    }
}
</script>

<style>
  .title {
    margin-top: 10px;
    margin-left: 20px;
  }

  .loginFormContain {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    overflow: auto;
  }
  
  .loginForm {
    width: 30%;
    height: auto;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -125px 0 0 -125px;
  }
</style>