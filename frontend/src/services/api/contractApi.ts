import { api } from '.';

export type Contract = { 
  id: number; 
};

export const contractApi = api.injectEndpoints({

  endpoints: (b) => ({

    getContract: b.query<Contract[], {}>({
      query: () => ({ method: 'GET', url: `/contact` }),
    }),

    getOneContract: b.query<Contract, {}>({
      query: (id: number) => ({ method: 'GET', url: `/contact/${id}`})
    }),

    postContract: b.mutation<{id:number}, Partial<Contract>>({
      query: (body) => ({ method: 'POST', url: '/contact', body }),
    }),

    putContract: b.mutation<null, Partial<Contract>>({
      query: (body) => ({ method: 'PUT', url: `/contact/${body.id}`, body })
    }),

    deleteContract: b.mutation<null, number>({
      query: (id) => ({ method: 'DELETE', url: `/contact/${id}`})
    })
  }),
  
});
export const { useGetContractQuery, useGetOneContractQuery, usePostContractMutation, usePutContractMutation, useDeleteContractMutation } = contractApi;
