<template>
<div class="md:space-y-2 mb-3">
    <label class="text-sm font-semibold text-gray-600 py-2">Property Images<abbr class="hidden" title="required">*</abbr></label>
    <div class="flex items-center py-3">
        <label class="cursor-pointer ">
            <button type="button" class="focus:outline-none text-white py-2 px-3 rounded-full bg-green-400 hover:bg-green-500 hover:shadow-lg" 
            @click="browse">
                <i class="icofont-ui-image"></i>
            </button>
            <input ref="picker" type="file" class="hidden" multiple accept="image/*" @change="change">
        </label>
    </div>
</div>
</template>

<script>
export default {
    methods:{
        browse(){
            this.$refs.picker.click();
        },
        change(e){
            this.$emit('input', e.target.files);
        }
    }
}
</script>

<style>

</style>