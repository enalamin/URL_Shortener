import { ref } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useUrls() {
    const urls = ref([])
    const url = ref([])
    const router = useRouter()
    const errors = ref('')

    const getUrls = async () => {
        let response = await axios.get('/api/short-urls')
        //debugger
        urls.value = response.data;
    }

    const getUrl = async (id) => {
        let response = await axios.get('/api/short-urls/' + id)
        url.value = response.data;
    }

    const storeUrl = async (data) => {
        errors.value = ''
        try {
            let response = await axios.post('/api/short-urls/add', data)
            if(response.data.status === 'success'){
                await window.location.reload();
            }else{
                alert(response.data.message)
            }
            
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    
    const destroyUrl = async (id) => {
        await axios.delete('/api/short-urls/delete/' + id)
    }


    return {
        urls,
        url,
        errors,
        getUrls,
        getUrl,
        storeUrl,
        destroyUrl
    }
}
