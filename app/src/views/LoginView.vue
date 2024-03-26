<script setup>
import axios from '@/composables/useAxios.js'
import { useRouter } from 'vue-router'
import { reactive, ref } from 'vue'

const router = useRouter()

const form = reactive({
  email: '',
  password: '',
  errorMsg: null
})
const user = ref()

async function handleSubmit() {
  try {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/login', {
      email: form.email,
      password: form.password
    })
    const { data } = await axios.get('api/user')

    if (data) {
      console.log(data)
      user.value = data
      router.push({ name: 'dashboard' })
    }
  } catch (e) {
    console.log(e)
    form.errorMsg = e
  }
}
</script>
<template>
  <main>
    <div>
      <h2>Login</h2>
    </div>
    <form @submit.prevent="handleSubmit">
      <div>
        <span>{{ form.errorMsg }}</span>
      </div>
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
  </main>
</template>
