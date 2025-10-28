import { api } from '.';
import type { NewContactFormData } from '../../store/newContactFormSlice';

export type Contact = { 
  id: number; 
  firstName: string; 
  middleName: string;
  lastName: string;
  dialNumber: number; 
  phoneNumber: string;
  email: string;
};

export const contactApi = api.injectEndpoints({

  endpoints: (b) => ({

    getContact: b.query<Contact[], {}>({
      query: () => ({ method: 'GET', url: `/contact` }),
      providesTags: (_err, _res) => [{ type: "Contacts" }]
    }),

    getOneContact: b.query<Contact, string>({
      query: (id: string) => ({ method: 'GET', url: `/contact/${id}`}),
      providesTags: (_err, _res, id) => [{ type: "Contact", id }]
    }),

    postContact: b.mutation<{id:number}, Partial<NewContactFormData>>({
      query: (body) => ({ method: 'POST', url: '/contact', body }),
      invalidatesTags: (_res, _err, { }) => [{ type: "Contacts" }]
    }),

    putContact: b.mutation<null, [number, Partial<Contact>]>({
      query: ([id, body]) => ({ method: 'PUT', url: `/contact/${id}`, body })
    }),

    deleteContact: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contact/${id}`})
    })
  }),
  
});
export const { useGetContactQuery, useGetOneContactQuery, usePostContactMutation, usePutContactMutation, useDeleteContactMutation } = contactApi;
