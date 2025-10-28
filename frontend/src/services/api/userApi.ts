import { api } from '.';

import type { LoginFormData } from '../../store/loginFormSlice';

export const userApi = api.injectEndpoints({
  endpoints: (b) => ({


    getUserStatistics: b.query<Object, null>({
      query: () => ({ method: 'GET', url: `/user/statistics` })
    }),

    postLogin: b.mutation<string, LoginFormData>({
      query: (body) => ({ 
        method: 'POST', 
        url: '/login', 
        body 
      }),
    }),

  }),
});
export const { useGetUserStatisticsQuery, usePostLoginMutation } = userApi;
