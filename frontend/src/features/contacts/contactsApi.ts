import { api } from '../../services/api';

export type Contact = { 
  id: number; 
  name: string; 
  email: string; 
  phone?: string|null; 
  company?:string|null; 
};

export const contactsApi = api.injectEndpoints({

  endpoints: (b) => ({

    getContacts: b.query<Contact[], { q?:string }>({
      query: ({ q = '' } = {}) => ({ url: `/contacts?q=${encodeURIComponent(q)}` }),
      providesTags: ['Contact'],
    }),

    createContact: b.mutation<{id:number}, Partial<Contact>>({
      query: (body) => ({ url: '/contacts', method: 'POST', body }),
      invalidatesTags: ['Contact'],
    }),
  }),
  
});
export const { useGetContactsQuery, useCreateContactMutation } = contactsApi;
