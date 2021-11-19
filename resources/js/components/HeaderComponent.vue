<template>
  <div>
    <nav class="main-navbar navbar-expand-lg navbar-light sticky-top">
      <a class="navbar-brand active" href="/">E-Learning</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/"
              >หน้าหลัก <span class="sr-only">(current)</span></router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/learning/course"
              >คอร์สเรียน</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/learning/news"
              >ข่าวสาร</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/learning/teacher"
              >อาจารย์ผู้สอน</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/learning/contact"
              >ติดต่อ</router-link
            >
          </li>
        </ul>
        <div>
          <div v-if="this.$store.state.token !== ''">
            <span class="navbar-text">
              <div class="row d-flex align-items-center">
                <div class="col-md-0">
                  <router-link to="/learning/dashboard"
                    ><img
                      class="rounded-circle"
                      :src="DataUser.user_photo"
                      width="35px"
                      height="35px"
                      alt=""
                  /></router-link>
                </div>
                <div class="col-md user-named">
                  <router-link
                    class="text-white"
                    type="button"
                    to="/learning/dashboard"
                    style="text-decoration: none"
                    ><h5>{{ this.$store.state.user_name }}</h5></router-link
                  >
                </div>
              </div>
            </span>
            <span class="navbar-text">
              <!-- Example split danger button -->
              <div class="btn-group">
                <button
                  type="button"
                  class="btn fas fa-chevron-down rounded bg-white"
                  style="color: #013d7c"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                ></button>
                <ul class="dropdown-menu">
                  <li>
                    <router-link
                      v-show="
                        this.$store.state.user_type == 2 ||
                        this.$store.state.user_type == 1
                      "
                      class="dropdown-item"
                      to="/learning/dashboard"
                      >แดชบอร์ด</router-link
                    >
                    <router-link
                      v-show="this.$store.state.user_type == 3"
                      class="dropdown-item"
                      to="/learning/dashboard"
                      >ตารางสอน</router-link
                    >
                  </li>
                  <li>
                    <router-link
                      v-show="
                        this.$store.state.user_type == 2 ||
                        this.$store.state.user_type == 1
                      "
                      class="dropdown-item"
                      to="/learning/dashboard/lessons"
                      >บทเรียน</router-link
                    >
                  </li>
                  <li>
                    <router-link class="dropdown-item" to="/learning/chat"
                      >แชทห้องเรียน</router-link
                    >
                  </li>
                  <li>
                    <router-link
                      v-show="
                        this.$store.state.user_type == 2 ||
                        this.$store.state.user_type == 1
                      "
                      class="dropdown-item"
                      to="/learning/dashboard/timetables"
                      >ตารางเรียน</router-link
                    >
                  </li>
                  <li>
                    <router-link
                      v-show="
                        this.$store.state.user_type == 2 ||
                        this.$store.state.user_type == 1
                      "
                      class="dropdown-item"
                      to="/learning/calendar_simulations"
                      >ลงทะเบียนเรียน</router-link
                    >
                  </li>
                  <li>
                    <router-link
                      class="dropdown-item"
                      to="/learning/dashboard/profiles"
                      >แก้ไขโปรไฟล์</router-link
                    >
                  </li>
                  <!-- <li>
                  <a class="dropdown-item" href="/learning/dashboard/certificates">ใบประกาศนียบัตร</a>
                </li> -->
                  <!-- <li>
                  <a class="dropdown-item" href="/learning/dashboard/settings">ตั้งค่า</a>
                </li> -->
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a @click="logout" type="button" class="dropdown-item"
                      ><i class="bx bx-log-out" id="log_out"> Log Out</i></a
                    >
                  </li>
                </ul>
              </div>
            </span>
          </div>
          <div v-else>
            <router-link :to="{ name: 'login' }"
              ><span class="navbar-text">
                <a
                  class="login btn action-button text-bold text-white"
                  href="#"
                  style="text-decoration: none"
                  ><i class="fas fa-user"></i> Log In</a
                ></span
              ></router-link
            >
            <router-link :to="{ name: 'register' }">
              <span class="navbar-text">
                <a
                  class="btn btn-light action-button"
                  role="button"
                  href="#"
                  style="border-radius: 50px"
                  >Signup</a
                >
              </span>
            </router-link>
          </div>
        </div>
      </div>
    </nav>
    <div style="margin-bottom: 66px"></div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "app",
  data() {
    return {
      DataUser: {},
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      axios
        .get("/api/auth/user-profile/", {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + this.$store.state.token,
          },
        })
        .then((res) => {
          for (var i = 0; i < res.data.length; i++) {
            this.DataUser = {
              user_photo: res.data[i].user_photo,
              name: res.data[i].name,
            };
          }
          this.loading = false;
          //   console.log(this.DataUser);
        })
        .catch((err) => {
          //   alert("error axios Dashboard!!");
          this.$store.commit("clearToken");
          this.$router.push("/learning/login");
        });
    } else {
      // alert("error this.$store.state.token!!");
      this.loading = false;
    }
  },
  methods: {
    logout() {
      axios
        .post("/api/auth/logout", { token: this.$store.state.token })
        .then((res) => {
          this.$store.commit("clearToken");
          //   this.$store.commit("clearCourse_id");
          this.$store.commit("clearUser_id");
          this.$store.commit("clearUser_name");
          this.$store.commit("clearUser_user_type");
          this.$router.push("/learning/login");
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
  },
};
</script>

<style scoped>
/* ##### >> https://fonts.google.com/specimen/Arimo */
@import url("https://fonts.googleapis.com/css2?family=Arimo:wght@500&display=swap");
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");

.main-navbar {
  font-family: "Sarabun", sans-serif;
  /* background: linear-gradient(135deg, #a12c2f, #fe2929df, #ff2f2f); */
  background-color: #013d7c;
  /* background-image: url("/assets/frontend/images/red_pixel_pattern_background.jpg"); */
  position: fixed;
  z-index: 1020;
  width: 100%;
}
.main-navbar .navbar-brand {
  background: transparent;
  padding-top: 1.2rem;
  color: #fff;
  border-radius: 0;
  box-shadow: none;
  border: none;
  font-size: 25px;
}
.main-navbar .navbar-brand {
  font-weight: bold;
}
.main-navbar .navbar-brand:hover {
  color: #f0f0f0;
}
.main-navbar .navbar-brand:focus {
  color: #fff;
}
.main-navbar .login:hover {
  font-weight: bold;
  color: #d9d9d9;
}
.navbar-text .dropdown-item {
  font-family: "Sarabun", sans-serif;
}
h1,
h2,
h3,
h4,
h5 {
  font-family: "Sarabun", sans-serif;
}
.user-li {
  border: 2px solid #a12c2f;
  content: "▼";
  padding: 5px;
}

/* ====================
      Form Search
==================== */
.main-navbar .collapse .form-inline label {
  color: #d9d9d9;
}
.main-navbar .collapse .form-inline .search-field {
  display: inline-block;
  width: 80%;
  background: none;
  border: none;
  border-bottom: 1px solid transparent;
  border-radius: 0;
  color: #fff;
  box-shadow: none;
  color: inherit;
  transition: border-bottom-color 0.3s;
}
.main-navbar .collapse .form-inline .search-field:focus {
  border-bottom: 1px solid #ccc;
}
/* ====================
      color li
==================== */
.main-navbar .collapse .nav-item .nav-link {
  color: #fff;
}
/* ====================
    mouse hover li
==================== */
.navbar-nav > li {
  display: inline-flex;
  padding: 5px;
  margin-left: 2px;
  color: #fff;
  cursor: pointer;
  transition: 0.3s linear all;
  user-select: none;
}
.navbar-nav > li:hover {
  color: #faa;
  box-shadow: 0 80px 5px rgba(255, 255, 255, 0.15) inset;
}
.navbar-nav .nav-item .nav-link:focus-within {
  color: #dfff00;
  font-weight: bold;
}

/* ====================
      responsive
==================== */
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
  .main-navbar {
    font-family: "Arimo", sans-serif;
    /* background: linear-gradient(135deg, #a12c2f, #fe2929df, #ff2f2f); */
    background-color: rgb(6, 57, 112);
    position: fixed;
    z-index: 1020;
    width: 100%;
  }
  .navbar-toggler {
    float: right;
    margin-right: 10px;
    margin-top: 20px;
    margin-bottom: 10px;
  }
  .main-navbar .navbar-brand {
    padding-bottom: 4rem;
  }
  nav {
    position: absolute;
    width: 100%;
    /* margin-top: 200px; */
    border-radius: 10px;
    border: solid 1px lightcyan;
  }
  nav ul {
    display: flex;
    flex-direction: column;
  }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
}
</style>
