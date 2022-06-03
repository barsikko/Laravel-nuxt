<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <NuxtLink to="/" class="navbar-brand">
        {{ appName }}
      </NuxtLink>

      <ul class="navbar-nav ml-auto">
        <!-- Authenticated -->
        <li v-if="user" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark"
             href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
          >
            <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
            {{ user.name }}
          </a>
          <div class="dropdown-menu">
            <NuxtLink to="/settings/profile" class="dropdown-item pl-3">
              <fa icon="cog" fixed-width />
              {{ $t('settings') }}
            </NuxtLink>

            <div class="dropdown-divider" />
            <a class="dropdown-item pl-3" href="#" @click.prevent="logout">
              <fa icon="sign-out-alt" fixed-width />
              {{ $t('logout') }}
            </a>
          </div>
        </li>
        <!-- Guest -->
        <template v-else>
          <li class="nav-item">
            <NuxtLink to="/auth/login" class="nav-link" active-class="active">
              {{ $t('login') }}
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/auth/register" class="nav-link" active-class="active">
              {{ $t('register') }}
            </NuxtLink>
          </li>
        </template>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  data: () => ({
    appName: process.env.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to home page.
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
