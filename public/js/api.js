import $axios from "axios"

export default {
    async getTest() {
        return $axios.get('/test');
    }
}

