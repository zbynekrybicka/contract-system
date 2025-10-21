import { api } from '.';

export type Call = { 
  id: number; 
};

export const callApi = api.injectEndpoints({

  endpoints: (b) => ({

    postCall: b.mutation<{id:number}, Partial<Call>>({
      query: (body) => ({ method: 'POST', url: '/contact', body }),
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
