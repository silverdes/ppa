<template>
<div class="mx-20 items-top dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="grid gap-6 grid-cols-3" >
              <div class="bg-white shadow-xl rounded-b-lg w-full" v-for="property in userProperties.data" :key="property.id">
                    <div class="bg-cover bg-center h-56 p-4 rounded-t-lg mb-10">
                    <img :src="property.image" class="object-cover" alt="">
                        <div class="flex justify-end">
                            <svg class="h-6 w-6 text-white fill-current z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-sm font-bold text-gray-700">{{property.title}}</p>
                        <p> <i class="icofont-clock-time"></i> {{property.created_at}}</p>
                        <p class="text-3xl text-gray-900">${{property.price}}</p>
                        <p class="text-gray-700">{{property.address}}</p>
                    </div>
                    <div class="flex p-4 border-t border-gray-300 text-gray-700">
                        <div class="flex-1 inline-flex items-center">
                            <svg class="h-5 w-5 text-gray-600 fill-current mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M0 16L3 5V1a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v4l3 11v5a1 1 0 0 1-1 1v2h-1v-2H2v2H1v-2a1 1 0 0 1-1-1v-5zM19 5h1V1H4v4h1V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h2V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1zm0 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V6h-2v2a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V6H3.76L1.04 16h21.92L20.24 6H19zM1 17v4h22v-4H1zM6 4v4h4V4H6zm8 0v4h4V4h-4z"></path>
                            </svg>
                            <p><span class="text-gray-900 font-bold text-sm">{{property.bedrooms}}</span> Bedrooms</p>
                        </div>
                        <div class="flex-1 inline-flex items-center">
                            <svg class="h-5 w-5 text-gray-600 fill-current mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M17.03 21H7.97a4 4 0 0 1-1.3-.22l-1.22 2.44-.9-.44 1.22-2.44a4 4 0 0 1-1.38-1.55L.5 11h7.56a4 4 0 0 1 1.78.42l2.32 1.16a4 4 0 0 0 1.78.42h9.56l-2.9 5.79a4 4 0 0 1-1.37 1.55l1.22 2.44-.9.44-1.22-2.44a4 4 0 0 1-1.3.22zM21 11h2.5a.5.5 0 1 1 0 1h-9.06a4.5 4.5 0 0 1-2-.48l-2.32-1.15A3.5 3.5 0 0 0 8.56 10H.5a.5.5 0 0 1 0-1h8.06c.7 0 1.38.16 2 .48l2.32 1.15a3.5 3.5 0 0 0 1.56.37H20V2a1 1 0 0 0-1.74-.67c.64.97.53 2.29-.32 3.14l-.35.36-3.54-3.54.35-.35a2.5 2.5 0 0 1 3.15-.32A2 2 0 0 1 21 2v9zm-5.48-9.65l2 2a1.5 1.5 0 0 0-2-2zm-10.23 17A3 3 0 0 0 7.97 20h9.06a3 3 0 0 0 2.68-1.66L21.88 14h-7.94a5 5 0 0 1-2.23-.53L9.4 12.32A3 3 0 0 0 8.06 12H2.12l3.17 6.34z"></path>
                            </svg>
                            <p><span class="text-gray-900 font-bold text-sm">{{property.bathrooms}}</span> Bathrooms</p>
                        </div>
                    </div>
                </div>
        </div>
</div>

</template>

<style scoped>
</style>

<script>
    import Guest from '@/Layouts/Guest'
    import {debounce} from 'lodash/function'
    export default {
        layout:Guest,
        props: {
            properties: Object,
            canLogin:Object,
        },
        data(){
            return{
                userProperties: this.properties
            }
        },
        components:{
        },
        mounted(){
            window.addEventListener('scroll', debounce((e) => {
                let pixelsFromBottom = window.innerHeight + window.scrollY - document.documentElement.offsetHeight;
                console.log(pixelsFromBottom)
                if(pixelsFromBottom > 400) {

                    axios.get(this.userProperties.next_page_url).then(response => {
                        this.userProperties = {
                            ...response.data,
                            data: [...this.userProperties.data, ...response.data.data]
                        }
                    }),
                    console.log(pixelsFromBottom);
                 }if(pixelsFromBottom == 0){
                     console.log(this.userProperties)
                 }
            },100));
        }
    }
</script>
