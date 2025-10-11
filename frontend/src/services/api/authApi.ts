import { api } from '.';

export const authApi = api.injectEndpoints({
  endpoints: (b) => ({

    login: b.mutation<{}, { email:string; password:string }>({
      query: (body) => ({ url: '/login', method: 'POST', body }),
    }),

  }),
});
export const { useLoginMutation } = authApi;
