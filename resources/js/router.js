import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/",
            name: "home",
            component: () => import("./pages/contents/Content.vue")
        },
        {
            path: "/learning/dashboard",
            name: "dashboard",
            component: () => import("./pages/user/Dashboard.vue")
        },
        {
            path: "/learning/login",
            name: "login",
            component: () => import("./pages/contents/Login.vue")
        },
        {
            path: "/learning/register",
            name: "register",
            component: () => import("./pages/contents/Register.vue")
        },
        {
            path: "/learning/teacher",
            name: "teacher",
            component: () => import("./pages/contents/Teacher.vue")
        },
        {
            path: "/learning/teacher/:id",
            name: "teacher_id",
            component: () => import("./pages/contents/Teacher_id.vue")
        },
        {
            path: "/learning/contact",
            name: "contact",
            component: () => import("./pages/contents/Contact.vue")
        },
        {
            path: "/learning/news",
            name: "news",
            component: () => import("./pages/contents/News.vue")
        },
        {
            path: "/learning/news/:id",
            name: "news_id",
            component: () => import("./pages/contents/News_id.vue")
        },
        {
            path: "/learning/course",
            name: "course",
            component: () => import("./pages/contents/Course.vue")
        },
        {
            path: "/learning/course/:id",
            name: "course_id",
            component: () => import("./pages/contents/Course_id.vue")
        },
        {
            path: "/learning/calendar_simulations",
            name: "calendar_simulations",
            component: () => import("./pages/contents/CalendarSimulations.vue")
        },
        {
            path: "/learning/preface2/:id",
            name: "preface2",
            component: () => import("./pages/contents/Preface2.vue")
        },
        {
            path: "/learning/chat",
            name: "chat",
            component: () => import("./pages/contents/chat_room.vue")
        },
        {
            path: "/learning/lesson/:id",
            name: "lesson",
            component: () => import("./pages/contents/Lesson.vue")
        },
        {
            path: "/learning/pretest/:id",
            name: "pretest",
            component: () => import("./pages/contents/Pretest.vue")
        },
        {
            path: "/learning/posttest/:id",
            name: "posttest",
            component: () => import("./pages/contents/Posttest.vue")
        },
        {
            path: "/learning/dashboard/lessons",
            name: "lessons",
            component: () => import("./pages/user/Lessons.vue")
        },
        {
            path: "/learning/dashboard/lessons/:id",
            name: "lessons_id",
            component: () => import("./pages/user/Lesson_id.vue")
        },
        {
            path: "/learning/dashboard/profiles",
            name: "profiles",
            component: () => import("./pages/user/Profiles.vue")
        },
        {
            path: "/learning/dashboard/timetables",
            name: "timetables",
            component: () => import("./pages/user/Timetables.vue")
        },
        {
            path: "/lessonupdate",
            name: "lessonupdate",
            component: () => import("./pages/contents/LessonUpdate.vue")
        },
        {
            path: "/content_categorie/:id",
            name: "content_categorie",
            component: () => import("./pages/contents/Content_categorie.vue")
        },
        {
            path: "*",
            name: "error",
            component: () => import("./pages/errors/404.vue")
        }
    ]
});

export default router;
