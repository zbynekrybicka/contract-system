import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react'
import type { RootState } from '../../store'
import { API_URL } from '../../config/env'
import { logout } from '../../store/authSlice'

export const api = createApi({

  baseQuery: async (args, api, extra) => {
    const result = await fetchBaseQuery({
      baseUrl: API_URL,
      prepareHeaders: (headers, { getState }) => {
        const token = (getState() as RootState).auth.token;
        if (token) headers.set('Authorization', `Bearer ${token}`);
        headers.set('Content-Type', 'application/json');
        return headers;
      },
    })(args, api, extra)
    // console.log(result)
    if (result.error?.status === 401) {
      api.dispatch(logout())
    }
    return result
  },
  tagTypes: [ "Contacts", "Contact", "Contracts" ],
  endpoints: () => ({}),
});
