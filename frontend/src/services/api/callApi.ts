import { api } from '.';
import type { CallResultForm } from '../../store/callResultFormSlice';

export type Call = { 
  id: number; 
};


export const callApi = api.injectEndpoints({

  endpoints: (b) => ({

    postCall: b.mutation<{id:number}, Partial<CallResultForm>>({
      query: (body) => ({ method: 'POST', url: '/call', body }),
      async onQueryStarted(body, { dispatch, queryFulfilled }) {
        try  {
          const { data } = await queryFulfilled
          const { call, meeting } = data
          dispatch(api.util.updateQueryData("getOneContact", body.contact_id, (draft) => {
            draft.history.calls.push(call)
            if (meeting) {
              draft.history.meetings.push(meeting)
            }
          }))
        } catch {}
      },
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
