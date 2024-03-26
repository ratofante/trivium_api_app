<script setup>
import axios from 'axios'
import { reactive, watch } from 'vue'

const form = reactive({
  question: '',
  answer: '',
  opt_1: '',
  opt_2: '',
  opt_3: '',
  category_id: null
})

watch(form, (newValue) => {
  console.log(newValue)
})

async function storeQuestion() {
  axios
    .post('http://localhost:8000/api/questions', {
      question: form.question,
      answer: form.answer,
      opt_1: form.opt_1,
      opt_2: form.opt_2,
      opt_3: form.opt_3,
      category_id: form.category
    })
    .then((response) => {
      console.log(response)
    })
    .catch((err) => {
      console.log('Error: ' + err.message)
    })
}
</script>
<template>
  <main>
    <form @submit.prevent="storeQuestion">
      <div>
        <label for="question">Pregunta</label>
        <input id="question" name="question" type="text" v-model="form.question" />
      </div>
      <div>
        <label for="answer">Respuesta</label>
        <input id="answer" name="answer" type="text" v-model="form.answer" />
      </div>
      <div>
        <label for="opt_1">Alternativa A</label>
        <input id="opt_1" name="opt_1" type="text" v-model="form.opt_1" />
      </div>
      <div>
        <label for="opt_2">Alternativa B</label>
        <input id="opt_2" name="opt_2" type="text" v-model="form.opt_2" />
      </div>
      <div>
        <label for="opt_3">Alternativa C</label>
        <input id="opt_3" name="opt_3" type="text" v-model="form.opt_3" />
      </div>
      <div>
        <label for="category_id">Categoría</label>
        <select id="category_id" name="category_id" v-model="form.category_id">
          <option :value="1">Arts</option>
          <option :value="2">Sports</option>
          <option :value="3">History</option>
          <option :value="4">Science</option>
        </select>
      </div>
      <div>
        <button>Guardar</button>
      </div>
    </form>
  </main>
</template>
