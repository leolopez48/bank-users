import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const historyApi = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL + "/api/history",
});

// historyApi.interceptors.request.use(interceptorRequest);
// historyApi.interceptors.response.reject(interceptorReponse);

export default historyApi;
