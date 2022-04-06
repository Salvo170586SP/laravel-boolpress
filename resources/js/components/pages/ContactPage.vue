<template>
  <section id="contact">

    <h2 class="mb-5">Contattaci</h2>

    <div class="form-group">
      <label for="email">Email</label>
      <input
        type="email"
        class="form-control bg-dark text-light"
        id="email"
        aria-describedby="emailHelp"
        name="email"
        v-model="inputEmail"
      />
      <small id="emailHelp" class="form-text text-light"
        >Invieremo una risposta al tuo indirizzo</small
      >
    </div>
    <div class="form-group">
      <label for="description">Testo</label>
      <textarea
        class="form-control bg-dark text-light"
        id="description"
        name="description"
        rows="10"
        v-model="inputText"
      ></textarea>
    </div>
    <button class="btn btn-secondary" type="submit" @click="submit">Invia</button>
  </section>
</template>

<script>
export default {
  name: "ContactPage",
  data(){
    return{
      inputText: '',
      inputEmail: '',
    }
  },
  methods:{
    submit(){
      const dati = this.inputText + ' ' + this.inputEmail;
      console.log(dati + ' ' + 'inviato');
    }
  }
};
</script>
