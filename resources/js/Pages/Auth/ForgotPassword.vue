<template>
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <inertia-link :href="route('welcome')">
        <application-logo class="mx-auto justify-center h-12 w-auto mb-10" />
    </inertia-link>
<div class="flex mx-52 bg-white shadow-md overflow-hidden sm:rounded-lg px-10 py-10">

    <div class="w-1/2">
        <img src="https://addyfi.com/_nuxt/fb8d64ef6f900fea497df231d3b3f7d3.svg" alt="">
    </div>
    <div class="w-1/2 mx-10 items-center my-auto">
                <div class="mb-4 mx-auto text-center text-sm text-gray-600">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
        <form @submit.prevent="submit">
            <div>
                <breeze-label for="email" value="Email" />
                <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"  autocomplete="username" />
                <span class="text-sm text-red-500 font-medium ml-1">
                     {{ $attrs.errors.email }}
                </span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <breeze-button class="bg-blue-600 hover:bg-blue-700" :class="{ 'opacity-75': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </breeze-button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
    import ApplicationLogo from '@/Components/ApplicationLogo'
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from "@/Layouts/Guest"
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            ApplicationLogo,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        props: {
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
