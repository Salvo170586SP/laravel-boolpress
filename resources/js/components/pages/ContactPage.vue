<template>
  <section id="contact">
    <h2 class="mb-5">Contattaci</h2>

    <Loader v-if="isLoading" />

    <div v-else>
      <Alert
        v-if="hasErrors || alertMessage"
        :type="hasErrors ? 'danger' : 'success'"
      >
        <!-- alert se il messaggio è stato inviato con successo -->
        <div v-if="alertMessage">{{ alertMessage }}</div>

        <!-- alert degli errori -->
        <ul v-if="hasErrors">
          <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
      </Alert>

      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control bg-dark text-light"
          id="email"
          aria-describedby="emailHelp"
          name="email"
          v-model="form.email"
          :class="{ 'is-invalid': errors.email }"
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
          :class="{ 'is-invalid': errors.message }"
        ></textarea>
      </div>
      <button class="btn btn-secondary" @click="sendForm">Invia</button>
    </div>
  </section>
</template>

<script>
import Loader from "../Loader.vue";
import Alert from "../Alert.vue";
import { isEmpty } from "lodash";
export default {
  name: "ContactPage",
  components: {
    Loader,
    Alert,
  },
  data() {
    return {
      form: {
        email: "",
        message: "",
      },

      isLoading: false,
      alertMessage: "",
      errors: {},
    };
  },

  methods: {
    sendForm() {
      //#VALIDAZIONE DEL FORM
      const errors = {};
      if (!this.form.email.trim())
        errors.email = "L'indirizzo email è obbligatorio";
      if (!this.form.message.trim())
        errors.message = "Il messaggio è obbligatorio";

      if (!this.form.email.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/)) {
        errors.email = "La mail inserita non è valida";
      }

      this.errors = errors;
      //#FINE VALIDAZIONE

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
          console.error(err.response.status);
          this.errors = { error: "Si è verificato un errore" };
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    hasErrors() {
      //se l'oggetto errors non è vuoto allora ci sono errori
      return !isEmpty(this.errors);
    },
  },
};
</script>
