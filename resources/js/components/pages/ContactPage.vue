<template>
  <section id="contact">
    <h2 class="mb-5">Contattaci</h2>
    <Alert v-if="alertMessage" type="success" >{{ alertMessage }}</Alert>
  
    <Loader v-if="isLoading" />
    <div v-else>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control bg-dark text-light"
          id="email"
          aria-describedby="emailHelp"
          name="email"
          v-model="form.email"
        />
        <small id="email" class="form-text text-light"
          >Invieremo una risposta al tuo indirizzo</small
        >
      </div>
      <div class="form-group">
        <label for="message">Testo</label>
        <textarea
          class="form-control bg-dark text-light"
          id="message"
          name="message"
          rows="10"
          v-model="form.message"
        ></textarea>
      </div>
      <button class="btn btn-secondary" @click="sendForm">Invia</button>
    </div>
  </section>
</template>

<script>
import Loader from "../Loader.vue";
import Alert from "../Alert.vue";
export default {
  name: "ContactPage",
  components: {
    Loader,
    Alert
  },
  data() {
    return {
      form: {
        email: "",
        message: "",
      },

      isLoading: false,
      alertMessage: "",
    };
  },
  methods: {
    sendForm() {
      this.isLoading = true;
      axios
        .post("http://localhost:8000/api/messages", this.form)
        .then((res) => {
          //con il metodo post invio
          //svuoto i campi dopo aver inviato i dati
          this.form.email = "";
          this.form.message = "";
          this.alertMessage = "Messaggio inviato con successo";
        })
        .catch((err) => {
          this.errors = { error: 'Si è verificato un errore'};
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
