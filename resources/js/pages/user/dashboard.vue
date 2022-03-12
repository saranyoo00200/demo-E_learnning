<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div
      v-show="this.$store.state.user_type == 3"
      class="container"
      id="content"
    >
      <div
        id="load"
        v-if="this.loading"
        class="d-flex align-items-center"
      ></div>
      <section v-else class="home-section">
        <h4><b>ปฎิทิน / ตารางเวลาสอน</b></h4>
        <hr />
        <FullCalendar :options="calendarOptions" />
      </section>
    </div>

    <div
      v-show="
        this.$store.state.user_type == 2 || this.$store.state.user_type == 1
      "
      class="container"
      id="content"
      style="margin-top: 10%"
    >
      <div
        id="load"
        v-if="this.loading"
        class="d-flex align-items-center"
      ></div>
      <div v-else>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800 text-xs font-weight-bold">
            แดชบอร์ด
          </h1>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 mb-4">
            <div class="row">
              <div class="col-xl-6 col-md-6 mb-4">
                <div
                  class="card border-left-primary shadow h-100 py-2"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal0"
                >
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="
                            text-xs
                            font-weight-bold
                            text-primary text-uppercase
                            mb-1
                          "
                        >
                          วิชาเรียนออนไลน์
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ learnOnline }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fa fa-desktop fa-2x text-gray-300"
                          aria-hidden="true"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-6 col-md-6 mb-4">
                <div
                  class="card border-left-success shadow h-100 py-2"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal1"
                >
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="
                            text-xs
                            font-weight-bold
                            text-success text-uppercase
                            mb-1
                          "
                        >
                          วิชาเรียนออฟไลน์
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ learnOffline }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fa fa-book fa-2x text-gray-300"
                          aria-hidden="true"
                        ></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6 mb-4">
                <div
                  class="card border-left-success shadow h-100 py-2"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal2"
                >
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="
                            text-xs
                            font-weight-bold
                            text-info text-uppercase
                            mb-1
                          "
                        >
                          วิชาเรียนออนไลน์
                        </div>
                        <span class="text-danger">(เรียนจบหลักสูตร)</span>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ learnOnlineCheck }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fa fa-desktop fa-2x text-gray-300"
                          aria-hidden="true"
                        ></i>
                        <i class="fas fa-check-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6 mb-4">
                <div
                  class="card border-left-success shadow h-100 py-2"
                  type="button"
                  data-toggle="modal"
                  data-target="#exampleModal3"
                >
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="
                            text-xs
                            font-weight-bold
                            text-uppercase
                            mb-info
                          "
                        >
                          วิชาเรียนออฟไลน์
                        </div>
                        <span class="text-danger">(เรียนจบหลักสูตร)</span>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          {{ learnOfflineCheck }}
                        </div>
                      </div>
                      <div class="col-auto">
                        <i
                          class="fa fa-book fa-2x text-gray-300"
                          aria-hidden="true"
                        ></i>
                        <i class="fas fa-check-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 mb-3">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div
                          class="
                            text-xs
                            font-weight-bold
                            text-warning text-uppercase
                            mb-1
                          "
                        >
                          สวัสดี!, {{ this.$store.state.user_name }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          พร้อมที่จะเริ่มเรียนรู้แล้วหรือยัง?
                        </div>
                      </div>
                      <div class="col-auto">
                        <img
                          width="100%"
                          height="100px"
                          src="/assets/frontend/images/img-dashboard.png"
                          alt=""
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 mb-4">
            <div
              class="card border-left-warning shadow h-100 py-2 mb-3"
              style="position: relative; max-height: 460px; overflow: auto"
            >
              <div
                class="
                  text-xs
                  font-weight-bold
                  text-danger text-uppercase
                  mt-4
                  ml-4
                "
              >
                วิชาเรียนวันนี้
              </div>
              <div class="card-body">
                <table class="table table-hover text-center">
                  <thead class="bg-light" style="position: sticky; top: 0">
                    <tr>
                      <th scope="col">เวลา</th>
                      <th scope="col">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                      </th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">เครื่องมือ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(data, index) in data_learn_online" :key="index">
                      <td scope="row">
                        {{ data.synch_starttime }}-{{ data.synch_endtime }} น.
                      </td>
                      <td>
                        <img
                          :src="data.image"
                          class="border border-dark rounded-circle"
                          width="35px"
                          height="35px"
                          alt=""
                        />
                      </td>
                      <td>{{ data.subjectName }}</td>
                      <td>
                        <router-link
                          @click="moveUp()"
                          :to="{
                            name: 'preface2',
                            params: { id: data.id },
                          }"
                          ><a class="btn btn-primary text-white"
                            >เข้าเรียน</a
                          ></router-link
                        >
                      </td>
                    </tr>
                    <tr
                      v-for="(data, index) in data_learn_offline_max"
                      :key="index"
                    >
                      <td scope="row">
                        {{ data.synch_starttime }}-{{ data.synch_endtime }} น.
                      </td>
                      <td>
                        <img
                          :src="data.image"
                          class="border border-dark rounded-circle"
                          width="35px"
                          height="35px"
                          alt=""
                        />
                      </td>
                      <td>{{ data.subjectName }}</td>
                      <td>
                        <a class="btn btn-secondary text-white disabled"
                          >เข้าเรียน</a
                        >
                      </td>
                    </tr>
                    <tr
                      v-for="(data, index) in data_learn_offline_min"
                      :key="index"
                    >
                      <td scope="row">
                        {{ data.synch_starttime }}-{{ data.synch_endtime }} น.
                      </td>
                      <td>
                        <img
                          :src="data.image"
                          class="border border-dark rounded-circle"
                          width="35px"
                          height="35px"
                          alt=""
                        />
                      </td>
                      <td>{{ data.subjectName }}</td>
                      <td>
                        <a class="btn btn-secondary text-white disabled"
                          >เข้าเรียน</a
                        >
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div v-show="this.show_subject_leasson_left > 0">
          <h3 class="text-xs font-weight-bold">การ์ดความคืบหน้า</h3>
          <div class="row">
            <div
              v-for="data in DataProgress"
              :key="data.id"
              v-show="data.count_progress != 100"
              class="col-md-4 my-3"
            >
              <div class="card shadow p-1 mb-5 bg-white rounded">
                <div class="card-body">
                  <div class="card-text">
                    <h6>วิชา: {{ data.subjectName }}</h6>
                    <p class="badge badge-warning">
                      หมวดหมู่: {{ data.category_name }}
                    </p>
                    <p><u>ความคืบหน้า</u></p>
                    <div class="progress" style="height: 25px">
                      <div
                        class="
                          progress-bar
                          bg-info
                          progress-bar-striped progress-bar-animated
                        "
                        role="progressbar"
                        :style="{ width: data.count_progress + '%' }"
                        aria-valuenow="15"
                        aria-valuemin="0"
                        aria-valuemax="100"
                      >
                        {{ data.count_progress }}%
                      </div>
                    </div>
                    <router-link
                      @click.native="moveUp()"
                      :to="{
                        name: 'preface2',
                        params: { id: data.id },
                      }"
                      ><a class="btn btn-primary mt-2 text-white float-right"
                        >เรียนต่อ</a
                      ></router-link
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- modal -->
      <div
        class="modal fade"
        id="exampleModal0"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>วิชาเรียนออนไลน์</h5>
              <div class="text-right">
                <i
                  data-dismiss="modal"
                  aria-label="Close"
                  class="fa fa-close"
                ></i>
              </div>
            </div>
            <div class="modal-body">
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">ลำดับ</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">ความคืบหน้า</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(k, index) in learnOnlines" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ k.subjectName }}</td>
                      <td>
                        <div class="progress" style="height: 25px">
                          <div
                            class="
                              progress-bar
                              bg-info
                              progress-bar-striped progress-bar-animated
                            "
                            role="progressbar"
                            :style="{ width: k.count_progress + '%' }"
                            aria-valuenow="15"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >
                            {{ k.count_progress }}%
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-show="learnOnlines == ''" class="text-center">
                    <tr>
                      <th scope="row" colspan="3">ไม่มีข้อมูล</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="exampleModal1"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>วิชาเรียนออฟไลน์</h5>
              <div class="text-right">
                <i
                  data-dismiss="modal"
                  aria-label="Close"
                  class="fa fa-close"
                ></i>
              </div>
            </div>
            <div class="modal-body">
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">ลำดับ</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">ความคืบหน้า</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(k, index) in learnOfflines" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ k.subjectName }}</td>
                      <td>
                        <div class="progress" style="height: 25px">
                          <div
                            class="
                              progress-bar
                              bg-info
                              progress-bar-striped progress-bar-animated
                            "
                            role="progressbar"
                            :style="{ width: k.count_progress + '%' }"
                            aria-valuenow="15"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >
                            {{ k.count_progress }}%
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-show="learnOfflines == ''" class="text-center">
                    <tr>
                      <th scope="row" colspan="3">ไม่มีข้อมูล</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="exampleModal2"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>
                วิชาเรียนออนไลน์
                <span class="text-danger">(เรียนจบหลักสูตร)</span>
              </h5>
              <div class="text-right">
                <i
                  data-dismiss="modal"
                  aria-label="Close"
                  class="fa fa-close"
                ></i>
              </div>
            </div>
            <div class="modal-body">
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">ลำดับ</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">ความคืบหน้า</th>
                      <th scope="col">ใบประกาศ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(k, index) in finishedOnline" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ k.subjectName }}</td>
                      <td>
                        <div class="progress" style="height: 25px">
                          <div
                            class="
                              progress-bar
                              bg-info
                              progress-bar-striped progress-bar-animated
                            "
                            role="progressbar"
                            :style="{ width: k.count_progress + '%' }"
                            aria-valuenow="15"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >
                            {{ k.count_progress }}%
                          </div>
                        </div>
                      </td>
                      <td>
                        <a
                          type="button"
                          class="btn btn-primary text-white btn-sm"
                          @click="downloadCerticate(k.subjectName, k.id)"
                          >Download</a
                        >
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-show="finishedOnline == ''" class="text-center">
                    <tr>
                      <th scope="row" colspan="4">ไม่มีข้อมูล</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="exampleModal3"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header float-right">
              <h5>
                วิชาเรียนออฟไลน์
                <span class="text-danger">(เรียนจบหลักสูตร)</span>
              </h5>
              <div class="text-right">
                <i
                  data-dismiss="modal"
                  aria-label="Close"
                  class="fa fa-close"
                ></i>
              </div>
            </div>
            <div class="modal-body">
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">ลำดับ</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">ความคืบหน้า</th>
                      <th scope="col">ใบประกาศ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(k, index) in finishedOffline" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ k.subjectName }}</td>
                      <td>
                        <div class="progress" style="height: 25px">
                          <div
                            class="
                              progress-bar
                              bg-info
                              progress-bar-striped progress-bar-animated
                            "
                            role="progressbar"
                            :style="{ width: k.count_progress + '%' }"
                            aria-valuenow="15"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >
                            {{ k.count_progress }}%
                          </div>
                        </div>
                      </td>
                      <td>
                        <a
                          type="button"
                          class="btn btn-primary text-white btn-sm"
                          @click="downloadCerticate(k.subjectName, k.id)"
                          >Download</a
                        >
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-show="finishedOffline == ''" class="text-center">
                    <tr>
                      <th scope="row" colspan="4">ไม่มีข้อมูล</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->
    </div>

    <div class="footer" id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script scoped>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import timeGridPlugin from "@fullcalendar/timegrid";
