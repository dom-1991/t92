export default function ({$axios, app}) {
  $axios.onError(error => {
    const statusCode = error.response.status;

    // refresh token if it expired
    if (statusCode === 403) {
      const originalRequest = error.config;
      if (!originalRequest._retry) {
        originalRequest._retry = true;
        return $axios.post('auth/refresh', {'refresh': app.$auth.getRefreshToken('local')})
          .then((response) => {
            originalRequest.headers['Authorization'] = 'Bearer ' + response.data.access_token;
            app.$auth.setToken('local', "Bearer " + response.data.access_token);
            return $axios(originalRequest);
          });
      }
    }

    return Promise.reject(error);
  });
}
