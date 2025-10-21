import { api } from '.';

export type Meeting = { 
  id: number; 
  title: string; 
  startsAt: string; 
  endsAt: string; 
};


export const meetingApi = api.injectEndpoints({
  endpoints: (b) => ({

    getMeeting: b.query<Meeting[], {}>({
      query: () => ({ method: 'GET', url: `/contact` }),
    }),

    getOneMeeting: b.query<Meeting, {}>({
      query: (id: number) => ({ method: 'GET', url: `/contact/${id}`})
    }),

    postMeeting: b.mutation<{id:number}, Partial<Meeting>>({
      query: (body) => ({ method: 'POST', url: '/contact', body }),
    }),

    putMeeting: b.mutation<null, Partial<Meeting>>({
      query: (body) => ({ method: 'PUT', url: `/contact/${body.id}`, body })
    }),

    deleteMeeting: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contact/${id}`})
    })

  }),
});

export const { useGetMeetingQuery, useGetOneMeetingQuery, usePostMeetingMutation, usePutMeetingMutation, useDeleteMeetingMutation } = meetingApi;
