import { api } from '.';

type LoginFormData = {
  email: string
  password: string
  rememberMe: boolean
};


export type UserStatistics = {
  contacts: number
  calls: number
  meetings: number
}

export type PostLoginResult = {
  data?: string;
}

export const userApi = api.injectEndpoints({
  endpoints: (b) => ({


    getUserStatistics: b.query<UserStatistics, null>({
      query: () => ({ method: 'GET', url: `/user/statistics` })
    }),

    postLogin: b.mutation<string, LoginFormData>({
      query: (body) => ({ method: 'POST', url: '/login', body }),
    }),

    postUser: b.mutation<void, { contactId: number }>({
      query: (body) => ({ method: 'POST', url: '/user', body }),
    }),

    putUserNewPassword: b.mutation<void, { token: string, newPassword: string; confirmPassword: string }>({
      query: (body) => ({
        method: 'PUT',
        url: '/user/new-password',
        body,
        headers: { Authorization: `Bearer ${body.token}` },
      }),
    }),

  }),
});
export const { useGetUserStatisticsQuery, usePostLoginMutation, usePostUserMutation, usePutUserNewPasswordMutation } = userApi;