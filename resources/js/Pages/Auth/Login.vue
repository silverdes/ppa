<template>
   
<div class="flex mx-52 bg-white shadow-md overflow-hidden sm:rounded-lg px-10 py-10">
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>
    <div class="w-1/2">
        <img src="https://uploads-ssl.webflow.com/5c8607099eacd1746f6743c0/5d6be775a3a53e0896ff5931_Teamwork.svg" alt="">
    </div>
    <div class="w-1/2 mx-10 items-center my-auto">
        <form @submit.prevent="submit">
            <div>
                <breeze-label for="email" value="Email" />
                <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autofocus autocomplete="username" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.email }}
                </span>
            </div>

            <div class="mt-4">
                <breeze-label for="password" value="Password" />
                <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" autocomplete="current-password" />
                <span class="text-sm text-red-500 font-medium">
                     {{ $attrs.errors.password }}
                </span>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <breeze-checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </inertia-link>

                <breeze-button class="ml-4 bg-green-400 hover:bg-green-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </breeze-button>
            </div>
        </form>
    </div>
</div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from "@/Layouts/Guest"
    import BreezeInput from '@/Components/Input'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        layout: BreezeGuestLayout,
        components: {
            BreezeButton,
            BreezeInput,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
            }
        }
    }
</script>
