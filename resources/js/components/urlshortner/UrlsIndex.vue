<template>
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle m-2.5">
        <div class="flex place-content-end mb-4 p-2.5">
            <div class="min-w-full border cursor-pointer align-middle m-2.5 p-2.5">
                <h1 class="text-4xl font-bold underline m-2.5 items-center" style="text-align:center;">URL Shortener</h1>
                <url-create />
            </div>
        </div>
        
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Generated URL</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Orginal URL</span>
                </th>
                <th class="px-6 py-3 bg-gray-50">
                </th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
            <template v-for="item in urls" :key="item.id">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <div @click="openUrl(item.generated_url)" class="hover:underline" style="cursor:pointer;color:blue">
                        {{ item.generated_url }}
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        {{ item.orginal_url }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <button @click="deleteUrl(item.id)"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" style="background: #d73333d1;">
                        Delete</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import useUrls from "../../composables/urls";
import UrlCreate from './UrlsCreate.vue'
import { onMounted } from "vue";

export default {
    components: { UrlCreate },
    setup() {
        const { urls, getUrls, destroyUrl } = useUrls()

        onMounted(getUrls)

        const deleteUrl = async (id) => {
            if (!window.confirm('Are you sure?')) {
                return
            }

            await destroyUrl(id);
            await getUrls();
        }

        const openUrl = async (url) => {
            window.open(url,'_blank');
        }

        return {
            urls,
            deleteUrl,
            openUrl
        }
    }
}
</script>
