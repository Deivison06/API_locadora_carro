<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"><h1>Login</h1></div>
          <div class="card-body">
            <form method="POST" @submit.prevent="login">
              <input type="hidden" name="_token" :value="csrf_token" />
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                  >Email</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    value=""
                    required
                    autocomplete="email"
                    autofocus
                    v-model="email"
                  />
                </div>
              </div>

              <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end"
                  >Senha</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    name="password"
                    required
                    autocomplete="current-password"
                    v-model="password"
                  />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="remember"
                      id="remember"
                    />

                    <label class="form-check-label" for="remember">
                      Mantenha-me conectado
                    </label>
                  </div>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Login</button>
                  <a class="btn btn-link" href=""> Esqueci minha senha </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginContent",

  data() {
    return {
      email: "",
      password: "",
    };
  },

  props: ["csrf_token"],

  methods: {
    login(e) {
      fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
        //   "Content-Type": "application/json",
        },
        body: new URLSearchParams({
          email: this.email,
          password: this.password,
        }),
      }).then((response) => response.json())
      .then((data) => {
                    console.log(data);
                    if (data.token) {
                        document.cookie = `token=${data.token}`;
                    } else {
                        alert("Usuário ou senha inválidos");
                    }
                });
    },
  },
};
</script>
