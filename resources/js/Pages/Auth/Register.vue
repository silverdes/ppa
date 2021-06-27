<template>

    <inertia-link :href="route('welcome')">
        <application-logo class="mx-auto justify-center h-12 w-auto mb-10" />
    </inertia-link>
<div class="flex mx-40 bg-white shadow-md overflow-hidden sm:rounded-lg px-10 py-10">

    <div class="w-1/2">
        <img src="https://uploads-ssl.webflow.com/5c8607099eacd1746f6743c0/5d6be775a3a53e0896ff5931_Teamwork.svg" class="object-fill h-full w-full" alt="">
    </div>
    <div class="w-1/2 mx-10">
        <form @submit.prevent="submit">
            <div>
                <breeze-label for="name" value="Name" />
                <breeze-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.name }}
                </span>
            </div>

            <div class="mt-4">
                <breeze-label for="email" value="Email" />
                <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autocomplete="username" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.email }}
                </span>
            </div>

            <div class="mt-4">
                <breeze-label for="password" value="Password" />
                <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="new-password" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.password }}
                </span>
            </div>

            <div class="mt-4">
                <breeze-label for="password_confirmation" value="Confirm Password" />
                <breeze-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" autocomplete="new-password" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.password_confirmation }}
                </span>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </inertia-link>

                <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </breeze-button>
            </div>
        </form>
    </div>
</div>

</template>

<script>
    import ApplicationLogo from '@/Components/ApplicationLogo'
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from '@/Layouts/Guest'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'


    export default {
        layout: BreezeGuestLayout,
        components: {
            ApplicationLogo,
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
