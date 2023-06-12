import { createRouter, createWebHistory } from "vue-router";
import NotFoundView from "../views/NotFoundView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
      meta: { showBackButton: false }
    },
    {
      path: "/callback",
      name: "callback",
      component: () => import("../views/CallbackView.vue"),
      meta: { showBackButton: false }
    },
    {
      path: "/",
      name: "home",
      component: () => import("../views/HomeView.vue"),
      meta: { requiresAuth: true, showBackButton: false }, // add meta field to specify the route requires authentication
    },
    {
      path: "/test",
      name: "test",
      component: () => import("../views/TestView.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/account",
      name: "account",
      component: () => import("../components/Account.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/history",
      name: "history",
      component: () => import("../components/History.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/historyTransfer",
      name: "historyTransfer",
      component: () => import("../components/HistoryTransfer.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/service",
      name: "service",
      component: () => import("../components/Service.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/payService",
      name: "payService",
      component: () => import("../components/PayService.vue"),
      meta: { requiresAuth: true, showBackButton: true }, // add meta field to specify the route requires authentication
    },
    {
      path: "/:pathMatch(.*)*",
      name: "NotFound",
      component: NotFoundView,
    },
  ],
});

// add a global beforeEnter guard to check if the route requires authentication and if the user has an access token
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !hasAccessToken()) {
    next("/login");
  } else {
    next();
  }
});

// helper function to check if the user has an access token
function hasAccessToken() {
  const token = localStorage.getItem("access_token");
  return token !== null && token !== undefined;
}

export default router;
