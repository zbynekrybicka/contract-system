import { api } from '.';

export type Contact = { 
  id: number; 
  name: string; 
  email: string; 
  phone?: string|null; 
  company?: string|null; 
};

export const contactApi = api.injectEndpoints({

  endpoints: (b) => ({

    getContact: b.query<Contact[], {}>({
      query: () => ({ method: 'GET', url: `/contact` }),
    }),

    getOneContact: b.query<Contact, {}>({
      query: (id: number) => ({ method: 'GET', url: `/contact/${id}`})
    }),

    postContact: b.mutation<{id:number}, Partial<Contact>>({
      query: (body) => ({ method: 'POST', url: '/contact', body }),
    }),

    putContact: b.mutation<null, Partial<Contact>>({
      query: (body) => ({ method: 'PUT', url: `/contact/${body.id}`, body })
    }),

    deleteContact: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contact/${id}`})
    })
  }),
  
});
export const { useGetContactQuery, useGetOneContactQuery, usePostContactMutation, usePutContactMutation, useDeleteContactMutation } = contactApi;
