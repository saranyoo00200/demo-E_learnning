<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>
    <div id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
      ></div>
      <div v-else class="sidebar-menu-container" id="sidebar-menu-container">
        <div class="container mt-5">
          <h2 style="text-align: center">ข้อมูลอาจารย์ผู้สอน</h2>
          <hr />
          <div class="page-content page-container">
            <div class="row container d-flex justify-content-center">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="" style="width: 50rem">
                  <h4 class="text-primary mb-3" style="font-weight: bolder">
                    {{ Teacher.name }}
                  </h4>
                  <!-- <p class="card-description">Basic Imagezoom Example</p> -->
                  <!-- <hr> -->
                  <div class="row">
                    <div class="col">
                      <img
                        :src="Teacher.image"
                        width="100%"
                        height="100%"
                        alt=""
                      />
                    </div>
                    <div class="col" style="font-size: 15px">
                      <p
                        class="text-info"
                        style="font-size: 18px; font-weight: bold"
                      >
                        <i class="bx bxs-book"></i> วิชาที่สอน
                      </p>
                      <span v-for="(n, index) in subjectName" :key="index"
                        ><router-link
                          :to="{
                            name: 'course_id',
                            params: { id: n.subject_id },
                          }"
                          ><a class="bt-2 text-dark">{{
                            n.subjectName
                          }}</a></router-link
                        >
                        <br
                      /></span>
                      <br /><br />
                      <hr />
                      <p
                        class="text-info"
                        style="font-size: 18px; font-weight: bold"
                      >
                        <i class="bx bx-mail-send"></i> อีเมล
                      </p>
                      {{ Teacher.email }} <br /><br />
                      <hr />
                      <p
                        class="text-info"
                        style="font-size: 18px; font-weight: bold"
                      >
                        <i class="bx bxs-phone"></i> เบอร์โทรติดต่อ
                      </p>
                      {{ Teacher.phone }} <br /><br />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a
            class="btn btn-info my-5"
            type="button"
            @click="$router.go(-1)"
            style="text-decoration: none; color: white; float: right"
            ><i class="fas fa-chevron-left"></i> กลับ
          </a>
        </div>
      </div>
    </div>

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script scope>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "teacher",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      Teacher: [],
      subjectName: [],
      loading: true,
    };
  },
  mounted() {
    this.DataTeacher();
  },
  methods: {
    DataTeacher(page) {
      axios
        .get("/api/teacher_id/" + this.$route.params.id)
        .then((res) => {
          this.subjectName = res.data;
          if (res.data[0].id == this.$route.params.id) {
            this.Teacher = {
              id: res.data[0].id,
              name: res.data[0].name,
              image: res.data[0].user_photo,
              subjectName: res.data[0].subjectName,
              email: res.data[0].email,
              phone: res.data[0].phone,
            };
          }
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}
#content {
  margin-top: 5%;
}
#load {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("https://cdn.discordapp.com/attachments/841562172697477130/901000684172877824/unnamed.gif")
    50% 50% no-repeat rgb(249, 249, 249);
  background-size: 100px;
}
.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
