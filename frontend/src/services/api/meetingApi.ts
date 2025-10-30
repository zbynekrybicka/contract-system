import { api } from '.';
import type { Contact } from './contactApi';

export type Meeting = { 
  id: number; 
  appointment: string; 
  place: string;
  participants: Contact[]
};


type MeetingResultForm = {
  id: number
  result: string
  type: string
  price: string
  nextMeeting: string | null
  place: string
}


export const meetingApi = api.injectEndpoints({
  endpoints: (b) => ({

    getMeeting: b.query<Meeting[], {}>({
      query: () => ({ method: 'GET', url: `/meeting` }),
    }),

    getOneMeeting: b.query<Meeting, {}>({
      query: (id: number) => ({ method: 'GET', url: `/meeting/${id}`})
    }),

    postMeeting: b.mutation<{id:number}, Partial<Meeting>>({
      query: (body) => ({ method: 'POST', url: '/meeting', body }),
    }),

    putMeeting: b.mutation<null, MeetingResultForm>({
      query: (meetingResult) => { 
        return { method: 'PUT', url: `/meeting/${meetingResult.id}`, meetingResult }
      }
    }),

    deleteMeeting: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/meeting/${id}`})
    })

  }),
});

export const { useGetMeetingQuery, useGetOneMeetingQuery, usePostMeetingMutation, usePutMeetingMutation, useDeleteMeetingMutation } = meetingApi;
