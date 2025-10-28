import { api } from '.';
import type { Contact } from './contactApi';

export type Call = { 
  id: number;
  sender: Contact;
  receiver: Contact;
  purpose: string;
  realizedAt: string;
  successful: boolean;
  description: string;
  nextCall: string | null;
};

export type CallResultForm = {
    contact_id: number;
    purpose: string;
    realizedAt: string;
    successful: boolean;
    type: string;
    description: string;
    meetingAppointment: string | null;
    place: string;
    nextCall: string | null;
}



export const callApi = api.injectEndpoints({

  endpoints: (b) => ({

    postCall: b.mutation<{id:number}, Partial<CallResultForm>>({
      query: (body) => ({ method: 'POST', url: '/call', body }),
      invalidatesTags: (_res, _err, { contact_id }) => [{ type: "Contact", id: contact_id }]
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
