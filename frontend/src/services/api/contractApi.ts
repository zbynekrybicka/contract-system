import { api } from '.';
import type { Contact } from './contactApi';

export type Contract = { 
  id: number
  client: Contact
  price: number
  paid: boolean
};

export const contractApi = api.injectEndpoints({

  endpoints: (b) => ({

    getContract: b.query<Contract[], {}>({
      query: () => ({ method: 'GET', url: `/contract` }),
    }),

    getOneContract: b.query<Contract, {}>({
      query: (id: number) => ({ method: 'GET', url: `/contract/${id}`})
    }),

    postContract: b.mutation<{id:number}, Partial<Contract>>({
      query: (body) => ({ method: 'POST', url: '/contract', body }),
    }),

    putContract: b.mutation<null, Partial<Contract>>({
      query: (body) => ({ method: 'PUT', url: `/contract/${body.id}`, body })
    }),

    deleteContract: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contract/${id}`})
    })
  }),
  
});
export const { useGetContractQuery, useGetOneContractQuery, usePostContractMutation, usePutContractMutation, useDeleteContractMutation } = contractApi;
