import { api } from '.';

import type { LoginFormData } from '../../store/loginFormSlice';

export const authApi = api.injectEndpoints({
  endpoints: (b) => ({

    login: b.mutation<string, LoginFormData>({
      query: (body) => ({ 
        method: 'POST', 
        url: '/login', 
        body 
      }),
    }),

  }),
});
export const { useLoginMutation } = authApi;
