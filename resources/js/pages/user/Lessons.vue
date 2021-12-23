<template>
  <div id="main">
    <div id="header">
      <HeaderComponent />
    </div>

    <div class="container" id="content">
      <div
        v-if="this.loading"
        id="load"
        class="d-flex align-items-center"
        style="padding-top: 10em"
      ></div>
      <section v-else>
        <h4>หลักสูตร / คอร์สเรียนของฉัน</h4>
        <hr />
        <!-- when have data. -->
        <div
          v-if="
            this.my_subject_leassons != '' ||
            this.my_subject_leassons_left != ''
          "
        >
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#data1"
                    >คอร์สเรียน</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#data2"
                    >คอร์สเรียนจบแล้ว</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#data3"
                    >คะแนนสอบก่อนเรียน</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#data4"
                    >คะแนนสอบหลังเรียน</a
                  >
                </li>
              </ul>
            </div>
            <div class="card-body p-0 tab-content">
              <div
                id="data1"
                class="
                  table-responsive table-invoice
                  tab-pane
                  active
                  table-wrapper-scroll-y
                  my-custom-scrollbar
                "
              >
                <div class="float-right my-3 mr-3">
                  <div class="input-group">
                    <div class="form-outline" style="padding-right: 5px">
                      <input
                        id="form1"
                        type="search"
                        v-model="search"
                        placeholder="ค้นหา"
                        class="form-control"
                      />
                    </div>
                    <button type="button" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div>
                      <div
                        class="my-3"
                        v-for="lesson in filteredSheeps"
                        :key="lesson.id"
                        v-show="lesson.count_progress != 100"
                      >
                        <div class="card p-3">
                          <div class="mb-0 p-3 text-left">
                            <i class="fa fa-leanpub" aria-hidden="true"></i>
                            <span class="text-info"><b>แบบประสานเวลา</b></span>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <span
                                ><img
                                  width="100px"
                                  height="100px"
                                  class="border border-dark rounded ml-3"
                                  :src="lesson.image"
                                  alt=""
                              /></span>
                            </div>
                            <div class="col-md-6">
                              <p>
                                รหัสวิชา:
                                <b
                                  ><u>{{ lesson.subjectId }}</u></b
                                >
                              </p>
                              <p>ชื่อวิชา: {{ lesson.subjectName }}</p>
                            </div>
                            <div class="col-md">
                              <div class="p-2 text-right">
                                <div class="dropright">
                                  <a
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="btn btn-primary"
                                    ><i class="fa fa-cog" aria-hidden="true"></i
                                  ></a>
                                  <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                  >
                                    <li>
                                      <div v-if="lesson.attendClass == 1">
                                        <a
                                          v-if="lesson.student_status == 1"
                                          class="dropdown-item"
                                          ><router-link
                                            style="
                                              text-decoration: none;
                                              color: black;
                                            "
                                            @click.native="moveUp()"
                                            :to="{
                                              name: 'preface2',
                                              params: { id: lesson.id },
                                            }"
                                            >เริ่มเรียน</router-link
                                          ></a
                                        >
                                        <a
                                          v-else
                                          class="dropdown-item disabled"
                                          href="#"
                                          >รอการยืนยัน</a
                                        >
                                      </div>
                                      <div v-else>
                                        <a
                                          v-if="lesson.student_status == 1"
                                          class="dropdown-item disabled"
                                          style="color: #b3bac0"
                                          >เริ่มเรียน</a
                                        >
                                        <a
                                          v-else
                                          class="dropdown-item disabled"
                                          href="#"
                                          >รอการยืนยัน</a
                                        >
                                      </div>
                                    </li>
                                    <li>
                                      <a class="dropdown-item" type="button"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'lessons_id',
                                            params: { id: lesson.id },
                                          }"
                                          >ดูหลักสูตร</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a
                                        v-if="lesson.count_progress == 100"
                                        class="dropdown-item"
                                        @click="
                                          downloadCerticate(
                                            lesson.subjectName,
                                            lesson.id
                                          )
                                        "
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                      <a
                                        v-else
                                        class="dropdown-item disabled"
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                      <a
                                        class="dropdown-item"
                                        style="cursor: pointer"
                                        @click="
                                          destroy_subject(lesson.class_id)
                                        "
                                        >ยกเลิกหลักสูตร</a
                                      >
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div
                        v-for="lesson in filteredSheeps2"
                        :key="lesson.id"
                        v-show="lesson.count_progress != 100"
                      >
                        <div class="card p-3 my-3">
                          <div class="mb-0 p-3 text-left">
                            <i class="fa fa-leanpub" aria-hidden="true"></i>
                            <span class="text-danger"
                              ><b>แบบไม่ประสานเวลา</b></span
                            >
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <span
                                ><img
                                  width="100px"
                                  height="100px"
                                  class="border border-dark rounded ml-3"
                                  :src="lesson.image"
                                  alt=""
                              /></span>
                            </div>
                            <div class="col-md-6">
                              <p>
                                รหัสวิชา:
                                <b
                                  ><u>{{ lesson.subjectId }}</u></b
                                >
                              </p>
                              <p>ชื่อวิชา: {{ lesson.subjectName }}</p>
                            </div>
                            <div class="col-md">
                              <div class="p-2 text-right">
                                <div class="dropright">
                                  <a
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="btn btn-primary"
                                    ><i class="fa fa-cog" aria-hidden="true"></i
                                  ></a>
                                  <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                  >
                                    <li>
                                      <a class="dropdown-item"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'preface2',
                                            params: { id: lesson.id },
                                          }"
                                          >เริ่มเรียน</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a class="dropdown-item"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'lessons_id',
                                            params: { id: lesson.id },
                                          }"
                                          >ดูหลักสูตร</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a
                                        v-if="lesson.count_progress == 100"
                                        class="dropdown-item"
                                        @click="
                                          downloadCerticate(
                                            lesson.subjectName,
                                            lesson.id
                                          )
                                        "
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                      <a
                                        v-else
                                        class="dropdown-item disabled"
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                      <a
                                        class="dropdown-item"
                                        style="cursor: pointer"
                                        @click="
                                          destroy_subject(lesson.class_id)
                                        "
                                        >ยกเลิกหลักสูตร</a
                                      >
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                id="data2"
                class="
                  table-responsive table-invoice
                  tab-pane
                  fade
                  table-wrapper-scroll-y
                  my-custom-scrollbar
                "
              >
                <div class="float-right my-3 mr-3">
                  <div class="input-group">
                    <div class="form-outline" style="padding-right: 5px">
                      <input
                        id="form1"
                        type="search"
                        v-model="search"
                        placeholder="ค้นหา"
                        class="form-control"
                      />
                    </div>
                    <button type="button" class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div>
                      <div
                        class="my-3"
                        v-for="lesson in filteredSheeps"
                        :key="lesson.id"
                        v-show="lesson.count_progress == 100"
                      >
                        <div class="card p-3">
                          <div class="mb-0 p-3 text-left">
                            <i class="fa fa-leanpub" aria-hidden="true"></i>
                            <span class="text-info"><b>แบบประสานเวลา</b></span>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <span
                                ><img
                                  width="100px"
                                  height="100px"
                                  class="border border-dark rounded ml-3"
                                  :src="lesson.image"
                                  alt=""
                              /></span>
                            </div>
                            <div class="col-md-6">
                              <p>
                                รหัสวิชา:
                                <b
                                  ><u>{{ lesson.subjectId }}</u></b
                                >
                              </p>
                              <p>ชื่อวิชา: {{ lesson.subjectName }}</p>
                            </div>
                            <div class="col-md">
                              <div class="p-2 text-right">
                                <div class="dropright">
                                  <a
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="btn btn-primary"
                                    ><i class="fa fa-cog" aria-hidden="true"></i
                                  ></a>
                                  <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                  >
                                    <li>
                                      <div v-if="lesson.attendClass == 1">
                                        <a
                                          v-if="lesson.student_status == 1"
                                          class="dropdown-item"
                                          ><router-link
                                            style="
                                              text-decoration: none;
                                              color: black;
                                            "
                                            @click.native="moveUp()"
                                            :to="{
                                              name: 'preface2',
                                              params: { id: lesson.id },
                                            }"
                                            >เริ่มเรียน</router-link
                                          ></a
                                        >
                                        <a
                                          v-else
                                          class="dropdown-item disabled"
                                          href="#"
                                          >รอการยืนยัน</a
                                        >
                                      </div>
                                      <div v-else>
                                        <a
                                          v-if="lesson.student_status == 1"
                                          class="dropdown-item disabled"
                                          >เริ่มเรียน</a
                                        >
                                        <a
                                          v-else
                                          class="dropdown-item disabled"
                                          href="#"
                                          >รอการยืนยัน</a
                                        >
                                      </div>
                                    </li>
                                    <li>
                                      <a class="dropdown-item"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'lessons_id',
                                            params: { id: lesson.id },
                                          }"
                                          >ดูหลักสูตร</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a
                                        v-if="lesson.count_progress == 100"
                                        class="dropdown-item"
                                        @click="
                                          downloadCerticate(
                                            lesson.subjectName,
                                            lesson.id
                                          )
                                        "
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                      <a
                                        v-else
                                        class="dropdown-item disabled"
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                      <a
                                        class="dropdown-item"
                                        style="cursor: pointer"
                                        @click="
                                          destroy_subject(lesson.class_id)
                                        "
                                        >ยกเลิกหลักสูตร</a
                                      >
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div
                        v-for="lesson in filteredSheeps2"
                        :key="lesson.id"
                        v-show="lesson.count_progress == 100"
                      >
                        <div class="card p-3 my-3">
                          <div class="mb-0 p-3 text-left">
                            <i class="fa fa-leanpub" aria-hidden="true"></i>
                            <span class="text-danger"
                              ><b>แบบไม่ประสานเวลา</b></span
                            >
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <span
                                ><img
                                  width="100px"
                                  height="100px"
                                  class="border border-dark rounded ml-3"
                                  :src="lesson.image"
                                  alt=""
                              /></span>
                            </div>
                            <div class="col-md-6">
                              <p>
                                รหัสวิชา:
                                <b
                                  ><u>{{ lesson.subjectId }}</u></b
                                >
                              </p>
                              <p>ชื่อวิชา: {{ lesson.subjectName }}</p>
                            </div>
                            <div class="col-md">
                              <div class="p-2 text-right">
                                <div class="dropright">
                                  <a
                                    id="dropdownMenuButton"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="btn btn-primary"
                                    ><i class="fa fa-cog" aria-hidden="true"></i
                                  ></a>
                                  <ul
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton"
                                  >
                                    <li>
                                      <a class="dropdown-item"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'preface2',
                                            params: { id: lesson.id },
                                          }"
                                          >เริ่มเรียน</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a class="dropdown-item"
                                        ><router-link
                                          style="
                                            text-decoration: none;
                                            color: black;
                                          "
                                          @click.native="moveUp()"
                                          :to="{
                                            name: 'lessons_id',
                                            params: { id: lesson.id },
                                          }"
                                          >ดูหลักสูตร</router-link
                                        ></a
                                      >
                                    </li>
                                    <li>
                                      <a
                                        v-if="lesson.count_progress == 100"
                                        class="dropdown-item"
                                        @click="
                                          downloadCerticate(
                                            lesson.subjectName,
                                            lesson.id
                                          )
                                        "
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                      <a
                                        v-else
                                        class="dropdown-item disabled"
                                        href="#"
                                        >ใบประกาศ(PDF)</a
                                      >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                      <a
                                        class="dropdown-item"
                                        style="cursor: pointer"
                                        @click="
                                          destroy_subject(lesson.class_id)
                                        "
                                        >ยกเลิกหลักสูตร</a
                                      >
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                id="data3"
                class="
                  table-responsive table-invoice
                  tab-pane
                  fade
                  table-wrapper-scroll-y
                  my-custom-scrollbar
                "
              >
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">รหัสวิชา</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">คะแนน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(n, index) in scorePretest" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ n.subjectId }}</td>
                      <td>{{ n.subjectName }}</td>
                      <td>{{ n.score }}/{{ n.scoreAll }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div
                id="data4"
                class="
                  table-responsive table-invoice
                  tab-pane
                  fade
                  table-wrapper-scroll-y
                  my-custom-scrollbar
                "
              >
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">รหัสวิชา</th>
                      <th scope="col">ชื่อวิชา</th>
                      <th scope="col">คะแนน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(n, index) in scorePosttest" :key="index">
                      <th scope="row">{{ index + 1 }}</th>
                      <td>{{ n.subjectId }}</td>
                      <td>{{ n.subjectName }}</td>
                      <td>{{ n.score }}/{{ n.scoreAll }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- when have not data. -->
        <div class="mb-4" v-else>
          <div class="row">
            <div class="col-md-3">
              <div class="input-group">
                <div class="form-outline">
                  <input
                    id="form1"
                    type="search"
                    v-model="search"
                    placeholder="Search"
                    class="form-control"
                  />
                </div>
                <button type="button" class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card">
                <div>
                  <div class="p-3 mb-2">
                    <div class="mb-0 p-3 text-left text-center">
                      <i class="fa fa-leanpub" aria-hidden="true"></i>
                      <span class="text-danger"><b>เลือกคอร์สเรียน</b></span
                      ><br /><br />
                      <a href="/learning/course" class="btn btn-primary"
                        >Find!!</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <a
        class="btn btn-info my-5"
        type="button"
        @click="$router.go(-1)"
        style="text-decoration: none; color: white; float: right"
        ><i class="fas fa-chevron-left"></i> กลับ
      </a>
    </div>

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script src="https://unpkg.com/vue@2.4.2"></script>
<script scoped>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "dashboard",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      my_subject_leassons: [],
      my_subject_leassons_left: [],
      curreentTime: "",
      search: "",
      scorePretest: [],
      scorePosttest: [],
    };
  },
  mounted() {
    if (this.$store.state.token !== "") {
      this.my_subject_leasson();
      this.dataScore();
      setTimeout(() => {
        this.my_subject_leasson_left();
      }, 500);
    } else {
      this.loading = false;
      this.$router.push("/learning/login");
    }
    this.curreentTime = this.currentDateTime();
  },
  computed: {
    filteredSheeps: function () {
      let searchTerm = (this.search || "").toLowerCase();
      return this.my_subject_leassons.filter(function (item) {
        let name = (item.subjectName || "").toLowerCase();
        let nameID = (item.subjectId || "").toLowerCase();
        return name.indexOf(searchTerm) > -1 || nameID.indexOf(searchTerm) > -1;
      });
    },
    filteredSheeps2: function () {
      let searchTerm = (this.search || "").toLowerCase();
      return this.my_subject_leassons_left.filter(function (item) {
        let name = (item.subjectName || "").toLowerCase();
        let nameID = (item.subjectId || "").toLowerCase();
        return name.indexOf(searchTerm) > -1 || nameID.indexOf(searchTerm) > -1;
      });
    },
  },
  //   created() {
  //     filteredSheeps(() => (this.my_subject_leassons = my_subject_leassons), 500);
  //     filteredSheeps2(
  //       () => (this.my_subject_leassons_left = my_subject_leassons_left),
  //       500
  //     );
  //   },
  methods: {
    currentDateTime() {
      const current = new Date();
      const date =
        current.getFullYear() +
        "-" +
        +(current.getMonth() + 1) +
        "-" +
        (current.getDate() < 10 ? "0" : "") +
        current.getDate();
      const time =
        (current.getHours() < 10 ? "0" : "") +
        current.getHours() +
        ":" +
        (current.getMinutes() < 10 ? "0" : "") +
        current.getMinutes() +
        ":" +
        (current.getSeconds() < 10 ? "0" : "") +
        current.getSeconds();
      const dateTime = date + "T" + time;

      return dateTime;
    },
    dataScore() {
      axios.get("/api/scorePre/" + this.$store.state.user_id).then((res) => {
        // console.log(res.data);
        this.scorePretest = res.data;
      });
      axios.get("/api/scorePost/" + this.$store.state.user_id).then((res) => {
        // console.log(res.data);
        this.scorePosttest = res.data;
      });
    },
    my_subject_leasson() {
      axios
        .get("/api/my_subject_leasson/" + this.$store.state.user_id)
        .then((res) => {
          this.data = [];
          for (let index = 0; index < res.data.length; index++) {
            this.data[index] = {
              id: res.data[index].id,
              subjectName: res.data[index].subjectName,
              image: res.data[index].image,
              subjectType: res.data[index].subjectType,
              subjectId: res.data[index].subjectId,
              student_status: res.data[index].student_status,
              class_id: res.data[index].class_id,
              count_progress: res.data[index].count_progress,
              attendClass: 0,
            };
          }
          this.my_subject_leassons = this.data;
          for (let index = 0; index < res.data.length; index++) {
            if (res.data[index].student_status == 1) {
              axios
                .get("/api/showdata_time/" + this.$store.state.user_id)
                .then((res) => {
                  for (let i = 0; i < res.data.length; i++) {
                    if (
                      this.curreentTime >= res.data[i].start &&
                      this.curreentTime <= res.data[i].end
                    ) {
                      if (this.data[index].subjectName == res.data[i].title) {
                        this.data[index].attendClass++;
                      }
                    }
                  }
                  this.loading = false;
                })
                .catch((err) => {
                  this.error = "Error!!";
                });
            }
          }
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    my_subject_leasson_left() {
      axios
        .get("/api/my_subject_leasson_left/" + this.$store.state.user_id)
        .then((res) => {
          this.my_subject_leassons_left = res.data;
          this.loading = false;
          //   console.log(this.my_subject_leassons_left);
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    destroy_subject(class_id) {
      axios
        .get("/api/destroy_subject/" + class_id)
        .then((res) => {
          this.$router.go();
        })
        .catch((err) => {
          this.error = "Error!!";
        });
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
        fullUri.setAttribute("download", "file/" + value + ".pdf");
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

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}

#content {
  margin-top: -2%;
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
.dropdown-menu {
  margin-left: 5px;
  margin-top: -55px;
}
</style>
