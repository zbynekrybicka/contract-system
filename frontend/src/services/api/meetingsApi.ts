import { api } from '.';

export type Meeting = { 
  id: number; 
  title: string; 
  startsAt: string; 
  endsAt: string; 
};


export const meetingsApi = api.injectEndpoints({
  endpoints: (b) => ({

    getMeetings: b.query<Meeting[], { from?: string; to?: string }>({
      query: ( p = {} ) => ({ url: `/meetings?from=${ p.from ?? '' }&to=${ p.to ?? '' }` }),
    }),

    createMeeting: b.mutation<{id:number}, Partial<Meeting> & { participants?: number[]}>({
      query: (body) => ({ url: '/meetings', method: 'POST', body }),
    }),
  }),
});

export const { useGetMeetingsQuery, useCreateMeetingMutation } = meetingsApi;
