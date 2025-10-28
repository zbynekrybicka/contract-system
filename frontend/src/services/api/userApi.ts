import { api } from '.';

type LoginFormData = {
  email: string
  password: string
  rememberMe: boolean
};

export type PostLoginResult = {
  data?: string;
}

export const userApi = api.injectEndpoints({
  endpoints: (b) => ({


    getUserStatistics: b.query<Object, null>({
      query: () => ({ method: 'GET', url: `/user/statistics` })
    }),

    postLogin: b.mutation<string, LoginFormData>({
      query: (body) => ({ method: 'POST', url: '/login', body }),
    }),

  }),
});
export const { useGetUserStatisticsQuery, usePostLoginMutation } = userApi;
