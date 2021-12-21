
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
      <div v-else id="app" class="container">
        <h2 class="mb-2" style="text-align: center">แบบทดสอบก่อนเรียน</h2>
        <div class="card p-3">
          <form class="demo-form" enctype="multipart/form-data">
            <div
              v-for="(n, index) in questions"
              :key="index"
              v-show="idx == index"
              class="form-section py-3 text-center"
            >
              <div class="py-2">
                <h4>ข้อที่ {{ index + 1 }}</h4>
                <h5
                  v-html="n.question"
                  class="card bg-white"
                  style="padding-top: 15px"
                ></h5>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label
                    class="
                      form-label
                      bg-white
                      border border-secondary
                      p-2
                      font-weight-light
                    "
                    style="border-radius: 5px; display: flex"
                  >
                    <input
                      @change="nextQuestion('a1', index)"
                      class="form-control-input mr-2"
                      :name="index"
                      type="radio"
                      required
                    />
                    1. <span v-html="n.answers.a1"></span>
                  </label>
                </div>
                <div class="col-md-6 mb-3">
                  <label
                    class="
                      form-label
                      bg-white
                      border border-secondary
                      p-2
                      font-weight-light
                    "
                    style="border-radius: 5px; display: flex"
                  >
                    <input
                      @change="nextQuestion('a2', index)"
                      class="form-control-input mr-2"
                      :name="index"
                      type="radio"
                      required
                    />
                    2. <span v-html="n.answers.a2"></span>
                  </label>
                </div>
                <div class="col-md-6 mb-3">
                  <label
                    class="
                      form-label
                      bg-white
                      border border-secondary
                      p-2
                      font-weight-light
                    "
                    style="border-radius: 5px; display: flex"
                  >
                    <input
                      @change="nextQuestion('a3', index)"
                      class="form-control-input mr-2"
                      :name="index"
                      type="radio"
                      required
                    />
                    3. <span v-html="n.answers.a3"></span>
                  </label>
                </div>
                <div class="col-md-6 mb-3">
                  <label
                    class="
                      form-label
                      bg-white
                      border border-secondary
                      p-2
                      font-weight-light
                    "
                    style="border-radius: 5px; display: flex"
                  >
                    <input
                      @change="nextQuestion('a4', index)"
                      class="form-control-input mr-2"
                      :name="index"
                      type="radio"
                      required
                    />
                    4. <span v-html="n.answers.a4"></span>
                  </label>
                </div>
              </div>

              <div class="mt-2">
                <a
                  href="#"
                  v-show="idx != 0"
                  type="button"
                  @click="idx--"
                  class="previous btn btn-primary pull-left"
                >
                  &lt; Previous
                </a>
                <a
                  href="#"
                  v-if="idx != count - 1"
                  type="button"
                  @click="idx++"
                  class="next btn btn-primary pull-right"
                >
                  Next &gt;
                </a>
                <a
                  v-else
                  href="#"
                  type="button"
                  @click="showResults()"
                  class="btn btn-success pull-right"
                >
                  Submit
                </a>
              </div>
            </div>
            <div v-if="idx == count">
              <div class="text-center">
                <h4
                  style="background: #ffd700; border-radius: 15px; width: 10%"
                  class="container mb-4"
                >
                  ผลลัพธ์
                </h4>
                <div>
                  <p>
                    คำตอบที่ถูกต้อง:
                    <span>{{ correctAnswers }}</span>
                  </p>
                  <p>
                    คำตอบที่ผิด:
                    <span>{{ wrongAnswers }}</span>
                  </p>
                </div>
                <div>
                  <button
                    @click="resetQuiz"
                    class="btn btn-primary float-middle"
                    bg-white
                    style="
                      box-shadow: rgba(9, 30, 66, 0.5) 0,
                        rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
                    "
                  >
                    <i class="fas fa-play"></i>
                    เข้าสู่บทเรียน
                  </button>
                </div>
              </div>
            </div>
          </form>
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

    <div id="footer">
      <FooterComponent />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import HeaderComponent from "../../components/HeaderComponent.vue";
