<template>
  <footer class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="footer-widget">
            <div class="educa-logo">
              <img
                src="/assets/frontend/images/logo-elearning2.png"
                width="170px"
                alt=""
              />
              <!-- <div class="line-dec"></div> -->
              <!-- <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Excepturi ullam eius necessitatibus neque. Qui neque a ratione
                molestiae dicta quaerat magni nisi enim, fugit itaque eum,
                pariatur expedita deserunt magnam!
              </p> -->
              <!-- <div class="text-button">
                <a href="#" style="text-decoration: none"
                  >Read More <i class="fa fa-arrow-right"></i
                ></a>
              </div> -->
              <!-- <div class="social mt-2 mb-3">
                <i class="fa fa-facebook-official fa-lg mr-1"></i>
                <i class="fa fa-instagram fa-lg mr-1"></i>
                <i class="fa fa-twitter fa-lg mr-1"></i>
                <i class="fa fa-linkedin-square fa-lg mr-1"></i>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widget">
            <div class="university-address">
              <h2>สถานที่ติดต่อ</h2>
              <div class="line-dec"></div>
              <ul>
                <li>
                  <i class="fas fa-home"></i>1569 อาคารภูฟ้าเพลส,
                  อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่ 50300
                </li>
                <li><i class="fas fa-phone"></i>086-322-3809 / 086-586-2599</li>
                <li>
                  <i class="fas fa-envelope"></i>jigsawinnovation@gmail.com
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widget">
            <div class="newsletters">
              <h2>ข่าว</h2>
              <div class="line-dec"></div>
              <p>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae
                placeat aspernatur ipsa corporis quidem quas saepe vel ratione,
                et ex possimus eligendi qui, perferendis consequuntur molestiae
                dolores distinctio sequi quasi.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footer-widget">
            <div class="featured-links">
              <h2>โซเชียลมีเดีย</h2>
              <div class="line-dec"></div>
              <div class="social mt-2 mb-3">
                <a href="#"
                  ><i class="fa fa-facebook-official fa-lg mr-1"></i
                ></a>
                <a href="#"><i class="fa fa-instagram fa-lg mr-1"></i></a>
                <a href="#"><i class="fa fa-twitter fa-lg mr-1"></i></a>
                <a href="#"><i class="fa fa-linkedin-square fa-lg mr-1"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="copyright-menu">
            <div class="row">
              <div class="col-sm-4">
                <div class="copyright-text">
                  <p>
                    @ Copyright {{ new Date().getFullYear() }} E-Learning,
                    website.
                  </p>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="menu">
                  <ul>
                    <li>
                      <a href="/" class="btn btn-info text-white">หน้าหลัก</a>
                    </li>
                    <li>
                      <a href="/learning/course" class="btn btn-info text-white"
                        >คอร์สเรียน</a
                      >
                    </li>
                    <li>
                      <a href="/learning/news" class="btn btn-info text-white"
                        >ข่าวสาร</a
                      >
                    </li>
                    <li>
                      <a
                        href="/learning/teacher"
                        class="btn btn-info text-white"
                        >อาจารย์ผู้สอน</a
                      >
                    </li>
                    <li>
                      <a
                        href="/learning/contact"
                        class="btn btn-info text-white"
                        >ติดต่อ</a
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
  </footer>
</template>

<script>
export default {
  name: "footercomponent",
  props: {
    msg: String,
  },
};
</script>

<style scoped>
/* ##### >> https://fonts.google.com/specimen/Sarabun?query=sara#standard-styles */
@import url("https://fonts.googleapis.com/css2?family=Sarabun:wght@300&display=swap");
#content {
  margin-top: 9%;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Sarabun", sans-serif;
}

/*
========================
      BUTTON
========================
*/
.btn-footer {
  color: #fff;
  background: #a12c2f;
}
.btn-footer:hover {
  background: #d43a3f;
}
.social a {
  color: #333;
  padding: 5px;
  transition: 0.3s;
}
.social a:hover {
  color: #f5a425;
}
.social a:nth-child(1) {
  padding-left: 0;
}
</style>
