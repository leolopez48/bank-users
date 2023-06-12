import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const serviceApi = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL + "/api/service",
    headers: {
        Authorization: "Bearer " + localStorage.getItem("access_token"),
    },
});

// Response interceptor for API calls
serviceApi.interceptors.response.use(
    (response) => {
        return response;
    },
    async function (error) {
        // Getting the config before the error
        const originalRequest = error.config;

        // If it's error 401, the token is invalid
        if (error.response.status === 401 && !originalRequest._retry) {
            originalRequest._retry = true;

            const verifier = localStorage.getItem("verifier");
            const refreshToken = localStorage.getItem("refresh_token");

            // Refresh the access token
            const response = await refreshAccessToken(verifier, refreshToken).catch(
                (error) => {
                    localStorage.clear();
                    window.location.href = "/login";
                }
            );

            // Renews the tokens
            localStorage.setItem("access_token", response.data.access_token);
            localStorage.setItem("refresh_token", response.data.refresh_token);

            originalRequest.headers["Authorization"] =
                "Bearer " + response.data.access_token;

            // Retry the request
            return backendApi(originalRequest);
        }

        // localStorage.clear();
        // window.location.href = "/login";
        return Promise.reject(error);
    }
);

export default serviceApi;
