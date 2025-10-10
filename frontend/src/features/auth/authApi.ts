import { api } from '../../services/api';

export const authApi = api.injectEndpoints({
  endpoints: (b) => ({

    login: b.mutation<{ token:string }, { email:string; password:string }>({
      query: (body) => ({ url: '/auth/login', method: 'POST', body }),
    }),

  }),
});
export const { useLoginMutation } = authApi;
