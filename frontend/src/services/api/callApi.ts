import { api } from '.';
import type { Contact } from './contactApi';

export type Call = { 
  id: number
  sender: Contact
  receiver: Contact
  purpose: string
  realizedAt: string
  successful: boolean
  type: string
  description: string
  nextCall: string | null
};

type CallResultForm = {
  receiver: Contact
  purpose: string
  successful: boolean
  type: string
  description: string
  meetingAppointment: string | null
  place: string
  nextCall: string | null
}


export const callApi = api.injectEndpoints({

  endpoints: (b) => ({

    postCall: b.mutation<{id:number}, Partial<CallResultForm>>({
      query: (body) => ({ method: 'POST', url: '/call', body }),
      invalidatesTags: (_res, _err, { receiver }) => [{ type: "Contact", id: receiver?.id }]
    }),

    putCall: b.mutation<null, Partial<Call>>({
      query: (body) => ({ method: 'PUT', url: `/contact/${body.id}`, body })
    }),

    deleteCall: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contact/${id}`})
    })
  }),
  
});
export const { usePostCallMutation, usePutCallMutation, useDeleteCallMutation } = callApi;
