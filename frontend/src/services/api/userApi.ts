import { api } from '.';

import type { LoginFormData } from '../../store/loginFormSlice';

export type PostLoginResult = {
  data?: string;
}

export const userApi = api.injectEndpoints({
  endpoints: (b) => ({


    getUserStatistics: b.query<Object, number>({
      query: (id) => ({ method: 'GET', url: `/user/${id}/statistics` })
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
