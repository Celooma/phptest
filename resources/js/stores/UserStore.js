import { defineStore } from 'pinia'

export const userInfoStore = defineStore('userInfo', {
    state: () => ({ userData: {},  id: 0, isAdmin: false, name: 'bb' }),
    getters: {
      userInfo: (state) => state.isAdmin,
    },
    actions: {
      update() {
         this.isAdmin =  true;
      },
    },
  })