import FooterComponent from "../../components/FooterComponent.vue";
export default {
  name: "lessons",
  components: { HeaderComponent, FooterComponent },
  data() {
    return {
      loading: true,
      idx: 0,
      correctAnswers: 0,
      wrongAnswers: 0,
      count: 0,
      questions: [
        {
          question: "",
          answers: { a1: "", a2: "", a3: "", a4: "" },
          correctAnswer: "",
          selectedAnswer: "",
        },
      ],
    };
  },
  mounted() {
    if (this.$store.state.token == "") {
      this.loading = false;
      this.$router.push("/learning/login");
    }

    this.dataQuiz();
  },
  methods: {
    checkRedirectPage() {
      axios
        .get(
          "/api/checkRedirectPage/" +
            this.$route.params.id +
            "/" +
            this.$store.state.user_id
        )
        .then((res) => {
          if (res.data != "") {
            this.$router.push({
              name: "lesson",
              params: { id: this.$route.params.id },
            });
          } else {
            this.loading = false;
          }
          //   this.loading = false;
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    dataQuiz() {
      axios
        .get("/api/pretest_quiz/" + this.$route.params.id)
        .then((res) => {
          this.questions = [];
          for (let i = 0; i < res.data.length; i++) {
            var answer = window.atob(res.data[i].answer);
            this.questions[i] = {
              question: res.data[i].question,
              correctAnswer: "a" + answer,
              answers: {
                a1: res.data[i].aq1,
                a2: res.data[i].aq2,
                a3: res.data[i].aq3,
                a4: res.data[i].aq4,
              },
              selectedAnswer: "",
            };
          }
          this.count = res.data.length;

          this.checkRedirectPage();
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    nextQuestion(aws, value) {
      if (aws != "a1") {
        (this.questions[value].selectedAnswer = ""),
          (this.questions[value].selectedAnswer = aws);
      } else if (aws != "a2") {
        (this.questions[value].selectedAnswer = ""),
          (this.questions[value].selectedAnswer = aws);
      } else if (aws != "a3") {
        (this.questions[value].selectedAnswer = ""),
          (this.questions[value].selectedAnswer = aws);
      } else if (aws != "a4") {
        (this.questions[value].selectedAnswer = ""),
          (this.questions[value].selectedAnswer = aws);
      }
    },
    showResults() {
      this.idx++;

      for (let i = 0; i < this.questions.length; i++) {
        if (
          this.questions[i].correctAnswer == this.questions[i].selectedAnswer
        ) {
          this.correctAnswers++;
        } else {
          this.wrongAnswers++;
        }
      }

      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let formData = new FormData();
      formData.append("subject_id", this.$route.params.id);
      formData.append("user_id", this.$store.state.user_id);
      formData.append("correctAnswers", this.correctAnswers);

      axios
        .post("/api/pretest_save", formData, config)
        .then((res) => {
          this.saveCountProgress();
        })
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    saveCountProgress() {
      const config = {
        headers: {
          "content-type": "multipart/form-data",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
      };

      let formData = new FormData();
      formData.append("subject_id", this.$route.params.id);
      formData.append("user_id", this.$store.state.user_id);

      axios
        .post("/api/redirect_save/pretest_progress", formData, config)
        .then((res) => {})
        .catch((err) => {
          this.error = "Error!!";
        });
    },
    resetQuiz() {
      this.$router.push({
        name: "lesson",
        params: { id: this.$route.params.id },
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
  margin-top: 8%;
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
.card {
  background-color: aliceblue;
}
.bg-click-return {
  --tw-bg-opacity: 1;
  background-color: rgba(72, 194, 100, var(--tw-bg-opacity));
}

@media (min-width: 640px) {
}

@media (min-width: 768px) {
}

@media (min-width: 1024px) {
}

@media (min-width: 1280px) {
}

@media (min-width: 1536px) {
}
</style>
