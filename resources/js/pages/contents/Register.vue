<template>
  <div id="register main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div class="register-form" style="margin-top: 10%">
      <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
          <div class="col-md-6">
            <div class="card px-5 py-5">
              <span class="circle"><i class="fa fa-check"></i></span>
              <h5 class="mt-3">สมัครสมาชิกเพื่อเข้าสู่บทเรียน</h5>
              <form
                @submit.prevent="register"
                method="post"
                oninput='password_confirmation.setCustomValidity(password_confirmation.value != password.value ? "รหัสผ่านไม่ตรงกัน" : "")'
              >
                <div class="form-row">
                  <div
                    class="form-input col-md-12 mb-2"
                    v-bind:class="{ mx_recaptcha_failed: validatorName }"
                  >
                    <label for="inputName">ชื่อผู้ใช้</label>
                    <input
                      v-model="credentials.name"
                      id="inputName"
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="ชื่อ-นามสกุล"
                      required
                    />
                    <small class="mt-2">มีผู้ใช้ name นี้อยู่แล้ว!</small>
                  </div>
                  <div
                    class="form-input col-md-12 mb-2"
                    v-bind:class="{ mx_recaptcha_failed: validatorUsername }"
                  >
                    <label for="inputUsername">รหัสผู้ใช้</label>
                    <input
                      v-model="credentials.username"
                      id="inputUsername"
                      type="text"
                      name="username"
                      class="form-control"
                      placeholder="รหัสผู้ใช้"
                      required
                    />
                    <small class="mt-2">มีผู้ใช้ username นี้อยู่แล้ว!</small>
                  </div>
                </div>
                <div
                  class="form-input mb-2"
                  v-bind:class="{ mx_recaptcha_failed: validatorEmail }"
                >
                  <label for="inputEmail">อีเมล</label>
                  <input
                    v-model="credentials.email"
                    id="inputEmail"
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="อีเมล"
                    required
                  />
                  <small class="mt-2">มีผู้ใช้ email นี้อยู่แล้ว!</small>
                </div>
                <div
                  class="form-input mb-2"
                  v-bind:class="{ mx_recaptcha_failed: validatorPassword }"
                >
                  <label for="inputPassword">รหัสผ่าน</label>
                  <input
                    v-model="credentials.password"
                    id="inputPassword"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="รหัสผ่าน"
                    required
                  />
                  <small class="mt-2">โปรดใส่ password มากกว่า 6 ตัว!</small>
                </div>
                <div class="form-input mb-2">
                  <label for="inputPassword_confirmation"
                    >ยืนยันรหัสผ่าน</label
                  >
                  <input
                    v-model="credentials.password_confirmation"
                    id="inputPassword_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="ยืนยันรหัสผ่าน"
                    required
                  />
                </div>
                <div
                  class="form-input"
                  v-bind:class="{ mx_recaptcha_failed: checkRecaptcha }"
                >
                  <vue-recaptcha
                    sitekey="6LekUqccAAAAAMCHxMpo1zU65gfxDr8EFDcwEL0_"
                    @verify="mxVerify"
                  ></vue-recaptcha>
                  <small class="mt-2">Doesn't complete!</small>
                </div>
                <button
                  type="submit"
                  class="btn btn-lg btn-primary btn-block mt-4 text-uppercase"
                >
                  ยืนยัน
                </button>
                <div class="text-center mt-4">
                  <span>เป็นสมาชิกอยู่แล้ว?</span>
                  <router-link
                    :to="{ name: 'login' }"
                    class="text-decoration-none"
                    >เข้าสู้ระบบ</router-link
                  >
                </div>
                <hr class="my-4" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import VueRecaptcha from "vue-recaptcha";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "register",
  components: { HeaderComponent, FooterComponent, VueRecaptcha },
  data() {
    return {
      credentials: {
        name: "",
        username: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      recaptcha: null,
      checkRecaptcha: false,
      validatorName: false,
      validatorUsername: false,
      validatorEmail: false,
      validatorPassword: false,
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/auth/user-profile", {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.$store.state.token,
          },
        })
        .then((res) => {
          if (res) {
            // alert("Login mounted success!!");
            this.loading = false;
            this.$router.push("/learning/dashboard");
          } else {
            // alert("Login mounted axios err!!");
            this.$router.push("/learning/login");
            this.$store.commit("clearToken");
            this.loading = false;
          }
        });
    } else {
      this.loading = false;
      //   this.$router.push("/learning/dashboard");
    }
  },
  methods: {
    mxVerify(response) {
      this.recaptcha = response;
      this.checkRecaptcha = false;
      this.resetRecaptcha();
    },
    resetRecaptcha() {
      setTimeout(() => {
        this.recaptcha = null;
        this.checkRecaptcha = false;
      }, 1000 * 60);
    },
    register() {
      if (this.recaptcha == null) {
        this.checkRecaptcha = true;
      }
      if (this.recaptcha) {
        axios
          .post("/api/auth/register", this.credentials)
          .then((res) => {
            this.$router.push("/learning/login");
          })
          .catch((err) => {
            this.validatorName = err.response.data.validatorName;
            this.validatorUsername = err.response.data.validatorUsername;
            this.validatorEmail = err.response.data.validatorEmail;
            this.validatorPassword = err.response.data.validatorPassword;
            this.error = "Error!!";
          });
      }
    },
    // signup() {
    //   axios
    //     .post("/api/auth/register", this.credentials)
    //     .then((res) => {
    //       this.$router.push("/learning/login");
    //     })
    //     .catch((err) => {
    //       this.error = "Error!!";
    //     });
    // },
  },
};
</script>

<style>
small {
  color: red;
  display: none;
}
.mx_recaptcha_failed small {
  display: block;
}

.passwords {
  display: none;
}
</style>
