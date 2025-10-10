import { api } from '../../services/api';

export type Meeting = { id:number; title:string; startsAt:string; endsAt:string; };


export const meetingsApi = api.injectEndpoints({
  endpoints: (b) => ({

    getMeetings: b.query<Meeting[], { from?: string; to?: string }>({
      query: ( p = {} ) => ({ url: `/meetings?from=${ p.from ?? '' }&to=${ p.to ?? '' }` }),
      providesTags: ['Meeting'],
    }),

    createMeeting: b.mutation<{id:number}, Partial<Meeting> & { participants?: number[]}>({
      query: (body) => ({ url: '/meetings', method: 'POST', body }),
      invalidatesTags: ['Meeting'],
    }),
  }),
});
export const { useGetMeetingsQuery, useCreateMeetingMutation } = meetingsApi;
