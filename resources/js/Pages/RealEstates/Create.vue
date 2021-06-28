<template>
   <div class="relative min-h-screen flex items-center justify-center bg-center sm:px-6 lg:px-8 bg-no-repeat bg-cover items-center">
	    <div class="max-w-lg w-full space-y-8 py-5 px-10 bg-white rounded-xl shadow-lg z-10">
                <div class="grid gap-8 grid-cols-1">
	                <div class="flex flex-col ">
                        <div class="flex flex-col sm:flex-row items-center">
                            <h2 class="font-semibold text-lg mr-auto">Property Info</h2>
                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
                        </div>
			            <div class="mt-5">
				            <div class="form">
                                <div v-if="media.length" class="grid gap-2" :class="{'grid-cols-2': media.length > 1}">
                                    <div v-for="(item, index) in media" :key="index" class="relative flex items-center justify-center">
                                        <button type="button" @click="removeMedia(index)" class="absolute text-white rounded-full px-1 top-0 left-0 bg-black bg-opacity-75 hover:bg-opacity-100">
                                            <i class="icofont-close"></i>
                                        </button>
                                        <img :src="item.url" alt="" class="rounded-xl h-48 object-cover w-full">
                                        <div class="absolute bg-gray-400 text-white font-medium px-2 rounded" v-if="item.isLoading">Loading ....</div>
                                    </div>
                                </div>
					       <upload @input="uploadMedia"></upload>
						<div class="md:flex flex-row md:space-x-4 w-full text-sm">
							<div class="mb-3 space-y-2 w-full text-sm">
								<label class="font-semibold text-gray-600 py-2"> Title <abbr title="required">*</abbr></label>
								<input v-model="form.title" placeholder="Attract Attention with title" class="appearance-none block w-full  text-gray-700 border border-gray-200 rounded-lg h-10 px-4 focus:border-green-400 focus:ring-0" required="required" type="text" name="title" id="title">
								<p class="text-red text-xs hidden">Please fill out this field.</p>
							</div>
						</div>
						<div class="mb-3 space-y-2 w-full text-sm">
							<label class=" font-semibold text-gray-600 py-2">Property Address</label>
							<div class="flex flex-wrap items-stretch w-full mb-4 relative">
								<div class="flex">
									<span class="flex items-center leading-normal bg-gray-lighter border-1 rounded-r-none border border-r-0 border-green-400 px-3 whitespace-no-wrap text-gray-500 text-sm w-12 h-10 bg-green-400 justify-center items-center  text-xl rounded-lg text-white">
                                        <i class="icofont-location-pin text-white"></i>
                                   </span>
								</div>
								<input v-model="form.address" type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border border-l-0 h-10 border-gray-200 rounded-lg rounded-l-none px-3 relative focus:ring-0 focus:border-green-400" placeholder="Ex: Workshire 34 ...">
                            </div>
					    </div>
						<div class="md:flex md:flex-row md:space-x-4 w-full text-sm">
                            <div class="w-full flex flex-col mb-3">
                                <label class="font-semibold text-gray-600 py-2">Bedrooms<abbr title="required">*</abbr></label>
                                <select v-model="form.bedrooms" class="block w-full  text-gray-600 border border-gray-200 rounded-lg h-10 px-4 md:w-full focus:border-green-400 focus:ring-0" required="required" name="bedrooms" id="bedrooms">
                                <option value="">How Many bedrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3+</option>
                                </select>
                                <p class="text-sm text-red-500 hidden mt-3" id="error">Please fill out this field.</p>
                            </div>
                            <div class="w-full flex flex-col mb-3">
                                <label class="font-semibold text-gray-600 py-2">Bathrooms<abbr title="required">*</abbr></label>
                                <select v-model="form.bathrooms" class="block w-full  text-gray-600 border border-gray-200 rounded-lg h-10 px-4 md:w-full focus:border-green-400 focus:ring-0 " required="required" name="bathrooms" id="bathrooms">
                                <option value="">How Many bathrooms</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3+</option>
                                </select>
                                <p class="text-sm text-red-500 hidden mt-3" id="error">Please fill out this field.</p>
                            </div>
								</div>
                                <div class="w-full flex flex-col mb-3">
									<label class="font-semibold text-gray-600 py-2 text-sm">Price </label>
									<input v-model="form.price" placeholder="Price" class="appearance-none block w-full  text-gray-600 border border-gray-300 rounded-lg h-10 px-4 focus:border-green-400 focus:ring-0" type="text" name="price" id="price">
                                </div>
								<p class="text-xs text-red-500 text-right my-3">Required fields are marked with an
									asterisk <abbr title="Required field">*</abbr></p>
								<div class="mt-5 text-right md:space-x-3 md:block flex flex-col-reverse">
									<button class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100"> Cancel </button>
									<button class="mb-2 md:mb-0 bg-green-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-green-500">Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
   </div>
</template>

<script>
import Guest from '@/Layouts/Guest'
import Upload from '@/Components/Upload.vue'
export default {
    layout: Guest,
   name: "Create",
  components: { Upload },
  data(){
      return{
           form:{ title:'',
            address:'',
            bedrooms:'',
            bathrooms:'',
            price:'',
            },
            media:[],
      }
  },
  methods:{
      submit(){
          this.$inertia.post(`/properties`, this.form,{
              preserveState:false
          });
      },
      uploadMedia(files){
          Array.from(files).forEach((media)=> {
              let reader = new FileReader();
              reader.readAsDataURL(media);

                
              reader.onload = (e) => {
                  let item = {
                      url : e.target.result,
                      id: undefined,  
                      isLoading : true
                  };

                  let formData= new FormData();
                  formData.append('file', media);
                  axios.post('media', formData)
                    .then(({data}) => {
                        item.id = data.id;
                  })
                  .finally(() => item.isLoading = false);

                this.media.push(item);
              };
          });
      },
      removeMedia(index){
          this.media.splice(index, 1);
      },
  }
}
</script>

<style>

</style>