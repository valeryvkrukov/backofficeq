<template>
  <q-layout view="hHh lpR fFf">

    <q-header reveal elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="left = !left" />

        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          Title
        </q-toolbar-title>
        <q-btn stretch flat label="Logout" @click.prevent="logout" />
      </q-toolbar>
    </q-header>

    <q-drawer v-model="left" side="left" overlay elevated>
      <!-- drawer content -->
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer reveal elevated class="bg-grey-8 text-white">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg">
          </q-avatar>
          SSASoft - Backoffice
        </q-toolbar-title>
      </q-toolbar>
    </q-footer>

  </q-layout>
</template>

<script>
export default {
  data () {
    return {
      left: true
    }
  },
  beforeMount () {
    this.$store.dispatch('dashboardLoad').then((resp) => {
      if (resp.status === 401) {
        this.$router.push('/login')
      }
    }).catch((err) => {
      console.log(err)
      this.$router.push('/login')
    })
  },
  methods: {
    logout () {
      this.$store.dispatch('logout').then(() => { this.$router.push('/login') })
    }
  }
}
</script>
