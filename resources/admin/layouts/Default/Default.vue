<template>
    <v-app color="#ecf0f5">
        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            color="#222d32"
        >
            <v-list dense dark>
                <v-list-item :to="{name: 'home'}" exact active-class="default-active-link">
                    <v-list-item-action>
                        <v-icon small>fa-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Головна</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
              <v-list-item :to="{name: 'sliders'}" active-class="default-active-link">
                <v-list-item-action>
                  <v-icon small>fa-sliders-h</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Слайдери</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
                <v-list-item :to="{name: 'settings'}" active-class="default-active-link">
                    <v-list-item-action>
                        <v-icon small>fa-cog</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Налаштування</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app clipped-left color="#1b2327">
            <v-icon 
                @click.stop="drawer = !drawer" 
                class="mr-3" 
                color="white">fa-bars</v-icon>
            <v-toolbar-title  style="color: white;">WMPanel</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                small
                href="/wmpanel/logout/"
                >
                Вийти
                <v-icon right small>fas fa-sign-out-alt</v-icon>
            </v-btn>
        </v-app-bar>

        <v-content class="container-content">
            <v-container fluid>
                <v-row>
                    <v-col cols="12" lg="12" class="shrink">
                        <transition name="fade" mode="out-in" appear>
                            <router-view></router-view>
                        </transition>
                    </v-col>
                </v-row>
            </v-container>

            <v-snackbar
                :top="true"
                :timeout="showMessage.timeout"
                v-model="showMessage.show"
                :color="showMessage.type"
                >
                {{ showMessage.text }}
                <v-btn
                    dark
                    text
                    @click="fadeSnakbar"
                >
                    Закрити
                </v-btn>
            </v-snackbar>
        </v-content>

        <!-- Developers: Zhenya - Back-end, Sasha - Front-end -->

        <v-footer app>
            <span>&copy; 2020, WebMaestro, v 0.8.0</span>
        </v-footer>
    </v-app>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default {
    props: {
        source: String,
    },
    data: () => ({
        drawer: null,
    }),
    computed: {
        ...mapGetters(['showMessage']),
    }, 
    methods: {
        ...mapMutations([
            'setOptionShowMessage'
        ]),
        fadeSnakbar() {
            this.setOptionShowMessage({show: false});
        }
    }
}
</script>

<style lang="scss">
.default-active-link {
    &:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background-color: #3c8dbc;
    }
}
.container-content {
    background-color: #ecf0f5;
}

.fade-enter-active, .fade-leave-active {
  transition: all 0.3s;
}

.fade-enter, .fade-leave-active {
  transform: translateX(-100%);
  opacity: 0;
}
</style>
