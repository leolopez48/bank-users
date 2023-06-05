import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const accountApi = axios.create({
    baseURL: "/api/account",
});

// accountApi.interceptors.request.use(interceptorRequest);
// accountApi.interceptors.response.reject(interceptorReponse);

export default accountApi;
