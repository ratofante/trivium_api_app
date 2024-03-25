<script setup>
import axios from 'axios'
import { ref } from 'vue'

axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

const form = ref({
  email: null,
  password: null
})

const user = ref()

async function onLogin() {
  await axios.get('http://localhost:8000/sanctum/csrf-cookie')
  await axios.post('http://localhost:8000/login', {
    email: form.value.email,
    password: form.value.password
  })

  let { data } = await axios.get('http://localhost:8000/api/user', {})
  user.value = data
  console.log(user.value)
}

async function getCategories() {
  let { data } = await axios.get('http://localhost:8000/api/cate')
}
</script>

<template>
  <main>
    <div>
      {{ user }}
    </div>
    <form @submit.prevent="onLogin">
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="form.email" />
      </div>
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="form.password" />
      </div>
      <div><button>Submit</button></div>
    </form>
    <div>
      <h2>Get categories</h2>
      <button @click="getCategories">Get</button>
    </div>
  </main>
</template>
