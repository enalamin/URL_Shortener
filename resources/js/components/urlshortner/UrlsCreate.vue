<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-red-500 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
            {{ error }}
            </p>
        </div>
    </div>
    <div v-if="urlError" style="color:red;">
        enter valid url
    </div>

    <form style="display: flex;" @submit.prevent="generateUrl">
        <div class=" w-3/4 rounded-md shadow-sm p-2.5">
            <input type="text" name="long_url" id="long_url" placeholder="Enter URL"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.long_url" style="border: 1px solid;height: 40px;" @blur="isValidURL">
        </div>
        <button type="submit" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25" style="height: 40px;margin: auto;">
            Create
        </button>
    </form>
</template>

<script>
import { reactive } from "vue";
import useUrls from "../../composables/urls";

export default {
    
    setup() {
        const form = reactive({
            'orginal_url': '',
            'long_url': ''
        })
        let urlError  = false;
        const { errors, storeUrl} = useUrls()

        const generateUrl = async () => {
            if(urlError || !form.long_url){
                alert("Please enter valid URL.");
            }else{
                await storeUrl({...form});
            }
            
        }

        const isValidURL = async () => {
            var regex = /(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
            debugger
            if(!regex .test(form.long_url)) {
                alert("Please enter valid URL.");
                 urlError = true;
                //return false;
            } else {
                urlError = false;
                //return true;
            }
        };

        return {
            form,
            errors,
            urlError,
            generateUrl,
            isValidURL
        }
    }
}
</script>