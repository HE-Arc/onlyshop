<!--
OnlyShop made by Lucas Perrin, Rui Marco Loureiro and Miguel Moreira
File's version : 1.1.0
this file is used for : show the register page

Wrote by : Lucas Perrin
updated by : Lucas Perrin
-->

<script setup>
import { ref } from "vue";

const user = ref({
    firstname: "",
    lastname: "",
    email: "",
    password: "",
    c_password: "",
});

let form = ref(false);
let isLoading = ref(false);

let rules = {
    length: (v) => (v || "").length >= 3 || "Doit avoir au moins 3 caractères",
    email: (v) =>
        !!(v || "").match(/@/) || "Merci d'entrer une adresse email valide",
    password: (v) =>
        !!(v || "").match(
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/
        ) ||
        "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial",
    required: (v) => !!v || "Ce champ est requis",
    c_password: (v) =>
        v === user.value.password || "Les mots de passe ne correspondent pas",
};

let changePasswordFieldType = (id) => {
    let passwordField = document.getElementById(id);
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
};
</script>

<template>
    <v-container>
        <v-form v-model="form">
            <v-text-field
                v-model="user.firstname"
                :rules="[rules.length]"
                variant="filled"
                color="deep-purple"
                label="Prénom"
                name="firstname"
                type="text"
            ></v-text-field>

            <v-text-field
                v-model="user.lastname"
                :rules="[rules.length]"
                variant="filled"
                color="deep-purple"
                label="Nom"
                name="lastname"
                type="text"
            ></v-text-field>

            <v-text-field
                prepend-icon="mdi-at"
                v-model="user.email"
                :rules="[rules.email]"
                variant="filled"
                color="deep-purple"
                label="Adresse email"
                name="email"
                type="email"
            ></v-text-field>

            <v-text-field
                prepend-icon="mdi-lock-outline"
                v-model="user.password"
                :rules="[rules.password]"
                variant="filled"
                color="deep-purple"
                label="Mot de passe"
                name="password"
                id="password_register"
                :append-icon="user.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="
                    () => changePasswordFieldType('password_register')
                "
                type="password"
            ></v-text-field>

            <v-text-field
                prepend-icon="mdi-lock-outline"
                v-model="user.c_password"
                :rules="[rules.c_password]"
                variant="filled"
                color="deep-purple"
                label="Confirmer le mot de passe"
                name="c_password"
                id="c_password"
                :append-icon="user.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="() => changePasswordFieldType('c_password')"
                type="password"
            ></v-text-field>
        </v-form>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                :disabled="!form"
                :loading="isLoading"
                color="primary"
                @click="$emit('register', user)"
            >
                S'inscrire
            </v-btn>
        </v-card-actions>
    </v-container>
</template>