export default {
  name: "dashboard",
  components: { HeaderComponent, FooterComponent, FullCalendar },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, listPlugin, timeGridPlugin],
        initialView: "listWeek",
        selectable: true,
        dateClick: this.handleDateClick,
        events: [
          {
            title: "",
            start: "",
            end: "",
          },
        ],
        // eventColor: 'info',
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "timeGridDay,timeGridWeek,dayGridMonth,listWeek", //listWeek
        },
        locale: "th",
        slotLabelFormat: { hour12: false, hour: "2-digit", minute: "2-digit" },
        buttonText: {
          today: "วันนี้",
          month: "เดือน",
          week: "สัปดาห์",
          day: "วัน",
          list: "กำหนดการ",
        },
      },
      loading: true,
      show_subject_leasson_left: 0,
      DataProgress: [],
      learnOnline: "",
      learnOffline: "",
      learnOnlineCheck: "",
      learnOfflineCheck: "",
      data_leassons: [],
      data_learn_online: [],
      data_learn_offline_max: [],
      data_learn_offline_min: [],
      learnOnlines: [],
      learnOfflines: [],
      finishedOnline: [],
      finishedOffline: [],
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      this.DataProgressSubject();
      this.DataCalendar();

      //count or sum all learnOnline and LearnOffline
      axios
        .get("/api/index/" + this.$store.state.user_id + "/dashboard")
        .then((res) => {
          console.log(res.data);
          this.data_learn_online = res.data.data_learn_online;
          this.data_learn_offline_max = res.data.data_learn_offline_max;
          this.data_learn_offline_min = res.data.data_learn_offline_min;
          this.learnOnline = res.data.learnOnline;
          this.learnOffline = res.data.learnOffline;
          this.learnOnlineCheck = res.data.learnOnlineCheck;
          this.learnOfflineCheck = res.data.learnOfflineCheck;
          this.learnOnlines = res.data.learnOnlines;
          this.learnOfflines = res.data.learnOfflines;
          this.finishedOnline = res.data.finishedOnline;
          this.finishedOffline = res.data.finishedOffline;
        });
      //end count or sum all learnOnline and LearnOffline
    } else {
      this.loading = false;
      this.$router.push("/learning/login");
    }
  },
  methods: {
    DataCalendar() {
      axios
        .get("/api/teaching_time/" + this.$store.state.user_id)
        .then((res) => {
          // console.log(res.data);
          this.calendarOptions.events = [];
          for (let i = 0; i < res.data.length; i++) {
            this.calendarOptions.events[i] = {
              end: res.data[i].end,
              start: res.data[i].start,
              title: res.data[i].title,
            };
          }
          this.loading = false;
        })
        .catch((err) => {
          this.loading = false;
          this.error = "Error!!";
        });
    },
    DataProgressSubject() {
      axios
        .get("/api/my_subject_leasson_left/" + this.$store.state.user_id)
        .then((res) => {
          for (let i = 0; i < res.data.length; i++) {
            if (res.data[i].count_progress != 100) {
              this.show_subject_leasson_left++;
              //   console.log(this.show_subject_leasson_left);
            }
          }
          this.DataProgress = res.data;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.commit("clearToken");
          this.$router.push("/learning/login");
        });
    },
    currentDateTime() {
      const current = new Date();
      const date =
        (current.getDate() < 10 ? "0" : "") +
        current.getDate() +
        "-" +
        (current.getMonth() + 1) +
        "-" +
        (current.getFullYear() + 543);
      const dateTime = date;

      return dateTime;
    },
    downloadCerticate(value, subject_id) {
      axios({
        url: "/api/export_pdf/" + subject_id + "/" + this.$store.state.user_id,
        method: "GET",
        responseType: "blob",
      }).then((response) => {
        var fileURL = window.URL.createObjectURL(new Blob([response.data]));
        var fullUri = document.createElement("a");

        fullUri.href = fileURL;
        fullUri.setAttribute("download", "certificates/" + value + ".pdf");
        document.body.appendChild(fullUri);

        fullUri.click();
      });
    },
    moveUp() {
      window.scrollTo(0, 0);
    },
  },
};
</script>

<style scoped>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
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
h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}
</style>
