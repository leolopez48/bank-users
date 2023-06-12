import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const serviceApi = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL + "/api/service",
});

// serviceApi.interceptors.request.use(interceptorRequest);
// serviceApi.interceptors.response.reject(interceptorReponse);

export default serviceApi;
