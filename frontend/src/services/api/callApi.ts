import { api } from '.';
import type { Contact } from './contactApi';

export type Call = { 
  id: number
  sender: Contact
  receiver: Contact
  purpose: string
  realizedAt: string
  successful: boolean
  description: string
  nextCall: string | null
};


export const callApi = api.injectEndpoints({

  endpoints: (b) => ({

    postCall: b.mutation<{id:number}, Partial<Call>>({
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
