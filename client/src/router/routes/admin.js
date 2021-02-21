export default [
  {
    path: "/admin/routers",
    name: "admin-routers",
    meta: {
      requiresAuth: true,
    },
    component: () =>
      import(
        /* webpackChunkName: "admin-routers" */ "@/components/AdminRouters.vue"
      ),
  },
];
