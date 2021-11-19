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
        <div class="sidebar-menu-push">
          <div class="sidebar-menu-overlay"></div>
          <div class="sidebar-menu-inner">
            <div class="page-heading">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="text-white" style="font-size: 90px">
                      <i
                        class="far fa-address-book"
                        style="font-size: 80px"
                      ></i>
                      ติดต่อเรา
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <section class="contact-info">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="contact-content">
                      <div class="contact-item">
                        <i class="fa fa-map-marker"></i>
                        <h4 class="font-weight-bold">ข้อมูลที่อยู่</h4>
                        <p>
                          1569 อาคารภูฟ้าเพลส,อำเภอเมืองเชียงใหม่ <br />
                          จังหวัดเชียงใหม่ 50300
                        </p>
                      </div>
                      <div class="contact-item">
                        <i class="fa fa-envelope-o"></i>
                        <h4 class="font-weight-bold">ข้อมูลอีเมล</h4>
                        <p>jigsawinnovation@gmail.com<br /><br /></p>
                      </div>
                      <div class="contact-item last-contact">
                        <i class="fa fa-phone"></i>
                        <h4 class="font-weight-bold">หมายเลขโทรศัพท์</h4>
                        <p>
                          086-322-3809 <br />
                          086-586-2599
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <section class="contact-form">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="location-contact">
                      <div class="widget-heading">
                        <h4>สถานที่ตั้ง</h4>
                      </div>
                      <div class="content-map">
                        <div id="map">
                          <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d944.1927282412923!2d98.962918!3d18.80836!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5febef9f4f9c5302!2z4Lir4Lit4Lie4Lix4LiB4Lig4Li54Lif4LmJ4Liy!5e0!3m2!1sth!2sth!4v1630380667716!5m2!1sth!2sth"
                            width="100%"
                            height="100%"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                          ></iframe>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <form @submit.prevent="submit">
                      <div class="message-form">
                        <div class="widget-heading">
                          <h4>ติดต่อเรา</h4>
                        </div>
                        <div class="message-content">
                          <div class="row">
                            <div class="col-md-6">
                              <input
                                id="name"
                                v-model="data.name"
                                type="text"
                                name="name"
                                placeholder="ชื่อ-นามสกุล"
                                required
                              />
                            </div>
                            <div class="col-md-6">
                              <input
                                id="email"
                                v-model="data.email"
                                type="email"
                                name="email"
                                placeholder="อีเมลแอดเดรส"
                                required
                              />
                            </div>
                            <div class="col-md-12">
                              <textarea
                                id="message"
                                v-model="data.message"
                                type="text"
                                class="message"
                                name="message"
                                placeholder="เขียนข้อความ"
                                required
                              ></textarea>
                            </div>
                          </div>
                          <div class="accent-button">
                            <button class="btn btn-warning" type="submit">
                              ส่งข้อความ
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <a
                  class="btn btn-info mt-4"
                  type="button"
                  @click="$router.go(-1)"
                  style="text-decoration: none; color: white; float: right"
                  ><i class="fas fa-chevron-left"></i> กลับ
                </a>
              </div>
            </section>

            <a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
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
// import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "app",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      data: {
        name: "",
        eamil: "",
        message: "",
      },
      loading: true,
    };
  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 300);
  },
  methods: {
    submit() {
      axios
        .post("/api/create/tickets/contact", this.data)
        .then((res) => {
          alert("ส่งข้อมูลเรียบร้อย");
          this.$router.go();
        })
        .catch((err) => {
          this.error = "Error!!";
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
#content {
  margin-top: 5%;
}
.backbt {
  background: #a12c2f;
  color: #fff;
}
.backbt:hover {
  background: #d43a3f;
}
</style>
