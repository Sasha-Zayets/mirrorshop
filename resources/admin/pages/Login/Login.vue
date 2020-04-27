<template>
     <v-card class="elevation-12">
        <v-toolbar
            color="primary"
            dark
            flat
        >
            <v-toolbar-title>Login form</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
            <v-text-field
                label="Login"
                name="login"
                prepend-icon="person"
                type="text"
            />

            <v-text-field
                id="password"
                label="Password"
                name="password"
                prepend-icon="lock"
                type="password"
            />
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer />
            <v-btn color="primary">Login</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
}
</script>